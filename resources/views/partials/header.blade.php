

    <!-- Start: Header Section -->
    <header id="header" class="header"  style="  position: sticky;
    width: 100%;
    left: 0;
    top: 0;
    z-index: 100000;
    border-top: 0;
    margin-bottom:1px;">

        <div class="header-top bg-theme-color-2 sm-text-center p-0">
       
            <div class="container">
                <div class="row">
                    <!--<div class="col-md-4">-->
                    <!--    <div class="widget no-border m-0">-->
                    <!--        <ul class="styled-icons icon-circled icon-sm flip sm-pull-none sm-text-center mt-sm-15">-->
                    <!--            <li><a href="#"><i class="fa fa-facebook text-white"></i></a></li>-->
                    <!--            <li><a href="#"><i class="fa fa-instagram text-white"></i></a></li>-->
                    <!--            <li><a href="#"><i class="fa fa-twitter text-white"></i></a></li>-->
                    <!--        </ul>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="col-md-12">
                        
                    <div class="col-md-6 ">
                      <nav >
                        <a class="menuzord-brand pull-left flip mt-15" href="{{url('/')}}"><img src="{{asset('assets/wide-logo.png')}}" alt="" style="width: 250px;"></a>
                    </nav>
                    </div>
                        <div class="widget m-0 pull-right sm-pull-none sm-text-center">
                            <ul class="list-inline font-13 sm-text-center mt-5">
                                @auth
                                
                                
                              <!-- Example single danger button -->

<div class="dropdown hidden-sm hidden-xs">
  <button class="btn btn-default dropdown-toggle px-1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style=" margin-top:5%; ">
    
     @if(Auth::User()->profile_image == "sample_img.jpg")
                            <img src='{{ asset("public/files/profile/sample_img.jpg") }}' alt="profile image" width="25px" class="img-circle"> &nbsp; 

                            @else

                             <img src='{{ asset(str_replace('public', '/storage',Auth::User()->profile_image)) }}' alt="profile image" width="25px" class="img-circle"> &nbsp; 
                            @endif
                             {{ Auth::User()->name }}
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
       <li><a href="{{ url('/home')}}">Dashboard</a></li>
       
           @can('isUser')
    <li><a href="{{url('/order/create')}}">Order Assignment</a></li>
{{--     <li role="separator" class="divider"></li> --}}
    <li><a href="{{url('/profile')}}">Settings</a></li>
    @endcan
   
                                    <li class="hidden-sm hidden-xs">
                                        <a  href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form-top').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form-top" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
   

  </ul>
</div>

                                     
                                {{--   <li class="hidden-sm hidden-xs"><a class="text-white" href="/home">Dashboard</a></li> --}}
                                    {{--@can('isUser')--}}
                                    <!--<li class="hidden-sm hidden-xs">-->
                                 
                                    <!-- <a  class="text-white" href="/order/create">-->
                                    <!--    <i class="glyphicon glyphicon glyphicon-plus"></i>-->
                                    <!--Order New </a>-->
                                    <!--</li>-->
                                    {{--@endcan--}}


                                   
  


                                @else
                                    <!--<li class="hidden-sm hidden-xs"><a class="text-white" href="/register">Register</a></li>-->
                                    <!--<li class="text-white hidden-sm hidden-xs">|</li>-->
                                    <li class="hidden-sm hidden-xs">
                                        <a class="text-white" href="{{url('/login')}}"><i class="fa fa-sign-in"></i>&nbsp; &nbsp; Login</a></li>
                             
                                @endauth

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-nav">
            <div class="header-nav-wrapper navbar-scrolltofixed bg-lightest">
                <div class="container">
                    <nav id="menuzord-right" class="menuzord orange">
                       {{--  <a class="menuzord-brand pull-left flip mt-15" href="{{url('/')}}"><img src="{{asset('assets/wide-logo.png')}}" alt="" style="width: 250px;"></a> --}}
                        <ul class="menuzord-menu dark">
                            <li @if (\Request::is('/')) class="active" @endif><a href="{{url('/')}}">Home</a></li>

                            {{-- <li @if (\Request::is('prices')) class="active" @endif><a href="{{url('/prices')}}">Prices</a></li> --}}

                            
                            <li @if (\Request::is('services')) class="active" @endif>
                                <a href="#">Services </a>
                                <ul class="dropdown">
                                    <li><a href="{{url('/business-management-assignment-help')}}">Business Management</a></li>
                                    <li><a href="{{url('/information-technology-assignment-help')}}">Information Technology</a></li>
                                    <li><a href="{{url('/law-assignment-help')}}">Law Assignment</a></li>
                                    <li><a href="{{url('/management-assignment-help')}}">Management Assignment</a></li>
                                    <li><a href="{{url('/marketing-assignment-help')}}">Marketing Assignment</a></li>
                                    <li><a href="{{url('/project-management-assignment-help')}}">Project Management</a></li>
                                    <li><a href="{{url('/psychology-assignment-help')}}">Psychology Assignment</a></li>
                                    <li><a href="{{url('/statistics-assignment-help')}}">Statistics Assignment</a></li>
                                   
                                    {{-- <li><a href="{{url('/services')}}">Dissertation</a></li> --}}
                                </ul>
                            </li>

                              <li @if (\Request::is('careers')) class="active" @endif><a href="{{url('/careers')}}">Careers</a></li>

                            <li @if (\Request::is('about')) class="active" @endif><a href="{{url('/about')}}">About Us</a></li>

                          
                            <li @if (\Request::is('contact')) class="active" @endif><a href="{{url('/contact')}}">Contact Us</a></li>
                            @auth
                                <li class="hidden-md hidden-lg">
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                 document.getElementById('logout-form-nav').submit();">
                                        {{ __('Logout') }}
                                    </a>
            <form id="logout-form-nav" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>


                            @else
                                <li class="hidden-md hidden-lg"><a href="{{url('/login')}}">Login</a></li>
                                <li class="hidden-md hidden-lg"><a href="{{url('/register')}}">Register</a></li>
                             
                            @endauth

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- End: Header Section -->
