
<div class="topbar" style="background-color: #09a9f7 !important;">


    <!-- LOGO -->
    <div class="topbar-left" style="background: transparent;">
        {{-- <a href="#" class="logo"><span>Zir<span>cos</span></span><i class="mdi mdi-cube"></i></a>
           <div class="col-md-6 ">
                      <nav >
                        <a class="menuzord-brand pull-left flip mt-15" href="{{url('/')}}"><img src="{{asset('assets/wide-logo.png')}}" alt="" style="width: 250px;"></a>
                    </nav>
                    </div>
        
        
        --}}
        <!-- Image logo -->
        <a href="{{url('/')}}" class="logo">
            <span style="color:white;font-weight: bold;">
                <img src="{{asset('assets/wide-logo.png')}}" alt="" height="30"> 
            {{--    {{ config('app.name', 'Laravel') }}   --}}
            </span>
            <i style="color:white;font-weight: bold;letter-spacing: 0.3em;font-size: 1.5em;">
                <img src="{{asset('assets/icon.png')}}" alt="" height="28">
              {{--  {{ substr(config('app.name', 'Laravel'),0,1) }}  --}}

            </i>
        </a>
    </div>

    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation" style="background: linear-gradient(135deg, rgb(42, 39, 218), rgb(0, 204, 255));">
        <div class="container" style="background: linear-gradient(135deg, rgb(42, 39, 218), rgb(0, 204, 255));">

            <!-- Navbar-left -->
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <button class="button-menu-mobile open-left waves-effect waves-light">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </li>
               {{--  <li class="hidden-xs">
                    <form role="search" class="app-search">
                        <input type="text" placeholder="Search..."
                               class="form-control">
                        <a href=""><i class="fa fa-search"></i></a>
                    </form>
                </li> --}}
                <!-- <li class="hidden-xs">
                    <a href="#" class="menu-item waves-effect waves-light">New</a>
                </li>
                <li class="dropdown hidden-xs">
                    <a data-toggle="dropdown" class="dropdown-toggle menu-item waves-effect waves-light" href="#" aria-expanded="false">English
                        <span class="caret"></span></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="#">German</a></li>
                        <li><a href="#">French</a></li>
                        <li><a href="#">Italian</a></li>
                        <li><a href="#">Spanish</a></li>
                    </ul>
                </li> -->
            </ul>

            <!-- Right(Notification) -->
            <ul class="nav navbar-nav navbar-right">


                <li class="dropdown user-box">
                    <a href="" class="dropdown-toggle waves-effect waves-light user-link" data-toggle="dropdown" aria-expanded="true">
                       @if(Auth::User()->profile_image == "sample_img.jpg")
                            <img src='{{ asset("files/profile/sample_img.jpg") }}' class="img-responsive img-circle" alt="profile image" width="40px;">

                            @else
                            {{-- @dd( Auth::User()->profile_image) --}}
                            

                             <img src='{{ str_replace('public', '/storage', Auth::User()->profile_image) }}' class="img-responsive img-circle" alt="profile image" width="40px" >
                            @endif
                        {{-- <i class="fa fa-user-circle" aria-hidden="true"></i> --}}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                        <li>
                            <h5>Hi, {{Auth::user()->name}}</h5>
                        </li>
                        <li>
                            <a href="{{url('/admin/settings')}}"><h5>Settings</h5></a>
                        </li>
                        {{-- <li><a href="javascript:void(0)"><i class="ti-user m-r-5"></i> Profile</a></li>
                        <li><a href="javascript:void(0)"><i class="ti-settings m-r-5"></i> Settings</a></li> --}}
                        {{-- <li><a href="{{url('auth/logout')}}"><i class="ti-power-off m-r-5"></i> Logout</a></li> --}}
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form11').submit();">
                               <i class="ti-power-off m-r-5"></i> {{ __('Logout') }}
                            </a>
                            
                            <form id="logout-form11" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>

            </ul> <!-- end navbar-right -->

        </div><!-- end container -->
    </div><!-- end navbar -->
</div>
<!-- Top Bar End
