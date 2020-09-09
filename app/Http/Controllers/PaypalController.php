<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Paypal;
use App\assignmentOrder;
use App\paymentData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Refund;
use PayPal\Api\RefundRequest;
use PayPal\Api\Sale;
use PayPal\Api\ShippingInfo;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use Redirect;
use function Opis\Closure\unserialize;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

class PaypalController extends Controller
{

    public function __construct()
    {
        /** PayPal api context **/
       
        $paypal_conf = \Config::get('services.paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            // $paypal_conf['client_id'],
            // $paypal_conf['secret']
            'AfRST9BJsRnA8_zmFTGB7h4CSUNTriBtJ8Ndk7iCkuj7vlDdwcLJkOWZNy2_3eGyXzABext8DdCgc9Ed',
            'EIXssKKG90AgUijyFm8rptUApKDax7OyquOufjxjKkWFPDGSdDqFtMiJhHYbyhKdAT29dgwXhZE76K6n'
        ));
        $this->_api_context->setConfig($paypal_conf['settings']);

      
    }


    // paypal checkout sdk

     public function payWithpaypal_checkout_sdk($id = 0)

    {
        $order = assignmentOrder::FindOrFail($id);

               // $order = assignmentOrder::find(request('id'));
        $currency = Currency::find($order->currency_id);
        $TotalPrice = $order->price;
        $CurrencyName = $currency->name;



        if ($order->completed == 1) {
            return redirect('/login')->with('message', 'The Payment is Already Done!');            
        }

        $clientId = env('PAYPAL_CLIENT');
        $clientSecret = env('PAYPAL_SECRET');

        $environment = new SandboxEnvironment($clientId, $clientSecret);
        $client = new PayPalHttpClient($environment); 

        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
                            "intent" => "CAPTURE",
                            "purchase_units" => [[
                                "reference_id" => "test_ref_id1",
                                "amount" => [
                                    "value" => round($TotalPrice, 2),
                                    "currency_code" => $CurrencyName,
                                ]
                            ]],
                            "application_context" => [
                                "cancel_url" => url('paypal-cancel'),
                                "return_url" => url('paypal-return',['orderID'=>$order->id])
                            ] 
                        ];
        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($request);
            
            // If call returns body in response, you can get the deserialized version from the result attribute of the response

            return redirect()->to($response->result->links[1]->href);
            // $this->execute_payment($response->result->id);
        }catch (HttpException $ex) {
            echo $ex->statusCode;
            return response()->json($ex->getMessage());
        }

    }


    public function payment_return__checkout_sdk($id = 0)

    {
        $clientId = env('PAYPAL_CLIENT');
        $clientSecret = env('PAYPAL_SECRET');

        $environment = new SandboxEnvironment($clientId, $clientSecret);
        $client = new PayPalHttpClient($environment); 

    
        $request = new OrdersCaptureRequest(request('token'));
        $request->prefer('return=representation');
        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($request);
            
            // If call returns body in response, you can get the deserialized version from the result attribute of the response
                // return response()->json($response);
            // print_r($response);
        }catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }

        $order = assignmentOrder::FindOrFail($id);
        $order->completed = '1';
        $order->save();
            

        return redirect('/login')->with('message', 'Your Order Placed Successfully! Go To Dashboard To See Details.');
    }

    public function payment_cancel__checkout_sdk() 

    {
        return redirect('/login')->with('error', 'Sorry The Payment Process Failed, Please Try Again.');
    }


    // paypal checkout sdk sode ends



public function payWithpaypal(Request $request)

{
        $order = assignmentOrder::find(request('id'));
        $currency = Currency::find($order->currency_id);
        $TotalPrice = $order->price;
        $CurrencyName = $currency->name;


        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();
        $item_1->setName('Assignment order: '. $order->service->name) /** item name **/
                ->setCurrency($CurrencyName)
                ->setQuantity(1)
                ->setPrice($TotalPrice); //sample amount
                //->setPrice($request->get('amount')); /** unit price **/


        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency($CurrencyName)
                ->setTotal($TotalPrice);
                   // ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription(' transaction description');


        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('execute-payment',[$CurrencyName, $TotalPrice, request('id')])) /** Specify return URL **/
                ->setCancelUrl(URL::route('execute-payment-failed'));

        $payment = new Payment();
        $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));
                /** dd($payment->create($this->_api_context));exit; **/
        $payment->create($this->_api_context);
        $approvalUrl = $payment->getApprovalLink();
        
        return redirect($approvalUrl);

}


    public function execute_payment($CurrecyName, $TotalPrice, $order_id)
    {

        $paymentId = request('paymentId');
        $payment = Payment::get($paymentId, $this->_api_context );


        $execution = new PaymentExecution();
        $execution->setPayerId(request('PayerID'));


        $transaction = new Transaction();

        $amount = new Amount();

        $details = new Details();


        $amount->setCurrency($CurrecyName); // set dynamic
        $amount->setTotal($TotalPrice); //set dymamic
        $transaction->setAmount($amount);

        $execution->addTransaction($transaction);

        $result = $payment->execute($execution, $this->_api_context);

        $paymentData = new paymentData;
        $paymentData->result = (serialize($result));
        $paymentData->assignment_order_id = $order_id;

        $paymentData->save();

        $order = assignmentOrder::find($order_id);
        $order->completed = '1';
        $order->save();


        return redirect('/login')->with('message', 'Your Order Placed Successfully!. Sign In Using Your Credentials To See Details.');
    }

    public function execute_payment_failed() {
        return redirect('/login')->with('error', 'Sorry Payment Process Failed, Please Try Again.');
    }
    //niat

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paypal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'price' => 'required|integer|min:1',
        ]);

        $paypal = Paypal::create([
            'price' => $request->price
        ]);
        // generate paypal link and save info
        $link = $this->generate_link($paypal->price, $paypal->id);
        if (!$link) {
            $paypal->delete();
            return redirect()->back();
        }
        // return $this->json_data($link);
        return Redirect::to($link);
    }


    public function verify(Request $request)
    {
        if ($this->check($request)) {
            return redirect('/');
        }

        return redirect('/');
    }

    public function check(Request $request)
    {
        $paymentId = $request->paymentId;
        $payment = Payment::get($paymentId, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->PayerID);
        $transaction = new Transaction();
        $amount = new Amount();
        $amount->setCurrency('AUD');
        $amount->setTotal($payment->transactions[0]->amount->total);
        $transaction->setAmount($amount);

        $execution->addTransaction($transaction);

        try {
            $result = $payment->execute($execution, $this->_api_context);

            // echo ("Executed Payment | Payment ".$payment->getId()." | ".$execution." | ".$result);

            try {
                $payment = Payment::get($paymentId, $this->_api_context);
            } catch (Exception $ex) {
                return false;
            }
        } catch (Exception $ex) {
            // return "Payment failed.Try again";
            return false;
        }
        // return $payment;

        $paypal = Paypal::find($payment->transactions[0]->item_list->items[0]->sku);
        $paypal->verified = 1;
        $paypal->info = serialize([
            't_id' => $payment->id,
            'payer_email' => $payment->payer->payer_info->email,
            'payer_first_name' => $payment->payer->payer_info->first_name,
            'payer_last_name' => $payment->payer->payer_info->last_name,
        ]);
        $paypal->save();

        return true;
    }

    public function generate_link($price, $id)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Item 1')
            /** item name **/
            ->setCurrency('AUD')
            ->setQuantity(1)
            ->setPrice($price)
            ->setSku($id);
        /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('AUD')
            ->setTotal($price);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(\URL::route('paypal.verify'))
            /** Specify return URL **/
            ->setCancelUrl(\URL::route('index'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                // \Session::put('error', 'Connection timeout');
                return false;
            } else {
                // \Session::put('error', 'Some error occur, sorry for inconvenient');
                return false;
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        // Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return $redirect_url;
        }
        \Session::put('error', 'Unknown error occurred');
        return false;
    }
}
