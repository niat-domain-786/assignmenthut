<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu" style="top:0 !important; background: linear-gradient(135deg, rgb(0 0 0), rgb(33 33 33));">
    <div class="sidebar-inner slimscrollleft" style="background: linear-gradient(135deg, rgb(0 0 0), rgb(33 33 33));">

        <!--- Sidemenu -->
        <div id="sidebar-menu" style="background: linear-gradient(135deg, rgb(0 0 0), rgb(33 33 33));">
            
   

            <div class="dropdown" id="setting-dropdown">
                <ul class="dropdown-menu">
                    <li><a class="text-white" href="javascript:void(0)"><i class="mdi mdi-face-profile m-r-5"></i> Profile</a></li>
                    <li><a href="javascript:void(0)"><i class="mdi mdi-account-settings-variant m-r-5"></i> Settings</a></li>
                    <li><a href="javascript:void(0)"><i class="mdi mdi-lock m-r-5"></i> Lock screen</a></li>
                    <li><a href="javascript:void(0)"><i class="mdi mdi-logout m-r-5"></i> Logout</a></li>
                </ul>
            </div>

            <ul>
                <li class="menu-title">Navigation</li>

                <li>
                   <form action="{{ route('admin.search') }}" method="POST"> @csrf
                <input class="form-control" type="number" placeholder="Search by order number" name="search" aria-label="Search" ></form>
                </li>

                <li><a class="text-white" href="{{ url('admin/dashboard') }}" class="waves-effect text-white"><i class="mdi mdi-view-dashboard"></i><span > DASHBOARD </span></a></li>
                


                <li class="has_sub">
                    <a  href="javascript:void(0);" class="waves-effect text-white"><i class="mdi mdi-cart" ></i> <span > ORDERS </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a class="text-white" href="{{ route('admin.order.index') }}">New Orders</a></li>
                        <li><a class="text-white" href="{{ route('admin.order.completed_orders') }}">Completed Orders</a></li>
                    </ul>
                </li>

                 
               

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect text-white"><i class="mdi mdi-undo-variant"></i> <span > REVISIONS </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a class="text-white" href="{{ route('admin.order.revisions') }}">New Revisions</a></li>
                        <li><a class="text-white" href="{{ route('admin.order.completed_revisions') }}">Completed Revisions</a></li>
                    </ul>
                </li>

                

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect text-white"><i class="mdi  mdi-briefcase-check"></i> <span > SERVICES </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a class="text-white" href="{{ url('admin/service/create') }}">Add New</a></li>
                        <li><a class="text-white" href="{{ url('admin/service') }}">All Services</a></li>
                    </ul>
                </li>
                
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect text-white"><i class="mdi mdi-sitemap"></i> <span >  ACADEMIC LEVELS </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a class="text-white" href="{{ url('admin/academic-level/create') }}">Add New</a></li>
                        <li><a class="text-white" href="{{ url('admin/academic-level') }}">All Levels</a></li>
                    </ul>
                </li> 

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect text-white"><i class="mdi  mdi-book-open"></i> <span > TYPE OF PAPER </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a class="text-white" href="{{ url('admin/paper/create') }}">Add new</a></li>
                        <li><a class="text-white" href="{{ url('admin/paper') }}">All Types</a></li>
                    </ul>
                </li> 

                
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect text-white"><i class="mdi  mdi-currency-btc"></i> <span > CURRENCIES </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a class="text-white" href="{{ url('admin/currency/create') }}">Add Currency</a></li>
                        <li><a class="text-white" href="{{ url('admin/currency') }}">All Currencies</a></li>
                    </ul>
                </li> 

                

                 <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect text-white"><i class="mdi  mdi-calculator"></i> <span >PRICES </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a class="text-white" href="{{ route('admin.prices-create') }}">Add/Remove Price</a></li>
                        <li><a class="text-white" href="{{ route('admin.prices-list') }}">All Prices</a></li>
                    </ul>
                </li>
                

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect text-white">
                         @if($email_request_count >= 1)
                          <i class="mdi mdi-account-multiple-plus" style="color:#f06292;"  ></i> <span style="color:#f06292;">USERS </span>

                         @else

                        <i class="mdi mdi-account-multiple-plus"  ></i> <span >USERS </span>
                         @endif
                     <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a class="text-white" href="{{ url('admin/user/create') }}">Add User</a></li>
                        <li><a class="text-white" href="{{ url('admin/user') }}">All Users</a></li>
                        @if($email_request_count >= 1)
                        <li><a  class="text-danger" href="{{ url('admin/change-email-request') }}">({{$email_request_count }}) Email Requests </a></li>
                        @else
                        <li><a class="text-white" href="{{ url('admin/change-email-request') }}">Email Requests</a></li>
                        @endif
                    </ul>
                </li>
                
                

                <li class="has_sub">
                    <a href="{{url('/admin/transaction')}}" class="waves-effect text-white"><i class="mdi mdi-transfer"></i> <span > TRANSACTIONS </span></a>
                  
                </li>
                
          

                {{-- <li><a class="text-white" href="{{ route('admin.paypal.index') }}" class="waves-effect text-white"><i class="mdi mdi-credit-card" style="color:#15abab"></i><span> Manage Paypal </span></a></li> --}}

            </ul>
        </div>
        <!-- Sidebar  -->
        <div class="clearfix"></div>


    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
