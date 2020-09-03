<?php

namespace App\Http\Controllers;

use App\AcademicLevel;
use App\Currency;
use App\Price;
use App\Service;
use App\paper;
use App\urgency;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::where('disable', 0)->get();
        $academics = AcademicLevel::all();
        $currencies = Currency::all();
        $papers = paper::all();
        $all_prices = Price::all();
 

        return view('index', compact( 'currencies','academics', 'services', 'papers','all_prices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        //
    }

    // index page data
    public function get_paper_list(Request $request)
    {
        
        return response()->json(paper::whereIn('id', explode(',', $request->ids))->get()->toArray());
        //$paperlist = array();
        //$arr = array(str_split($request->ids));
        // $paperIDs = $request->toArray();
    

            // foreach($arr  as $key => $paperID) {
            // $paper = paper::find($paperID);
            // $paperlist[$key] =  $paper;
            // }

    }


    public function get_academics(Request $request)
    {
        return response()->json(AcademicLevel::whereIn('id', explode(',', $request->ids))->get()->toArray());
    }


    public function get_urgency(Request $request)
    {
        return response()->json(Price::whereIn('id', explode(',', $request->ids))->get()->toArray());
    }
}
