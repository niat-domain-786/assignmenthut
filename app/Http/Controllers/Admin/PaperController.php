<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Service;
use App\paper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $papers = paper::all();
    

        return view('admins.papers.index', compact('papers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $papers = paper::all();
       
        return view('admins.papers.create', compact('papers'));
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
            'name' => 'required|string',
         
            // 'price' => 'required|integer',
            // 'category_id' => 'required|exists:categories,id'
        ]);
       // return response()->json($request);

        $paper = new paper;
        $paper->name = $request->name;
      
        // $paper->price = $request->price;
        // $paper->category_id = $request->category_id;
        $paper->save();

        return redirect()->route('admin.paper.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(paper $paper)
    {
        return view('admins.papers.show', compact('paper'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $papers = paper::find($id);
       
        return view('admins.papers.edit', compact('papers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


        $this->validate($request, [
            'name' => 'required|string',
          
            // 'price' => 'required|integer',
            // 'category_id' => 'required|string|exists:categories,id',
        ]);
        $paper = paper::find($request->paperID);

        $paper->name = $request->name;
        //$paper->service_id = $request->service;

        $paper->save();

        return redirect()->route('admin.paper.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(paper $paper)
    {
        $paper->delete();

        return redirect()->route('admin.paper.index');
    }
}
