<?php

namespace App\Http\Controllers\Admin;
use Admin;

use App\Http\Controllers\Controller;

use App\User;
use App\assignmentOrder;
use App\order;
use App\payment;
use App\paypalKey;
use Auth;
use Cache;
use Carbon\Carbon;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Redirect;
use Response;
use Session;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;




class SettingController extends Controller
{    
    
    public function index()
    { 
         $keys= paypalKey::where('active', 1)->first();
         $allkeys= paypalKey::all();

        return view('admins.settings.index',compact('keys','allkeys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
        $setting_id = $request->setting_id;

        #setting_id (1) email and name
        #setting_id (2) password setting
        #setting_id (3) profile picture

        switch($setting_id) {

            case '1':

            $name = $request->name;
            $email = $request->email;

             $this->validate($request, [ 
            'name' => 'required',
        
            ]);

            $admin = User::Find(Auth::User()->id);
            if( !($email == $admin->email) ) {

            $this->validate($request, [ 

            'email' => 'required|unique:users',
        
            ]);
            $admin->email = $email;

            }
            $admin->name = $name;
            $updated = $admin->save();
            if($updated) {
                return redirect()->back()->with('success', 'Admin Name or Email Updated');
            }else{
                return redirect()->back()->with('error', 'Failed to Update!');

            }

            break;

            case '2':
            $this->validate($request, [ 
            'oldPassword' => 'required',
            'password' => 'required|confirmed|min:8',
            
            ]);

            $user_id = Auth::User()->id;
            $old_password = $request->oldPassword;
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

                        return redirect()->back()->with('error', "Old password is incorrect");
                        
                    }

            break;

            case '3':

            
            $this->validate($request, [ 
            'file' => 'required|mimes:jpeg,jpg,gif,png|max:200',            
            ]);

            $old_profile_picture = Auth::User()->profile_image;
            $image = time()."-".$request->file('file')->getClientOriginalName();

            $path = $request->file('file')->storeAs('public/files/profile/'.Auth::User()->id, $image);

            // $file = $request->file;
            // $path = $file->store('files', 'public');
            $user = User::find(Auth::User()->id);
            $user->profile_image = $path;
            $updated = $user->save();

            if ($updated) {
                 Storage::delete($old_profile_picture);
                return redirect()->back()->with('success', "Profile Picture Updated");
                } else {

                        return redirect()->back()->with('error', "Failed to update Profile Picture");
                        
                    }

            break;


            default:
            return redirect()->back()->with('error', 'Nothing changed!');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $text = $request->search;
        #$searchTitle = str_replace(" ", '%', $text);

        $results = assignmentOrder::where('id','LIKE', $text)->get();

       return view('admins.search.results')->with('results', $results);

    }


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_password()
    {
        $user= Auth::user();
        return view('admins.settings.passwords.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_password(Request $request)
    {
        $user= Auth::user();

        //validate the data
        $this->validate($request ,array(
            'old_pass' => 'required',
            'new_pass' => 'required|string|confirmed'
        ));
        if (!Auth::attempt(['email' => $user->email, 'password' => $request->old_pass]))
        {
            return Redirect::back()->withErrors(['Your old password is wrong.']);
        }

        $user->password = bcrypt($request->new_pass);
        $user->save();

        Session::flash('success','The password is successfully updated');
        return redirect()->route('admin.setting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function backup()
    {
        // exec('mysqldump -u '.env('DB_USERNAME').' -p'.env('DB_PASSWORD').' helpingtutors > /var/www/laravel/storage/helpingtutors'.$time.'.sql'); 
        $time=Carbon::now()->format('d-M-Y');

        $cmd='mysqldump -u '.config('database.connections.mysql.username').' -p'.config('database.connections.mysql.password').' helpingtutors > /var/www/laravel/storage/helpingtutors'.$time.'.sql';
        // dd($cmd);
        exec($cmd); 
        // dd(Carbon::now()->toDateTimeString());
        // dd(Carbon::now()->format('d-M-Y'));

        return Response::download(storage_path('helpingtutors'.$time.'.sql'));



        // $process = new Process('mysqldump -u root -pqwerty001 helpingtutors > /var/www/laravel/storage/helpingtutors'.Carbon::now()->format('d-M-Y').'.sql');
        // $process->mustRun();         
        

        // dd('test');
    }
    
}
