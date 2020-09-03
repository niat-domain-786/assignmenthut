<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.png">
        <!-- App title -->
        <title>Collar - Easy to search</title>

        <!-- App css -->
        <link href="{{ url('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('public/assets/css/core.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('public/assets/css/components.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('public/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('public/assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('public/assets/css/menu.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('public/assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ url('public/assets/css/style.css') }}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="{{ url('public/assets/js/modernizr.min.js') }}"></script>

    </head>


    <body class="bg-transparent">

        <!-- HOME -->
        <section>
            <div class="container-alt">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

                            <div class="m-t-40 account-pages">
                                <div class="text-center account-logo-box">
                                    <h2 class="text-uppercase">
                                        <a href="/" class="text-success">
                                            <span><img src="{{ url('public/assets/images/logo.png') }}" alt="" height="36"></span>
                                        </a>
                                    </h2>
                                    <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                                </div>
                                <div class="account-content">
                                    @if($errors->any())

                                        <div class="alert alert-danger">

                                            <ul>

                                                @foreach($errors->all() as $error)

                                                    <li> {{$error}} </li>

                                                @endforeach

                                            </ul>

                                        </div>

                                    @endif
                                    {{-- <form class="form-horizontal" action="#"> --}}
                                     {!! Form::open(array('url'=>'/auth/login','id'=>'login-form','class'=> 'form-horizontal')) !!}

                                        <div class="form-group ">
                                            <div class="col-xs-12">
                                                <input class="form-control" type="email" required="" placeholder="Email" name="email">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <input class="form-control" type="password" required="" placeholder="Password" name="password">
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <div class="col-xs-12">
                                                <div class="checkbox checkbox-success">
                                                    <input id="checkbox-signup" type="checkbox" checked>
                                                    <label for="checkbox-signup">
                                                        Remember me
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group text-center m-t-30">
                                            <div class="col-sm-12">
                                                <a href="page-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                                            </div>
                                        </div>

                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit">Log In</button>
                                            </div>
                                        </div>

                                    </form>

                                    <div class="clearfix"></div>

                                </div>
                            </div>
                            <!-- end card-box-->

                            <div class="row m-t-50 hide">
                                <div class="col-sm-12 text-center">
                                    <p class="text-muted">Don't have an account? <a href="page-register.html" class="text-primary m-l-5"><b>Sign Up</b></a></p>
                                </div>
                            </div>

                        </div>
                        <!-- end wrapper -->

                    </div>
                </div>
            </div>
          </section>
          <!-- END HOME -->

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="{{ url('public/assets/js/jquery.min.js') }}"></script>
        <script src="{{ url('public/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ url('public/assets/js/detect.js') }}"></script>
        <script src="{{ url('public/assets/js/fastclick.js') }}"></script>
        <script src="{{ url('public/assets/js/jquery.blockUI.js') }}"></script>
        <script src="{{ url('public/assets/js/waves.js') }}"></script>
        <script src="{{ url('public/assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ url('public/assets/js/jquery.scrollTo.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ url('public/assets/js/jquery.core.js') }}"></script>
        <script src="{{ url('public/assets/js/jquery.app.js') }}"></script>

    </body>
</html>
