@extends('admins.layouts.master')

@section('content')    
    <div class="row" style="padding-top:15px;">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Change Email</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li><a href="#">Manage user</a></li>
                    <li class="active">Change Email</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->

 <div class="row">
        <div class="col-sm-12">
                         @if($errors->any())

                            <ul class="alert">

                                @foreach($errors->all() as $error)

                                <div style="color:red;"><b>{{ $error }}</b></div>

                                @endforeach

                            </ul>

                        @endif


  @if (session('success'))
            <div class="alert alert-success col-md-12" role="alert" >
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger col-md-12" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        {{ session('error') }}
            </div>
        @endif


            {!! Form::open(array('url'=>'admin/user','class'=>'form-horizontal','id'=>'newUser','method'=> 'POST','files' => true)) !!}
            
                <div class="panel panel-color panel-info">                    
                    <div class="panel-body">
                        <h2>List of all Requests</h2>
                        <hr>
            <table class="table">
            <thead>
                <th>User ID</th>
                <th>Name</th>
                <th>Current Email</th>
                <th>Requested Email</th>
                <th>Action</th>
            </thead>
            @forelse($users as $user)
            <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->change_email_request}}</td>
            <td><a href="{{ url('admin/approve-email-request', ['id'=> $user->id]) }}"><span class="btn btn-sm btn-success">Approve</span></a>&nbsp; 
                <a href="{{ url('admin/reject-email-request', ['id'=> $user->id]) }}"><span class="btn btn-sm btn-danger">Reject</span> </a></td>

            </tr>

            @empty
            <h2>No user found!</h2>


            @endforelse
                
           
        </table>
                        
                    {{-- <form class="form-horizontal" role="form"> --}}

           



                    </div>
                </div>              


            </form>


        </div>
    </div>

@stop

@section('styles')

@stop

@section('scripts')

    <script src="{{ url('public/assets/plugins/waypoints/jquery.waypoints.min.js')}}"></script>
    <script src="{{ url('public/assets/plugins/counterup/jquery.counterup.min.js')}}"></script>

    <!--Morris Chart-->
    <script src="{{ url('public/assets/plugins/morris/morris.min.js')}}"></script>
    <script src="{{ url('public/assets/plugins/raphael/raphael-min.js')}}"></script>

    <!-- Dashboard init -->
    <script src="{{ url('public/assets/pages/jquery.dashboard.js')}}"></script>

@stop


