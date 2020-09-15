<?php

namespace App\Http\Controllers\User;

use App\AcademicLevel;
use App\Currency;
use App\Http\Controllers\Controller;
use App\Http\Controllers\generate_link;
use App\OrderMeta;
use App\Price;
use App\Service;
use App\User;
use App\assignmentOrder;
use App\paper;
use Illuminate\Http\Request;
use Illuminate\Routing\signedRoute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;


class AssignmentController extends Controller
{

   #place order by user (registered)
    public function place_order_registered(Request $request) {




        if (Auth::check()) {
           $a = $request->validate([
                'academic_level' => 'required|exists:academic_levels,id',
                'urgency' => 'required',
                'no_of_sources' => 'required',
                'paper_format' => 'required',
                'service_id' => 'required|exists:services,id',
                'no_of_pages' => 'required|numeric|min:1',
                'currency_id' => 'required|exists:currencies,id',
            ]);
        } else {
           $a = $request->validate([
                'email' => 'required|email|unique:users,email',
             	'academic_level' => 'required|exists:academic_levels,id',
                'urgency' => 'required',
                'no_of_sources' => 'required',
                'paper_format' => 'required',
                'service_id' => 'required|exists:services,id',
                'no_of_pages' => 'required|string',
                'currency_id' => 'required|exists:currencies,id',
                'password' => 'required|confirmed|min:8',
            ]);
         

            $newUser = new User;
            $newUser->name=strstr($request->email, '@', true);
            $newUser->email=$request->email;
            $newUser->password=Hash::make($request->password);
            $newUser->save();

        }

        #get currency eg. USD, CAD
        $currency = Currency::find($request->currency_id);
        //$service = Service::find($request->service_id);

        $order = new assignmentOrder;
        $order->user_id = Auth::User()->id ?? $newUser->id;
        $order->service_id = $request->service_id;
        $order->paper_id = $request->paper;
        $order->no_of_pages = $request->no_of_pages;
        $order->academic_level_id = $request->academic_level;
        $order->deadline = $request->urgency;
        $order->status = "In Progress";


        if ($request->file('file')) {

            $fileNames = [];
            foreach ($request->file('file') as  $file) {

            $name = time()."_order_".$file->getClientOriginalName('file');

              // $path = $file->storeAs('files', 'public');
            if(Auth::Check()){
                $path = $file->storeAs('/public/files/orders/'.Auth::User()->id, $name);
                
            }else {
                
                $path = $file->storeAs('/public/files/orders/'.$newUser->id, $name);
            }
            // dump($path);
            $fileNames[] = $path;

               } 

            // $order->order_files = serialize($fileNames);      
            $order->order_files = $fileNames;      
        }



        $get_price = Price::where('service_id', $request->service_id)->where('academic_level_id', $request->academic_level)->where('id', $request->urgency)->first();
   


        $total_price = $get_price->price * $request->no_of_pages;



        $currencyValue = Currency::where('id', $request->currency_id)->first();
        //return response()->json($currencyValue->value);

        $order->price = $total_price * $currencyValue->value;        
        $order->currency_id = $request->currency_id; 
        $order->price_id = $request->urgency; 
		// $link =  action('PaypalController@payWithpaypal', ['id' => $order]);
        $order->paypal_link = "#";
        $done = $order->save();

        if($done){

        $update_link = assignmentOrder::where('id',$order->id)->first();
        // dd($update_link->id);
        // $update_link->paypal_link = URL::signedRoute('pay-with-paypal', ['id'=>$update_link->id]);

        $update_link->paypal_link = URL::signedRoute('pay-with-paypal-checkout', ['id'=>$update_link->id]);

        $ckeckout_page_link = URL::signedRoute('checkout_page',[$update_link->id]);
        $update_link->save();
           
        // return response()->json($ckeckout_page_link);
        return $this->confirm_order_checkout($request, $order->id);

        }
    }

    public function confirm_order_checkout(Request $request, $id) {
        // $this->validate($request, [
        //     'no_of_sources'=> 'required'

        // ]);

       $order = assignmentOrder::Find($id);

           $meta_data_count = OrderMeta::where('assignment_order_id', $id)->count();
               if( ($meta_data_count > 0) ) {
            $meta_data = OrderMeta::where('assignment_order_id', $id)->first();


                $meta_data->assignment_order_id = $id;
                $meta_data->no_of_sources = $request->no_of_sources ?? '0';
                $meta_data->paper_format = $request->paper_format ?? 'Not Selected';
                $meta_data->order_comments = $request->comments ?? " No Comments";

                    if( $meta_data->save() ) {
                        return redirect($order->paypal_link);

                    }

               }else{

       $oredrMeta = new OrderMeta;

       $oredrMeta->assignment_order_id = $id;
       $oredrMeta->no_of_sources = $request->no_of_sources ?? '0';
       $oredrMeta->paper_format = $request->paper_format ?? 'Not Selected';
       $oredrMeta->order_comments = $request->comments ?? 'No Comments';
       if($oredrMeta->save()) {
       
        return redirect($order->paypal_link);
       }
               }

    }


    public function cancel_order_checkout($order_id = 0) {
       $order = assignmentOrder::where('id',$order_id)->first(); 

       if($order->user_id == Auth::User()->id && $order->completed ==0 ){
        
        if($order->user_id == Auth::User()->id && $order->completed ==0 ){
           if($order->order_files){
               
            foreach($order->order_files as $file){
                Storage::delete($file);

            }

        }
        $order->delete();
       }

       return redirect()->to('home');
    }
}


    public function checkout($order_id = 0) {

        $services = Service::where('disable', 0)->get();
        $academics = AcademicLevel::all();
        $currencies = Currency::all();
        $papers = paper::all();
        $all_prices = Price::all();


       $order = assignmentOrder::where('id',$order_id)->get(); 

       return view('order.checkout', compact('order', 'services', 'academics', 'currencies', 'papers', 'all_prices'));
    }

    public function update_price(Request $request) {   


    	$urgency = $request->urgency ?? "28 days";
    	

    	$get_price = Price::where('service_id', $request->service_id)->where('academic_level_id', $request->academic_level)->where('urgency', $urgency)->first();

        $single_price = str_replace("$", "",$get_price->price) ?? "0";

        $total_price = $single_price*$request->no_of_pages;
        $currencyValue = Currency::where('name', $request->currencyName)->first();
        //return response()->json($currencyValue->value);


        switch ($request->currencyName) {

            case 'USD':
                return response()->json("$".$total_price);
             
                break;
            case 'GBP':
                return response()->json("£".$total_price*$currencyValue->value);
                
                break;
            case 'EUR':
               return response()->json("€".$total_price*$currencyValue->value);
                break;
            case 'CAD':
              return response()->json("$".$total_price*$currencyValue->value);
                break;
            case 'AUD':
              return response()->json("$".$total_price*$currencyValue->value);
                break;
            
            default:
              return response()->json("000");
                break;
        }

    	//return response()->json($total_price);
    }
}
