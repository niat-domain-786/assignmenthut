<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Http\storeAs;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class SettingController extends Controller
{
    // all the settings related to user


    public function update_user_info(Request $request) {
       // return response()->json($request);
    	
    	$user = User::FindOrFail(Auth::User()->id);

    	if($user) {
    		$user->name = $request->firstname;
            $user->lastname = $request->lastname;

	   // 		if( !($request->email == Auth::User()->email) ) {

	   // 		$user->email = $request->email;
	   // 		$user->email_verified_at = Null;
	   // 		$user->save();
	   // 		return redirect()->back()->with('success', 'Email Updated, Please verify new email');
	   // 		}

    		$user->save();
    		return redirect()->back()->with('success', 'Name  Updated.');

    	}
    	return redirect()->back()->with('error', 'Sorry something went wrong!');

    }

    #update user password
    public function change_password(Request $request) {

    	 $valid = $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);



    	$user_id = Auth::User()->id;
    	$old_password = $request->old_password;
    	$new_password = $request->password;		

        $user = User::Find($user_id);
        $hashed_password = Hash::make($new_password);

	    	if (Hash::check($old_password, $user->password)) {
        		$user->password = $hashed_password;	    		
       			$updated = $user->save();
       			if ($updated) {
       			return redirect()->back()->with('success', "Password Updated");
       			}
	    	} else {

       			return redirect()->back()->with('error', "The old passwords is incorrect");
	    		
	    	}


    }

    #request to change the email of user
    public function request_change_email(Request $request) {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email'
        ]);

        $new_email = $request->email;
        if($new_email == Auth::User()->change_email_request) {
            return redirect()->back()->with('error', 'This Email Already Sent In Request');
        }

        $user = User::Find(Auth::User()->id);
        $user->change_email_request = $new_email;
        $requested = $user->save();
        if($requested) {
            return redirect()->back()->with('success', 'Request to change the email successfully sent to admin');

        }
            return redirect()->back()->with('error', 'Failed to request, Please try again');


    }

    #request to change the email of user
    public function cancel_email_request(Request $request) {    

        $user = User::Find(Auth::User()->id);
        $user->change_email_request = '0';
        $requested = $user->save();
        if($requested) {
            return redirect()->back()->with('success', 'Your Request Canceled');

        }
            return redirect()->back()->with('error', 'Failed to request, Please try again');


    }


    #update user password
    public function update_profile_image(Request $request) {

        $old_profile_picture = Auth::User()->profile_image;

        $image = $request->file('profile_image')->getClientOriginalName();
        // dd($old_profile_picture." --- ".$image);

    	$path = $request->file('profile_image')->storeAs('public/files/profile/'.Auth::User()->id, $image);
  

    	$user = User::Find(Auth::User()->id);

    	$user->profile_image = $path;
    	$save = $user->save();
    	if ($save) {
             //dd(Storage::delete($old_profile_picture));
            Storage::delete($old_profile_picture);
    		return redirect()->back()->with('success', 'Profile Image Updated!');
    	} else {
    		return redirect()->back()->with('error', 'Profile Image Not Updated!');

    	}
    }

    #update user phone number
    public function update_user_phone(Request $request) {


        $user = User::Find(Auth::User()->id);

        $user->phone = $request->phonenumber;
        $save = $user->save();
        if ($save) {
            return redirect()->back()->with('success', 'Phone No Updated!');
        } else {
            return redirect()->back()->with('error', 'Sorry Phone No Not Updated!');

        }
    }
}
