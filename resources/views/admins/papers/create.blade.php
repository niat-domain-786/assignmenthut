@extends('admins.layouts.master')

@section('content')

    <div class="row" style="padding-top:15px;">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Add Paper Type</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li><a href="#">Manage Paper Type</a></li>
                    <li class="active">Add Paper Type</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-sm-6">

            {!! Form::open(array('url'=>'admin/paper','class'=>'form-horizontal','id'=>'newUser','method'=> 'POST','files' => true)) !!}
            
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
                                {{--         <div class="form-group">
                                        <label for="service">Select service</label>
                                        <select name="service" id=""  class="form-control">

                                            <option value="" >Select</option>
                                            @foreach($services as $service)
                                            <option class="form-control" value="{{$service->id}}">{{$service->name}}</option>
                                            @endforeach
                                        </select>
                                        </div> --}}
                                        <div class="form-group">

                                        <label class="control-label">Name</label>
                                        <input type="text" name="name"  class="form-control" required>
                                        </div>                                    
                                    </div>                                    
                                </div>
{{-- 
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Price</label>
                                        <input type="number" class="form-control" name="price" required>                                    
                                    </div>                                    
                                </div> --}}
{{-- 
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Subject</label> 
                                        <select name="category_id" id="" class="form-control">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->subject->name }} > {{ $category->name }}</option>
                                            @endforeach    
                                        </select>                                  
                                    </div>                                    
                                </div> --}}
                                                                                 

                            </div>

                        </div>
                    </div>
                </div>              

                <div class="form-group  m-b-0">
                    <div class="col-md-12">
                        <button class="btn btn-success waves-effect waves-light" type="submit">Save Paper Type</button>
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

    <script src="{{ url('assets/plugins/waypoints/jquery.waypoints.min.js')}}"></script>
    <script src="{{ url('assets/plugins/counterup/jquery.counterup.min.js')}}"></script>

    <!--Morris Chart-->
    <script src="{{ url('assets/plugins/morris/morris.min.js')}}"></script>
    <script src="{{ url('assets/plugins/raphael/raphael-min.js')}}"></script>

    <!-- Dashboard init -->
    <script src="{{ url('assets/pages/jquery.dashboard.js')}}"></script>

@stop


