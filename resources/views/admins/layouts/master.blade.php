<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">
    <!-- App title -->
    <title>@yield('title',config('app.name', 'Laravel'))</title>
    @yield('styles')
    <style>
    #livechat-compact-container {
    height: 1px;
    position: fixed;
    right: 0;
    top: 200px;
    top: 30vh;
    z-index: 10000;
    display:none !important;
    }
    .btn-chat a {
    font-family: arial;
    color: #fff;
    text-decoration: none;
    background: #1798F7;
    padding: 24px 20px 8px;
    display: block;
    font-weight: bold;
    font-size: 14px;
    box-shadow: 0 0 0 1px #03b2ff inset;
    border: 1px solid #144866;
    border-radius: 2px;
    -ms-transform: rotate(90deg) translate(0, -20px);
    -webkit-transform: rotate(90deg) translate(0, -20px);
    transform: rotate(90deg) translate(0, -20px);
    position: relative;
    right: -27px;
    transition: background 0.2s, right 0.2s;
    }
    .btn-chat a:hover {
    background: #47B6F5;
    right: -20px;
    transition: background 0.2s, right 0.2s;
    }
    .button-menu-mobile {
    right: 0;
    left: auto;
    float: right;
    }
    </style>
    @include('admins.partials.style')
  </head>
  <body class="fixed-left">
    <!-- Begin page -->
    <div id="wrapper">
      
      
      @include('admins.partials.header')
      @include('admins.partials.left-sidebar')
      <div class="content-page">
        <!-- Start content -->
        <div class="content">
          <div class="container">
            @yield('content')
            </div> <!-- container -->
            </div> <!-- content -->
            
            @include('admins.partials.footer')
          </div>
          
          @include('admins.partials.right-sidebar')
        </div>
        <!-- END wrapper -->        
        
        @include('admins.partials.script')
        <script src="{{asset('assets/plugins/waypoints/jquery.waypoints.min.js')}}"></script>
        <script src="{{asset('assets/plugins/counterup/jquery.counterup.min.js')}}"></script>
        <script src="{{asset('assets/plugins/raphael/raphael-min.js')}}"></script>
        @yield('scripts')
      </body>
    </html>