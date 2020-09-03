@extends('layouts.master')


@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Paypal</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('paypal.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Amount To Pay</label>

                            <div class="col-md-6"> 
                                <input id="price" type="number" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ old('price') }}" required autofocus min="1" max="10000" style="padding-left: 50px;">
                                <span style="position: relative;top: -29px;left: 10px;">AUD</span>

                            </div>
                        </div>                        

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Pay Now
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
                            <div class="text-center mb-30"><a href="./" class=""><img alt="" src="assets/images/logo-wide.png" style="width:300px"></a></div>
                            <div class="col-md-6 col-md-push-3">
                                <div class="shadow-md p-20">
                                    <h2 class="text-theme-colored mt-0 pt-5 text-center"> Send Payment</h2>
                                    <hr>
                                    {{-- <p>Lorem ipsum dolor sit amet, consectetur elit.</p> --}}
                                    <form name="login-form" class="clearfix" method="POST" action="{{ route('paypal.store') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                @if (session('status'))
                                                    <div class="alert alert-success" role="alert">
                                                        {{ session('status') }}
                                                    </div>
                                                @endif
                                                @if ($errors->has('email'))
                                                    <div class="invalid-feedback" role="alert">
                                                        <strong style="color:red">{{ $errors->first('email') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="form_username_email">Amount To Pay ( AUD )</label>
                                                <input id="form_username_email" name="price" class="form-control" type="number" required autofocus min="1">
                                            </div>
                                        </div>
                                        <div class="clear text-center pt-10">
                                            <button class="btn btn-dark btn-lg btn-block mt-15" type="submit">Pay Now</button>

                                            {{-- <p class="pt-5"> <b>Don't have an Account?</b> <a href="/register">Register Now.</a></p> --}}
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