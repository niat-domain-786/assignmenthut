<?php

namespace App\Http\Controllers\Admin;

use App\AcademicLevel;
use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AcademicLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $academics = AcademicLevel::all();

        return view('admins.academic-level.index', compact('academics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $services = Service::all();
        return view('admins.academic-level.create');
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
            'name' => 'required|string|unique:academic_levels,name',
         
        ]);

        $academics = new AcademicLevel;
        $academics->name = $request->name;

        $academics->save();

        return redirect()->route('admin.academic-level.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admins.academic-level.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicLevel $academicLevel)
    {

        // $services = Service::all();
        
        return view('admins.academic-level.edit', compact('academicLevel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcademicLevel $academicLevel)
    {


        $this->validate($request, [
            'name' => 'required|string',
           
            
        ]);

        $academicLevel->name = $request->name;
        // $academicLevel->service_id = $request->service;
        $academicLevel->save();

        return redirect()->route('admin.academic-level.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $academics= AcademicLevel::Find($id);
        $academics->delete();

        return redirect()->route('admin.academic-level.index');
    }
}
