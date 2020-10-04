@extends('layouts.master')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

    <div class="main-content">
                    <!-- Section: home -->
        <section id="home" class="divider bg-lighter">
            <div class="display-table">
                <div class="display-table-cell">
                    <div class="container">
                        <div class="row">
                      {{--       <div class="text-center mb-30"><a href="./" class=""><img alt="" src="assets/images/logo-wide.png" style="width:300px"></a></div> --}}
                            <div class="col-md-6 col-md-push-3">
                                <div class="shadow-md p-20">
                                    <form name="reg-form" class="register-form form-transparent" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="icon-box mb-0 p-0">
                                            {{-- <a href="#" class="icon icon-bordered icon-rounded icon-sm pull-left mb-0 mr-10">
                                            <i class="pe-7s-users"></i>
                                            </a> --}}
                                            <h2 class="text-theme-colored mt-0 pt-5 text-center">Register</h2>
                                        </div>
                                        <hr>
                                        {{-- <p class="text-gray">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi id perspiciatis facilis nulla possimus quasi, amet qui. Ea rerum officia, aspernatur nulla neque nesciunt alias.</p> --}}
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                @if ($errors->has('name'))
                                                    <div class="invalid-feedback" role="alert" >
                                                        <strong style="color:red">{{ $errors->first('name') }}</strong>
                                                    </div>
                                                @endif
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
                                                
                                                <label for="form_name">Name <span style="color:red">*</span></label>
                                                <input name="name" class="form-control" type="text" value="{{ old('name') }}" required autofocus>
                                            </div>
                                        {{--     <div class="form-group col-md-12">
                                                
                                                <label>Phone</label>
                                                <input name="phone" class="form-control" type="text"  value="{{ old('phone') }}">
                                            </div> --}}
                                            <div class="form-group col-md-12">
                                                
                                                <label>Email <span style="color:red">*</span></label>
                                                <input name="email" class="form-control" type="email"  value="{{ old('email') }}" required>
                                            </div>
                                        </div>
                                        {{-- <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="form_choose_username">Choose Username</label>
                                                <input id="form_choose_username" name="form_choose_username" class="form-control" type="text">
                                            </div>
                                        </div> --}}
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                
                                                <label for="form_choose_password">Choose Password <span style="color:red">*</span></label>
                                                <input id="form_choose_password" name="password" class="form-control" type="password"  required>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Confirm Password <span style="color:red">*</span></label>
                                                <input id="form_re_enter_password" name="password_confirmation"  class="form-control" type="password"  required>
                                            </div>
                                        </div>
                                        <div class="form-group text-center">
                                            <button class="btn btn-dark btn-lg btn-block mt-15" type="submit" style="border-radius:24px;">Register Now</button>
                                            <p class="pt-5"> <b>Have an account already?</b> <a href="{{url('login')}}">Login Now.</a></p>
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
