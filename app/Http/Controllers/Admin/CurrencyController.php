<?php

namespace App\Http\Controllers\Admin;

use App\AcademicLevel;
use App\Currency;
use App\Http\Controllers\Controller;
use App\Price;
use App\Service;
use App\paper;
use App\urgency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::all();

        return view('admins.currencies.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.currencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:currencies,name',
            'value' => 'required|string',
        ]);

        $currency = new Currency;
        $currency->name = $request->name;
        $currency->value = $request->value;
        $currency->save();

        return redirect()->route('admin.currency.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        return view('admins.currencies.show', compact('currency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        return view('admins.currencies.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {

        if ($currency->name == $request->name) {
                $this->validate($request, [
                    'value' => 'required|string',
                ]);
            } else {
            $this->validate($request, [
                'name' => 'required|string|unique:currencies,name',
                'value' => 'required|string',
            ]);
        }


        $currency->name = $request->name;
        $currency->value = $request->value;
        $currency->save();

        return redirect()->route('admin.currency.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();

        return redirect()->route('admin.currency.index');
    }


    public function find_price(Request $request){
        $services = Service::all();
        $academics = AcademicLevel::all();
        $papers = paper::all();
        $prices = Price::all();

    

        $search_price = Price::where('service_id', $request->service)->where('academic_level_id', $request->academics)->where('paper_id', $request->paper_type)->where('urgency_value', $request->duration)->first();
        if($search_price){

         return view('admins.prices.list', compact('services', 'academics', 'prices','papers', 'search_price'));
        }

       

         return view('admins.prices.list', compact('services', 'academics', 'prices', 'papers'));

   
      
        //$single_price = str_replace("$", "",$get_price->price);
        //$total_price = $single_price*$request->no_of_pages;

    }


    public function add_price(){
        $services = Service::all();
        $academics = AcademicLevel::all();
        $papers = paper::all();
        $prices = Price::all();
         return view('admins.prices.index', compact('services', 'academics','papers', 'prices'));
    }

    public function price_list(){
        $services = Service::all();
        $academics = AcademicLevel::all();
        $papers = paper::all();
        $prices = Price::all();
        
         return view('admins.prices.list',compact('services', 'academics', 'prices', 'papers'));
    }
    
        public function admin_delete_price(Request $request){
        $id=$request->price;
        if(Price::Find($id)->delete()){
            return redirect()->back()->with('message', 'Price Deleted Successfully!');
        }
    }

    public function store_price(Request $request){
       
        $this->validate($request, [
            'service' => 'required',
            'academics' => 'required',
            'duration' => 'required',
            'days_or_hours' => 'required',
            'pricefield' => 'required',
            'papertype' => 'required',
        ]);

        $service = $request->service;
        $academics = $request->academics;
        $urgency_value = $request->duration;
        $hour_or_day = $request->days_or_hours;
        $pricefield = $request->pricefield;
        $paper = $request->papertype;
        $price_availability = Price::where('service_id', $service)->where('academic_level_id', $academics)->where('urgency_value', $urgency_value)->where('urgency_hour_or_day', $hour_or_day)->where('price', $pricefield)->first();

        if($price_availability) {
        return redirect()->back()->with('message', 'Price already Available!');
            

        }

        // $urgency_obj = new urgency;
        // $urgency_obj->service_id = $service;
        // $urgency_obj->academic_level_id = $academics;
        // $urgency_obj->paper_id = $paper;
        // $urgency_obj->value = $urgency_value;
        // $urgency_obj->hour_or_day = $hour_or_day;
        // $urgency_obj->save();


        $obj = new Price();

        $obj->service_id = $service;
        $obj->academic_level_id = $academics;
        $obj->urgency_value = $urgency_value;
        $obj->urgency_hour_or_day = $hour_or_day;
        $obj->paper_id = $paper;
        $obj->price = $pricefield;

        $success = $obj->save();  
        if($success){

        return redirect()->back()->with('message', 'price added successfully!');
        }else{

        return redirect()->back()->with('error', 'Unable to Update Price');
        
        }

    }
}
