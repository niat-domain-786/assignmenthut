@extends('layouts.master')

@section('content')

    <div class="main-content">
                <!-- Section: home -->
        <section id="home" class="divider bg-lighter">
            <div class="display-table">
                <div class="display-table-cell">
                    <div class="container">
    @if(session('message'))
   <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Message: </strong> {{ session('message') }}
</div>
@endif

    @if(session('error'))
   <div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error: </strong> {{ session('error') }}
</div>
@endif

                        <div class="row">
                    
                            <div class="col-md-4 col-md-push-4">
                                <div class="shadow-md p-20">
                      

                                    <h2 class="text-theme-colored mt-0 pt-5 text-center"> Login</h2>
                                    <hr>
                                    {{-- <p>Lorem ipsum dolor sit amet, consectetur elit.</p> --}}
                                    <form name="login-form" class="clearfix" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                @if ($errors->has('email'))
                                                    <div class="invalid-feedback" role="alert">
                                                        <strong style="color:red">{{ $errors->first('email') }}</strong>
                                                    </div>
                                                @endif
                                                @if ($errors->has('password'))
                                                    <div class="invalid-feedback" role="alert">
                                                        <strong style="color:red">{{ $errors->first('password') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="form_username_email">Email</label>
                                                <input id="form_username_email" name="email" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="form_password">Password</label>
                                                <input id="form_password" name="password" class="form-control" type="password">
                                            </div>
                                        </div>
                                        <div class="checkbox pull-left mt-15">
                                            <label for="form_checkbox">
                                            <input id="form_checkbox" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                            Remember me </label>
                                        </div>
                                        <div class="form-group pull-right mt-10">
                                            <a class="text-theme-colored font-weight-600 font-12" href="{{ route('password.request') }}">Forgot Your Password?</a>
                                        </div> 
                                        <div class="clear text-center pt-10">
                                            <button class="btn btn-dark btn-lg btn-block mt-15" type="submit" style="border-radius:24px;">Login</button>

                                            <p class="pt-5"> <b>Don't have an Account?</b> <a href="{{url('/register')}}">Register Now.</a></p>
                                            <!-- <a class="btn btn-dark btn-lg btn-block no-border mt-15 mb-15" href="#" data-bg-color="#3b5998">Login with facebook</a>
                                            <a class="btn btn-dark btn-lg btn-block no-border" href="#" data-bg-color="#00acee">Login with twitter</a> -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
