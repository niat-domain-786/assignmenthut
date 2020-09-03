@extends('admins.layouts.master')


@section('content')


    <div class="row" style="margin-top: 50px;">
        <div class="col-md-8 "> 
        <div class="container  shadow" style="background-color:#fff;">
            <h2>Admin profile information</h2>

        <div class="col-md-12">
            @if(session('success'))
                        <span role="alert" class="alert alert-success col-md-8">{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button></span>
                        @endif 

                        @if(session('error'))
                        <span role="alert" class="alert alert-danger col-md-8">{{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button></span>
                        @endif
                    </div>
            <hr>

            <form action="{{ route('admin.settings.store') }}" class="form-group" method="POST">
                @csrf

            <input type="hidden" name="setting_id" value="1">
            <p><strong>Name</strong>:{{Auth::User()->name }} </p> 

            <input type="text"  name="name" class="form-control  col-md-6 {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ Auth::User()->name }}" style="font-size:1.8rem;" required>
 @if ($errors->has('name'))
        <span class="invalid-feedback text-danger" role="alert">
        <strong>{{ $errors->first('name') }}</strong>
        </span>
  @endif

            <p><strong>Email</strong>: {{Auth::User()->email }} </p>

            <input type="text"  name="email" class="form-control col-md-6 {{ $errors->has('email') ? ' is-invalid' : '' }} " value="{{Auth::User()->email }}" style="font-size:1.8rem;" required>
 @if ($errors->has('email'))
        <span class="invalid-feedback text-danger" role="alert">
        <strong>{{ $errors->first('email') }}</strong>
        </span>
  @endif

            <button type="submit" name="submit" class="btn btn-primary" style="margin:20px 0px;" href="">Update Name Or Email</button> 

            </form>
        </div>           
            <hr>

            <div class="container  shadow" style="background-color:#fff;">
            <h2>Change Password</h2>
            <hr>
            <form action="{{ route('admin.settings.store') }}" class="form-group" method="POST">
                @csrf
                <input type="hidden" name="setting_id" value="2">

            <p><strong>Current Password</strong>: </p> <input type="password" class="form-control col-md-6 {{ $errors->has('oldPassword') ? ' is-invalid' : '' }}" placeholder="current password" style="font-size:1.8rem;" name="oldPassword" required>

                                @if ($errors->has('oldPassword'))
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $errors->first('oldPassword') }}</strong>
                                    </span>
                                @endif

            <p><strong>New Password </strong>: </p><input type="password" name="password" class="form-control col-md-6 {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="New Password" style="font-size:1.8rem;"  required>

           
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

            <p><strong>Repeate Password</strong>: </p>
            <div><input type="password" class=" col-md-6 form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="Repeat New Password" style="font-size:1.8rem;" name="password_confirmation" required>
    @if ($errors->has('password_confirmation'))
    <span class="invalid-feedback text-danger" role="alert">
        <strong>{{ $errors->first('password_confirmation') }}</strong>
    </span>
     @endif
            </div>
            
           <div> <button type="submit" name="submit" class="btn btn-primary" style="margin:20px 0px;">Update Password</button>  </div>          
            </form>
        </div>           
            <hr>   


            <div class="container  shadow" style="background-color:#fff;">
            <h2>Upload Profile Picture</h2>
            <hr>
            <form action="{{ route('admin.settings.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                @csrf
            <input type="hidden" name="setting_id" value="3">

            
            <p><strong>New Profile Picture</strong>: </p>
            <div class="col-md-8"><input type="file" class="form-control  btn btn-success {{ $errors->has('oldPassword') ? ' is-invalid' : '' }}" name="file" style="font-size:1.8rem;">

 @if ($errors->has('file'))
        <span class="invalid-feedback text-danger" role="alert">
        <strong>{{ $errors->first('file') }}</strong>
        </span>
  @endif
            <button type="submit" name="submit" class="btn btn-primary" style="margin:20px 0px;">Update Profile Picture</button>    </div>        
            </form>
        </div>           
            <hr>  

        <div class="col-md-12" style="background-color:#fff;"> 


        <h2>Paypal Keys</h2>
            <hr>
                  @if($errors->any())

                            <ul class="alert">

                                @foreach($errors->all() as $error)

                                <li style="color:red;"><b>{{ $error }}</b></li>

                                @endforeach

                            </ul>

                        @endif
           
             
                <h3>Active Paypal Key: {{$keys->name ?? '' }}</h3>
                <h3>Paypal Mode: {{$keys->mode ?? ''}}</h3>
                <hr>
                <br>
                <br>
                        <div class="container">
                <form action="{{ route('activate_paypal_keys') }}" method="POST">
                    @csrf
                <h3>Select active paypal keys</h3>
                <select name="activatekeys" id="" class="form-control">
                    <option value="">Select keys to activate</option>
                    @foreach($allkeys as $list)
                    <option value="{{$list->id ?? ''}}">{{$list->name ?? ""}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary" style="margin:20px 0px;">Activate</button>
                </form>
            </div>
            <hr>
             <form action="{{ route('admin.update-paypal-keys') }}" method="POST" class="form-group">

                @csrf
                <h3>Add new Key</h3>
                <label for="name">Name</label>
                <input type="text" class="form-control" name = "name" value="{{$keys->name ?? ''}}">
                <label for="clientId">Client Id</label>
                <input type="text" name="clientId" class="form-control"  value="{{ $keys->client_id ?? ""}}" style="padding:10px; margin:15px 0px; font-size:1.5rem;">

                <label for="secretId">Secret Id</label>

                <input type="text" name="secretId" class="form-control"  value="{{$keys->secret_id ?? ""}}" style="padding:10px; margin:15px 0px; font-size:1.5rem;">
                <label for="mode">Mode</label>

                <select name ="mode" class="form-control" style="margin:20px 1px;">
                    <option value=""> Select Mode</option>
                    <option value="sandbox">Sandbox</option>
                    <option value="live"> Live</option>
                </select>
                

                <button type="submit" name="submit" class="btn btn-primary">Add Paypal keys</button>
            </form>
    
            
          
        </div>        
    </div> 
@stop
