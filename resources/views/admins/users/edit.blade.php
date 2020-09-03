@extends('admins.layouts.master')

@section('content')    
    <div class="row" style="padding-top:15px;">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit user</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li><a href="#">Manage user</a></li>
                    <li class="active">Edit user</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-sm-6">

            {!! Form::open(array('url'=>'admin/user/'.$user->id,'class'=>'form-horizontal','id'=>'newUser','method'=> 'PUT','files' => true)) !!}
            
                <div class="panel panel-color panel-info">                    
                    <div class="panel-body">
                        
                    {{-- <form class="form-horizontal" role="form"> --}}

                        @if($errors->any())

                            <ul class="alert">

                                @foreach($errors->all() as $error)

                                <div style="color:red;"><b>{{ $error }}</b></div>

                                @endforeach

                            </ul>

                        @endif

                        @if (Session::has('message'))
                           <div class="alert alert-success">
                               {{ Session::get('message') }}
                           </div>
                        @endif



                        <div class="row">
                            <div class="col-md-12">                           

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Name <span style="color:red">*</span></label>
                                        <input type="text" class="form-control"  name="name" required value="{{ old('name') ?? $user->name }}">                                    
                                    </div>                                    
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Email <span style="color:red">*</span></label>
                                        <input type="email" class="form-control" name="email" required value="{{ old('email') ?? $user->email }}">                                    
                                    </div>                                    
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Phone</label>
                                        <input type="text" class="form-control" name="phone" value="{{ old('phone') ?? $user->phone }}">                                    
                                    </div>                                    
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Password</label>
                                        <input type="password" class="form-control" name="password">                                    
                                    </div>                                    
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Verified <span style="color:red">*</span></label>
                                        <select name="verified" id="" class="form-control" required>                                            
                                            <option value="1" @if($user->email_verified_at) selected @endif>Yes</option>
                                            <option value="0" @if(!$user->email_verified_at) selected @endif>No</option>
                                        </select>                                   
                                    </div>                                    
                                </div>
                                                                                 

                            </div>

                        </div>
                    </div>
                </div>

                

                <div class="form-group m-b-0">
                    <div class="col-md-12">
                        <button class="btn btn-success waves-effect waves-light" type="submit">Update User</button>
                        {{-- <button type="reset" class="btn btn-default waves-effect m-l-5">Cancel</button> --}}
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


