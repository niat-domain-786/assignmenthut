<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $services = Service::all();
        $services = Service::where('disable', 0)->get();
        $disabled_services = Service::where('disable', 1)->get();


    return view('admins.services.index',compact('services', 'disabled_services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->validate($request,[
            'name' => 'required|unique:services,name',
        ]);

        $service = new Service;
        $service->name = $request->name;
        $service->save();

        
        return redirect()->route('admin.service.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return view('admins.services.show',compact('services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('admins.services.edit',compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        
        if($service->name == $request->name)
        {
            return redirect()->route('admin.service.index');
        }

        $this->validate($request,[
            'name' => 'required|string|unique:services,name',
        ]);
        
        $service->name = $request->name;
        $service->save();

        return redirect()->route('admin.service.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\subject  $subject enable_service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        // $service->delete();
         $service->disable = '1';
        $service->save();


        return redirect()->route('admin.service.index');

    }
    
        public function enable_service(Request $request)
    {
        // return $request->id;
        // $service->delete();
        $service = Service::Find($request->id);
        $service->disable = '0';
        $service->save();


        return redirect()->route('admin.service.index');

    }
}
