@extends('admins.layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Add product</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li><a href="#">Manage product</a></li>
                    <li class="active">Add product</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-sm-6">

            {!! Form::open(array('url'=>'admin/product','class'=>'form-horizontal','id'=>'newUser','method'=> 'POST','files' => true)) !!}
            
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
                                        <label class="control-label">Name</label>
                                        <input type="text" class="form-control" name="name" required>                                    
                                    </div>                                    
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Price</label>
                                        <input type="number" class="form-control" name="price" required>                                    
                                    </div>                                    
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Subject</label> 
                                        <select name="category_id" id="" class="form-control">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->subject->name }} > {{ $category->name }}</option>
                                            @endforeach    
                                        </select>                                  
                                    </div>                                    
                                </div>
                                                                                 

                            </div>

                        </div>
                    </div>
                </div>              

                <div class="form-group  m-b-0">
                    <div class="col-md-12">
                        <button class="btn btn-success waves-effect waves-light" type="submit">Save Category</button>
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


{{-- <div class="form-group">
    <div class="col-md-6">
        <label class="control-label">Content</label>
        <input type="text" class="form-control"  name="nutshell_content">                                    
    </div>

    <div class="col-md-6">
        <label class="control-label">Subtitle</label>
        <input type="text" class="form-control"  name="subtitle">                                    
    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        <label class="control-label">Featured Image</label>
        <input type="file" name="image" class="form-control">
    </div>
</div> 

<div class="form-group">
    <div class="col-md-12">
        <label class="control-label">Content</label>
        <textarea name="content" id="" cols="30" rows="10"></textarea>
    </div>
</div> 
 --}}
