<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

use App\RequestPayment;
use App\paypalKey;

use Session;
use Redirect;
use DB;

use Carbon\Carbon;

class PaypalController extends Controller
{  
   

    public function update_paypal_keys(Request $request) {
        //return response()->json($request);

         $a = $this->validate($request ,[
            'name' => 'required|string',
            'clientId' => 'required|string',
            'secretId' => 'required|string',       
            'mode' =>'required|string'
        ]);
       

        $clientID = $request->clientId;
        $secretID = $request->secretId;
        $name = $request->name;

        $keys = new paypalKey();
        $keys->name = $name;
        $keys->client_id = $clientID;
        $keys->secret_id = $secretID;
        $keys->active = '0';
        $keys->mode = $request->mode;
        $updated = $keys->save();
        if($updated) {
            return redirect()->back()->with('success', "paypal keys updated!");
        } else{
            return redirect()->back()->with('error', "Failed to update the keys!");

        }
    }
    public function activate_paypal_keys(Request $request) {

        $activatekeys = $request->activatekeys;
        $key = paypalKey::Find($activatekeys);
        #deactive already active key
        $activeKey = PaypalKey::where('active', 1)->first();
        if($activeKey){

        $activeKey->active = '0';
        $activeKey->save();
        }

        #active new key
        $key->active = 1;
        $key->save();
        return redirect()->back()->with('success', "paypal keys activated!");



    }


    public function index()
    {
        $keys= PaypalKey::all();

        return view('admins.settings.index',compact('keys'));
    }

    public function create()
    {
        return view('admins.settings.paypals.create');
    }

    public function store(Request $request)
    {
        $this->validate($request ,[
            'name' => 'required|string|unique:paypal_keys,name',
            'clientid' => 'required|string',
            'clientsecret' => 'required|string',
            'mode' =>'required|string'
        ]);

        $key= new PaypalKey;

        $key->name= $request->name;
        $key->clientid= $request->clientid;
        $key->clientsecret= $request->clientsecret;
        $key->mode= $request->mode;

        $key->is_active=0;

        $key->save();

        Session::flash('success','New Paypal Key has been created!');

        return redirect()->route('admin.paypal.index');
    }

    public function edit($id)
    {
        $key= PaypalKey::findorfail($id);

        return view('admins.settings.paypals.edit',compact('key'));
    }

    public function update(Request $request,$id)
    {
        $key= PaypalKey::findorfail($id);

        if($request->name != $key->name)
        {
            $this->validate($request ,[
                'name' => 'required|string|unique:paypal_keys,name',
                'clientid' => 'required|string',
                'clientsecret' => 'required|string',
                'mode' =>'required|string'

            ]);
        } 
        else
        {
            $this->validate($request ,[
                'clientid' => 'required|string',
                'clientsecret' => 'required|string',
                'mode' =>'required|string'

            ]);
        }        

        $key->name= $request->name;
        $key->clientid= $request->clientid;
        $key->clientsecret= $request->clientsecret;
        $key->mode= $request->mode;


        $key->save();

        Session::flash('success','Paypal Key has been updated!');

        return redirect()->route('admin.paypal.index');
    }

    public function destroy($id)
    {
        $key= PaypalKey::findorfail($id);

        $key->delete();

        Session::flash('success','Paypal Key has been deleted!');

        return redirect()->route('admin.paypal.index');

    }

    public function activate($id)
    {
        $keys= PaypalKey::all();

        foreach($keys as $key)
        {
            if($key->id == $id)
            {
                $key->is_active= 1;
                $key->save();
            }
            else
            {
                $key->is_active= 0;
                $key->save();
            }
        }            

        

        Session::flash('success','Paypal Key has been activated!');

        return Redirect::back();
    }
    
}
