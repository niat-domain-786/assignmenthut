@extends('admins.layouts.master')

@section('content')    
    <div class="row" style="padding-top:15px;">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Paper</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li><a href="#">Manage Paper</a></li>
                    <li class="active">Edit Paper</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-sm-6">

            {!! Form::open(array('url'=>'admin/paper/'.$papers->id,'class'=>'form-horizontal','id'=>'newUser','method'=> 'PUT','files' => true)) !!}
            
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
                               {{--          <div class="form-group">
                                            <select name="service" id="" class="form-control">
                                                <option value="">Select Service</option>
                                                
                                                @foreach($services as $service)
                                                <option value="{{$service->id}}" @if($service->id == $papers->service_id) selected  @endif>{{$service->name}}</option>

                                                @endforeach
                                            </select>
                                        </div> --}}
                                        <label class="control-label">Name</label>
                                        <input type="hidden" name="paperID" value="{{ $papers->id }}">
                                        <input type="text" class="form-control"  name="name" required value="{{ old('name') ?? $papers->name }}">                                    
                                    </div>                                    
                                </div>

                             {{--    <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Price</label>
                                        <input type="number" class="form-control" name="price" required value="{{ old('price') ?? $papers->price }}">                                    
                                    </div>                                    
                                </div> --}}

                      {{--           <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Category</label> 
                                        <select name="category_id" id="" class="form-control">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @if($papers->category->id == $category->id) selected @endif>{{ $category->subject->name }} > {{ $category->name }}</option>
                                            @endforeach    
                                        </select>                                  
                                    </div>                                    
                                </div> --}}
                                                                                 

                            </div>

                        </div>
                    </div>
                </div>

                

                <div class="form-group m-b-0">
                    <div class="col-md-12">
                        <button class="btn btn-success waves-effect waves-light" type="submit">Update</button>
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


