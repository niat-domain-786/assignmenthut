<?php

namespace App\Http\Controllers;

use App\AcademicLevel;
use App\Currency;
use App\File;
use App\Note;
use App\Order;
use App\Price;
use App\Product;
use App\Revision;
use App\Service;
use App\Subject;
use App\User;
use App\assignmentOrder;
use App\paper;
use App\urgency;
use Auth;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as PublicFile;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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
use Zip;

class OrderController extends Controller
{



    public function __construct()
    {
        /** PayPal api context **/
        $paypal_conf = \Config::get('services.paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret']
        ));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = assignmentOrder::where('user_id', Auth::User()->id)->orderBy('created_at', 'DESC')->get();      
     
        return view('order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $subjects = Subject::with('categories.products')->get();
        $services = Service::where('disable', 0)->get();
        $academics = AcademicLevel::all();
        $currencies = Currency::all();
        $papers = paper::all();
        $all_prices = Price::all();
        
      

        return view('order.create', compact( 'currencies','academics', 'services', 'papers','all_prices'));

        return view('order.create', compact( 'currencies','academics', 'services', 'papers','days'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Auth::check()) {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'details' => 'required|string',
                'currency_id' => 'required|exists:currencies,id',
                'file' => 'nullable|max:10240',
            ]);
        } else {
            $request->validate([
                'email' => 'required|email',
                'product_id' => 'required|exists:products,id',
                'details' => 'required|string',
                'currency_id' => 'required|exists:currencies,id',
                'file' => 'nullable|max:10240',
            ]);
        }




        $product = Product::with('category.subject')->find($request->product_id);
        $currency = Currency::find($request->currency_id);

        if (Auth::check()) {
            $user = auth()->user();
            
        } else {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                $newpassword = $this->random_password();

                $user = new User;
                $user->email = $request->email;
                $user->name = $request->email;
                $user->password = bcrypt($newpassword);
                $user->save();

                $user->notify(new VerifyEmail);


                //Send new password email
            }
        }




        if ($request->file) {
            $file = $request->file;
            $path = $file->store('files', 'public');
        }
        $order = new Order;
        $order->user_id = $user->id;
        $order->details = $request->details;
        $order->description = serialize([
            'product' => $product,
            'currency' => $currency
        ]);
        $order->amount = round($product->price / $currency->value, 2);

        $order->file = $path ?? null;
        $order->save();

        //Generate paypal url

        $link = $this->generate_link($product->price, $order->id, $currency);

        if ($link) {

            Session::put('currency', $currency->name);

            return response()->json([
                'link' => $link
            ]);
        }

        return response()->json([
            'error' => 'Something went wrong!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(assignmentOrder $order)
    {   


        if (auth()->user()->orders->where('id', $order->id)->count() > 0) {

            return view('order.show', compact('order'));
        }
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    protected function random_password()
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function generate_link($price, $id, $currency)
    {
        $price = number_format((float)$price / $currency->value, 2, '.', '');
        // $price = $price / $currency->value;
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Item 1')
            /** item name **/
            ->setCurrency($currency->name)
            ->setQuantity(1)
            ->setPrice($price)
            ->setSku($id);
        /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency($currency->name)
            ->setTotal($price);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(\URL::route('order.verify'))
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

    public function verify(Request $request)
    {
        if ($this->check($request)) {
            return redirect('/home');
        }

        return redirect('/');
    }

    public function check(Request $request)
    {
        $currency = Session::get('currency');

        $paymentId = $request->paymentId;
        $payment = Payment::get($paymentId, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->PayerID);
        $transaction = new Transaction();
        $amount = new Amount();
        $amount->setCurrency($currency);
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

        $order = Order::find($payment->transactions[0]->item_list->items[0]->sku);
        $order->completed = 1;
        $order->info = serialize($payment);
        $order->save();

        if (!Auth::check()) {
            Auth::loginUsingId($order->user_id);
        }

        return true;
    }

    public function orderfiledownload($id)
    {   
        $key = request()->key;
        $order = assignmentOrder::findOrFail($id);
        if ($order) {
        return Storage::download($order->order_files[$key]);

            // return response()->download(public_path() . '/' . $order->order_files[$key]);
        }

        return redirect('/');
    }

    #download files, uploaded by admin while delivering to user in admins/orders/show

    public function solvedFileDownload($id)
    {   
       
        // return $id;
        $order = File::findOrFail($id);
        if ($order) {
        return Storage::download($order->file_delivered);

        }

        return redirect('/');
    }

    public function revision_file_download($id)
    {
        $files = Revision::findOrFail($id);

        if ($files) {
            //dd($files->file[request()->key]);
            return Storage::download($files->file[request()->key]);

            // return response()->download(public_path() . '/' . $files->file[request()->key]);
        }

        return redirect('/');
    }

    public function revision_attached_file_download($id)
    {

        $file = Revision::find($id);
           
        if ($file) {

            return response()->download(public_path() . '/' . $file->file);
        }

        return redirect('/');
    }


    public function admin_revision_file_download($id)
    {
        $file = File::findOrFail($id);
        if ($file) {
            return Storage::download($file->revision_file);

            return response()->download(public_path() . '/' . $file->revision_file);
        }

        return redirect('/');
    }

    public function filedownload($id)
    {
        $file = File::findOrFail($id);
        if ($file) {

            // $file = public_path() . "/download/info.pdf";


            return response()->download(public_path() . '/' . $file->file_delivered);
        }

        return redirect()->back()->with('error', 'Unable to download file.');
    }

    public function addnote(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|string'
        ]);
        $order = assignmentOrder::findOrFail($id);


        if($order) {
            # adding multiple notes
            $note = new Note;
            $note->text = $request->note;
            $note->assignment_order_id = $order->id;
            $note->user_id = auth()->user()->id;
            $note->save();

            return redirect()->back();

        }


        # adding single note
        
        // $updateNote = Note::where('order_id', $order->id)->first();
        // //auth()->user()->orders->where('id', $order->id)->count() > 0
        // if (!($updateNote) ) {

        //     // $file = public_path() . "/download/info.pdf";
        //     $note = new Note;
        //     $note->text = $request->note;
        //     $note->order_id = $order->id;
        //     $note->user_id = auth()->user()->id;
        //     $note->save();

        //     return redirect()->back();
        // } else {
        //     $updateNote->text =  $request->note;
        //     $updateNote->save();

        //     return redirect()->back();
        // }

        return redirect('/');
    }


    public function deleteNote(Request $request) {
        $note = Note::FindOrFail($request->noteId);

        //$note = Note::where('id', $request->noteId)->first()->delete();
        //dd("delete note $request->noteId");
        if($note) {
            $note->delete();
            }
        return redirect()->back();


    }

    public function deleteRevisionFile(Request $request) {
        $file = File::where('id', $request->FileId);
        //$path = $request->FilePath;


        if($file) {

            // $deleteFile = PublicFile::delete($path);
            // $mytime = Carbon::now();
            // $time= $mytime->toDateTimeString();
            // $file->deleted_at= $time;
             $fileDeleted = $file->delete();
           

            if($fileDeleted) {
            return redirect()->back()->with('success', 'file deleted!');

                }
            }
            return redirect()->back()->with('error', 'File Not Deleted!');


    }

        public function deleteFile(Request $request) {
        $file = File::Find( $request->FileId);
        $path = $request->FilePath;


        if($file) {
            $delete_from_db = $file->forcedelete();
            if($delete_from_db) {
               $deleteFile= Storage::delete($path);

             // $deleteFile = PublicFile::delete($path);
            }
                   

            if($deleteFile) {

            return redirect()->back()->with('success', 'file deleted!');

                }
            }
            return redirect()->back()->with('error', 'File Not Deleted!');


    }

    public function addfile(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|max:10240'
        ]);

        $order = assignmentOrder::findOrFail($id);


        if ($order) {


        $name = time()."_".$request->file('file')->getClientOriginalName();
        $path = $request->file('file')->storeAs('/public/files/orders'."/".$order->user_id."/".'delivered', $name);
        // $path = $file->store('files/assignments', 'public');
      


            $newfile = new File;
            $newfile->file_delivered = $path;
            $newfile->file = "";
            $newfile->assignment_order_id = $order->id;
            $newfile->user_id = $order->user_id;
            $newfile->save();

            return redirect()->back()->with('status', 'Document successfully Uploaded.');
        }

        return redirect()->back()->with('error', 'Sorry Document Not Uploaded.');
    }

    public function deliverFile(Request $request, $order_id) {

         $order = assignmentOrder::find($order_id);
      
         $order->status = "completed";
         $order->completed = '1';
         $delivered = $order->save();
         if($delivered) {
        return response()->json(['success', 'File Delivered!']);

         } else {

        return response()->json(['error', 'File Not Delivered!']);

     }

    }


    #user dashboard show revisions
    public function show_revisions(Request $request) {

        $solved = $request->solved;
        switch($solved){
            case '1':

        $orders = Revision::where('user_id', Auth::User()->id)->where('solved', '1')->orderBy('created_at', 'DESC')->get();

        // foreach($orders as $order) {

        // dd($order->user);
        // }
        // dd('done');

        //$orders['files'] = $orders->order;
        // foreach($orders as $order) {
        //     dd($order->order->file);
        // }
        // dd("done");
        //dd($orders);
        return view('order.revisions')->with('orders',$orders);


            break;

            case '0':

        $orders = Revision::where('user_id', Auth::User()->id)->where('solved', '0')->orderBy('created_at', 'DESC')->get();
        //dd($orders);
        return view('order.revisions')->with('orders', $orders);

            break;

            default:
        $orders = Revision::where('user_id', Auth::User()->id)->orderBy('created_at', 'DESC')->get();
        //dd($orders);
        return view('order.revisions')->with('orders', $orders);

        }



    }

    #download assignments files/revisions sent by admin in user dashboard
    public function download_completed_assignment(Request $request) {
            $order_id = $request->orderId;
            $order_file = $request->fileName;
            return Storage::download($order_file);
            // return response()->download("public/".$order_file);
         
    }


    public function add_revision_file(Request $request) {
        $id = $request->orderID;

          $request->validate([
            'file' => 'required|file|max:10240'
        ]);

        $order = assignmentOrder::findOrFail($id);


        if ($order) {


        $name = time()."_revision_".$request->file('file')->getClientOriginalName();


        $path = $request->file('file')->storeAs('/public/files/orders'."/".$order->user_id."/".'revision/delivered', $name);
        // $path = $file->store('files/revisions', 'public');
          // $path=  $request->file('file')->store('public/files/assignments', $name,'public');


            $newfile = new File;
            $newfile->revision_file = $path;
            $newfile->file_delivered = "";
            $newfile->file = "";
            $newfile->assignment_order_id = $order->id;
            $newfile->user_id = auth()->user()->id;
            $newfile->save();

            return redirect()->back()->with('status', 'Document successfully Uploaded.');
        }

        return redirect()->back()->with('error', 'Sorry Document Not Uploaded.');

    }

#submit a revision by user to admin
    public function submitRevision(Request $request) {
        $this->validate($request,[
            'note'=> 'required'
        ]);
        $userID = Auth::User()->id;
        $orderID = $request->orderID;
        //dd($orderID);

        $order = assignmentOrder::where('id', $orderID)->where('user_id', $userID)->get();

        if(!($order->isEmpty())) {

            $review = Revision::where('assignment_order_id', $orderID)->max('iteration');

            $revisions = new Revision();
            $revisions->user_id = $userID;
            $revisions->service_id = $request->service;
            $revisions->assignment_order_id = $orderID;
            $revisions->iteration = $review +1 ?? '0';
            $revisions->solved = '0';
            $revisions->note = $request->note;

            if($request->file('files')) {

            $arr_files=[];
            foreach ($request->file('files') as $key => $file) {
                //$filename=time().$file->getClientOriginalName();
                $name = time()."_revision_".$file->getClientOriginalName('file');

                // $path = $file->store('files/', 'public');  
                $path = $file->storeAs('/public/files/orders'."/".Auth::User()->id."/"."revision", $name);  
                $arr_files[] = $path;
                 

                }


            $revisions->file = $arr_files ?? null;
           
            }

            $success = $revisions->save();

            if($success) {
                return redirect()->back()->with('message', "Your request is on process!");
            } else {
                return redirect()->back()->with('error', "unable to submit your request! please try again.");

            }
        }

    }


    public function delete_user_order(Request $request) {
        $orderId = $request->orderId;
        $userId = Auth::User()->id;
        $order= assignmentOrder::where('user_id', $userId)->where('id', $orderId)->first();

            if($order->order_files) {
                
                foreach($order->order_files as $file){
                    Storage::delete($file);

                }
            }
        $deleteOrder = $order->delete();

        if($deleteOrder) {

            return redirect()->back()->with('success', 'Order Deleted!');

        } else {
            return redirect()->back()->with('error', 'Failed to delete order!');

        }

    }



}
