@extends('layouts.master')
@section('content')

@section('styles')
<style>
body{
    margin:0px !important;
}

</style>
<link rel="stylesheet" href="{{asset('intl-tel-input/build/css/intlTelInput.css')}}">
<link rel="stylesheet" href="{{asset('intl-tel-input/build/css/demo.css')}}">

<style>
    .iti__flag {background-image: url("{{asset('intl-tel-input/build/img/flags.png')}}");}
 
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
  .iti__flag {background-image: url("{{asset('intl-tel-input/build/img/flags@2x.png')}}");}
}
</style>
<script
  src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="{{asset('intl-tel-input/build/js/intlTelInput-jquery.js')}}"></script>

@endsection

    <!-- Section: home -->
    <section class="">
        <div class="container">


            <div class="row profile">
                <div class="col-md-3" style="margin-bottom: 30px;">
      @include('order.user_sidebar')
                </div>

                <div class="col-md-8">

 

    

<div class="container">


     <div class="col-md-9">
            @if (session('success'))
            <div class="alert alert-success col-md-12" role="alert" >
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        {{ session('error') }}
            </div>
        @endif
        <div class="shadow-md" style="padding:20px;">
       
    

              @if($errors->any())
                    @foreach ($errors->all() as $error)
                      

                          <div class="alert alert-danger" role="alert" style="border-radius: 25px;">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        {{ $error }}
            </div>
                    @endforeach
                @endif


            <h3>Personal information</h3>
            <hr>



            <form action="{{ route('update_user_info') }}" class="form-group" method="POST">
                @csrf
                <label for="f-name">First Name</label>
                <input type="text" name="firstname"  class="form-control" value="{{Auth::User()->name}}" required>

                <label for="l-name">Last Name</label>
                <input type="text" name="lastname"  class="form-control" value="{{Auth::User()->lastname}}" required>

                
                <input type="submit" value="Update Personal Info" class="btn btn-sm btn-success px-3" style="border-radius: 20px; margin-top:20px;" >

            </form>

            <hr>
            <h3>Request To Change Email</h3>
            <form action="{{ url('user/request_change_email') }}" method="POST">
                @csrf
                <strong>Current Email: </strong>{{ Auth::User()->email }}
                <br>
                @if( !(Auth::User()->change_email_request == "0") )
              <strong>Requested Email: </strong>{{ Auth::User()->change_email_request ?? "No Email Selected" }}
                <a href="{{ url('user/cancel_email_request') }}"><span class="btn btn-sm btn-link">Cancel Request</span></a>
                <br>
                @endif

                <h4>New e-mail</h4>
                
                <input type="email" name="email" class="form-control"  value="" >
                <input type="submit" value="Request Now" class="btn btn-sm btn-success px-3" style="border-radius: 20px; margin-top:20px;" >

            </form>

            <hr>         
            <form action="{{route('update-user-phone')}}" method="POST">
                @csrf
                <h3>Phone Number</h3>
                <h5>{{Auth::User()->phone}}</h5>
               <input type="tel" id="phonenumber" name="phonenumber" class="form-control" onInput="display(event)">
               <button type="submit"   class="btn btn-sm btn-success px-3 my-3" style="border-radius: 20px; margin:10px;" >Update</button>
              

      

            </form>

            <div><hr>
            <h3>Update Profile picture.</h3>
            <form action="{{route('update-profile-image')}}" class="form-group" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="profile_image">
                <input type="submit" value="Upload Profile Image" class="btn btn-sm btn-success px-3" style="border-radius: 20px; margin-top:20px;">
                
            </form>
        </div>

            <hr>

            <div>
            <h3>Change Password</h3>
              

                <form action="{{route('change_password')}}" method="POST">
                    @csrf
                <label for="old_password">Old Password</label>
                <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror"  value=""  >
                
          {{--           @error('old_password')
                    <p class="text-danger">{{ $message ?? " " }}</p>
                    @enderror
 --}}

                <label for="password">New Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"  value="" >
          {{--           @error('password')
                    <p class="text-danger">{{ $message ?? " " }}</p>
                    @enderror --}}


                <label for="password_confirmation">Repeat Password</label>
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"  value="" >
              
            {{--         @error('password_confirmation')
                    <p class="text-danger">{{ $message ?? " " }}</p>
                    @enderror
 --}}


           
                    
                <input type="submit" value="Change Password"  class="btn btn-sm btn-success px-3" style="border-radius: 20px; margin-top:20px;">
            

                </form>
                </div>
            </div>
            <hr>

          

        </div>
    </div>



                </div>
            </div>
        </div>
    </section>

    @section('scripts')


    <script src="{{asset('intl-tel-input/build/js/intlTelInput.js')}}"></script>
    <script src="{{asset('intl-tel-input/build/js/utils.js')}}"></script>
    {{-- <script src="{{asset('intl-tel-input/build/js/data.js')}}"></script> --}}
    <script>
      var input = document.querySelector("#phonenumber");

    
      var iti =window.intlTelInput(input, {         
 // any initialisation options go here
        utilsScript:'{{asset('intl-tel-input/build/js/utils.js')}}',
        hiddenInput:'full_phone',
        nationalMode:false,
        autoHideDialCode:false,

      });
      

    </script>
     



    @endsection

@endsection
