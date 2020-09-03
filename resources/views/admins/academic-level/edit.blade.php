@extends('admins.layouts.master')

@section('content')    
    <div class="row" style="padding-top:15px;">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Academic Level</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li><a href="#">Manage Academic Level</a></li>
                    <li class="active">Edit Academic Level</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-sm-6">

            {!! Form::open(array('url'=>'admin/academic-level/'.$academicLevel->id,'class'=>'form-horizontal','id'=>'newUser','method'=> 'PUT','files' => true)) !!}
            
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
                                        <div class="form-group">
                                        {{-- <label for="service">Select service</label> --}}
                                      {{--   <select name="service"  class="form-control">

                                            <option value="" >Select</option>
                                            @foreach($services as $service)
                                            <option class="form-control" @if($service->id == $academicLevel->id) selected  @endif value="{{$service->id}}">{{$service->name}}</option>
                                            @endforeach
                                        </select> --}}
                                        </div>
                                        <label class="control-label">Name</label>
                                        <input type="text" class="form-control"  name="name" required value="{{ old('name') ?? $academicLevel->name }}">                                    
                                    </div>                                    
                                </div>
{{-- 
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Subject</label> 
                                        <select name="subject_id" id="" class="form-control">
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}" @if($academicLevel->subject->id == $subject->id) selected @endif>{{ $subject->name }}</option>
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
                        <button class="btn btn-success waves-effect waves-light" type="submit">Update </button>
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
        <textarea name="content" id="" cols="30" rows="10">{{ old('name')?? $academicLevel->name }}</textarea>
    </div>
</div> 
 --}}
