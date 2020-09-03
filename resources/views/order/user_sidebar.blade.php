                    <div class="profile-sidebar shadow-md">
                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic">

                            @if(Auth::User()->profile_image == "sample_img.jpg")
                            <img src='{{ asset("files/profile/sample_img.jpg") }}' class="img-responsive" alt="profile image">

                            @else

                             <img src='{{ asset(str_replace('public', '/storage',Auth::User()->profile_image)) }}' class="img-responsive" alt="profile image">
                            @endif
                        </div>
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name">
                                {{ ucwords(auth()->user()->name) }}  {{ ucwords(auth()->user()->lastname) }}
                                  <p>  <a href="{{url('/profile')}}" class="text-primary"> <em><i class="fa fa-edit"></i> &nbsp;{{"Edit"}}</em></a></p>
                            </div>
                            {{-- <div class="profile-usertitle-job">
                                {{ auth()->user()->email }}
                            </div> --}}
                        </div>
                        
                        <!-- END SIDEBAR BUTTONS #4754C2 !important -->
                        <!-- SIDEBAR MENU -->
                        <div class="profile-usermenu">
                            <ul class="nav">
                              <li class="">
                                    <a  @if (\Request::is('home')) class="bg-dark" style="background-color:#4754C2; color:#fff;" @endif  href="{{url('/home')}}">
                                        <i class="glyphicon glyphicon-home"></i>
                                     Home </a>
                                </li>
                                <li  @if (\Request::is('order')) class="active" @endif >
                                    <a  @if (\Request::is('order')) class="bg-dark" style="background-color:#4754C2; color:#fff;" @endif  href="{{url('/order')}}" >
                                        <i class="glyphicon glyphicon-list"></i>
                                    Your Assignments </a>
                                </li>
                                <li @if (\Request::is('revisions')) class="active" @endif>
                                    <a @if (\Request::is('revisions')) class="bg-dark" style="background-color:#4754C2; color:#fff;" @endif href="{{url('/revisions')}}">
                                        <i class="glyphicon glyphicon-book"></i>
                                     Your Revisions </a>
                                </li>
                                <li @if (\Request::is('order/create')) class="active" @endif >
                                    <a @if (\Request::is('order/create')) class="bg-dark" style="background-color:#4754C2; color:#fff;" @endif  href="{{url('/order/create')}}">
                                        <i class="glyphicon glyphicon glyphicon-plus"></i>
                                    Order New Assignment </a>
                                </li>
                          {{--       <li>
                                    <a href="{{url('/profile')}}" >
                                        <i class="glyphicon glyphicon-user"></i>
                                    Profile Setting </a>
                                </li> --}}
                                  <li>
                                    <a  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                         <i class="glyphicon glyphicon-log-out"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    
                                </li>
                            </ul>
                        </div>
                        <!-- END MENU -->
                    </div>