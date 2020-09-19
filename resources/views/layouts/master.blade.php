<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <!-- Meta Tags -->
        <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        
        <!-- Favicon and Touch Icons -->
        <link href="{{asset('assets/images/favicon.ico')}}" rel="shortcut icon" type="image/png">
         
        <!-- Page Title -->
        <title>Home - AssignmentHut</title>

        <style>
          {{-- pages --}}
  div .separator{
    display:none !important;
  } 

  .widget .services-list li.active::after {
    border-color: #0000 #ff853f00 #0000 #0000 !important;
}

.scrollToTop{
    display:none !important;
}



  /*pages end*/


#livechat-compact-container {
  height: 153px;
  position: fixed;
  right: 0;
  top: 200px;
  top: 85vh;
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

          .menuzord-menu.menuzord-right {
    float: left !important;
}
@media (max-width: 900px){
    .menuzord-responsive{
        margin-bottom:5%;
    }
}
            .main-content{
                flex-grow: 1;
            }

            .bg-theme-color-2, .line-bottom:after, .line-bottom-center:after {

    height: 70px;
  }
  .widget ul li {

    margin-top: 15px;

}
        </style>
        @include('partials.style') 
        
        @yield('styles')
        

    </head>
    <body class="">
        <div id="wrapper" class="clearfix" style="    display: flex;    min-height: 100vh;    flex-direction: column;"> 

            @include('partials.header')


                <!-- Start: Main Content -->
                @yield('content')

            @include('partials.footer')

        </div>


        @include('partials.script')

        @yield('scripts')
        @stack('checkout-scripts')
   

        <script src="//code.tidio.co/dmjjxnz89cgacgfwvaultraxxosidnqw.js" async></script>
        {{-- {!! TidioChat::js() !!} --}}
       
    </body> 
</html>