<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '!=', 1)->get();

        return view('admins.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admins.users.create');
    }

    public function change_email_request()
    {
        $users = User::where('change_email_request', '!=', '0')->get();

        return view('admins.users.change_email', compact('users'));
    }

    public function approve_email_request(Request $request)
    {
        $user = User::Find($request->id);
        $user->email = $user->change_email_request;
        $user->change_email_request = '0';
        $user->email_verified_at = null;
       if($user->save()) {
        return redirect()->back()->with('success','Email Approved');
       }
        return redirect()->back();


       
    }

    public function reject_email_request(Request $request)
    {
        $user = User::Find($request->id);

        $user->change_email_request = '0';

       if($user->save()) {
        return redirect()->back()->with('success','Email Rejected');
       }
        return redirect()->back();
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
            'name' => 'nullable|string',
            'email' => 'required|unique:users',
            'phone' => 'nullable',
            'password' => 'nullable',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->email_verified_at = $request->verified ? Carbon::now() : null;
        $user->save();

        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        return view('admins.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
         //$email_request_count = User::where('change_email_request', '!=', '0')->count();

        return view('admins.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable',
            'password' => 'nullable',
        ]);

        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('username')) {
            $user->username = $request->username;
        }

        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }

        if ($request->has('email') && $user->email != $request->email) {
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($user->email_verified_at && !$request->verified) {
            $user->email_verified_at = null;
        } else if (!$user->email_verified_at && $request->verified) {
            $user->email_verified_at = Carbon::now();
        }

        $user->save();


        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.user.index');
    }
}
