@extends('admins.layouts.master')

@section('content')

    <div class="row" style="padding-top:15px;">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Calculate Price</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li><a href="#">Manage Price</a></li>
                    <li class="active">Find Prices</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-sm-6">

           <form action = "{{route('admin.find_price')}}" method="POST">
                            @csrf  
            
                <div class="panel panel-color panel-info">                    
                    <div class="panel-body">
                        
                    {{-- <form class="form-horizontal" role="form"> --}}

                    

                        @if (Session::has('message'))
                           <div class="alert alert-success">
                               {{ Session::get('message') }}
                           </div>
                        @endif



                        <div class="row">
                            <div class="col-md-12"> 
                                                   
                            <h2>Search Price</h2>
                            <h3>Price : {{$search_price->price ?? "N/A"}}</h3>
                                <div class="form-group">
                                      <div class="col-sm-12" style="margin-top:5px;">
                                            <div class="form-group mb-10">
                                           
                                            <div class="col-sm-6"> <p style="margin-top:10px;">Type of Service</p></div>
                                                   <div class="col-sm-9">

                                                <select name="service" class="form-control" >
                                                    <option value="">Select Service</option>
                                                    @forelse($services as $service)
                                                    <option value="{{$service->id}}"> {{$service->name }}</option>
                                                    @empty

                                                    @endforelse
                                                </select>
                                                </div>
                                            </div>
                                        </div>                                 
                                </div>


                                <div class="form-group">
                                      <div class="col-sm-12" style="margin-top:5px;">
                                            <div class="form-group mb-10">
                                           
                                            <div class="col-sm-6"> <p style="margin-top:10px;">Academic Level</p></div>
                                                   <div class="col-sm-9">

                                                <select name="academics" class="form-control" >
                                                    <option value="">Select Level</option>
                                                    @forelse($academics as $level)
                                                    <option value="{{$level->id}}"> {{$level->name }}</option>
                                                    @empty

                                                    @endforelse
                                                </select>
                                                </div>
                                            </div>
                                        </div>                                 
                                </div>

                                   <div class="form-group">
                                      <div class="col-sm-12" style="margin-top:5px;">
                                            <div class="form-group mb-10">
                                           
                                            <div class="col-sm-6"> <p style="margin-top:10px;">Type of Paper</p></div>
                                                   <div class="col-sm-9">

                                                <select name="paper_type" class="form-control" >
                                                    <option value="">Select Paper</option>
                                                    @forelse($papers as $paper)
                                                    <option value="{{$paper->id}}"> {{$paper->name }}</option>
                                                    @empty

                                                    @endforelse
                                                </select>
                                                </div>
                                            </div>
                                        </div>                                 
                                </div>




                          
                                <div class="form-group">
                                      <div class="col-sm-12" style="margin-top:5px;">
                                            <div class="form-group mb-10">
                                           
                                            <div class="col-sm-6"> <p style="margin-top:10px;">Set Urgency/Time</p></div>
                                                   <div class="col-sm-9">

                                            <input type="number" name = "duration" class="form-control">
                                                </div>
                                            </div>
                                        </div>                                 
                                </div>

                                <div class="form-group">
                                      <div class="col-sm-12" style="margin-top:5px;">
                                            <div class="form-group mb-10">
                                           
                                            <div class="col-sm-6"> <p style="margin-top:10px;">Set Days Or Hours</p></div>
                                                   <div class="col-sm-9">

                                            <select name="days_or_hours" class="form-control">
                                                <option value="">Select</option>
                                                <option value="days">Days</option>
                                                <option value="hours">Hours</option>
                                            </select>
                                                </div>
                                            </div>
                                        </div>                                 
                                </div>


                         

                                                                                 

                            </div>

                        </div>
                    </div>
                </div>              

                <div class="form-group  m-b-0">
                    <div class="col-md-12">
                        <button class="btn btn-success waves-effect waves-light" type="submit">Find Price</button>
                        {{-- <button type="reset" class="btn btn-default waves-effect m-l-5">Cancel</button> --}}
                    </div>
                </div>

            </form>


        </div>
    </div>

        <div class="container panel " style=" margin:20px 1px; background-color:#fff;">
        <h3>List of all Available Prices Prices</h3>

        <table id="datatable-buttons" class="table table table-hover m-0">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Service</th>
      <th scope="col">Academic Level</th>
      <th scope="col">Paper</th>
      <th scope="col">urgency</th>
      <th scope="col">Days or Hours</th>
      <th scope="col">price in AUD</th>
    </tr>
  </thead>
  <tbody>
        @foreach($prices as $key =>$price)
    <tr>
      <th scope="row"><?php echo $key+1; ?></th>
      <td>{{ $price->service->name }}</td>
      <td>{{ $price->academics->name }}</td>
      <td>{{ $price->paper->name }}</td>
      <td>{{ $price->urgency_value }}</td>
      <td>{{$price->urgency_hour_or_day}}</td>
      <td>{{ $price->price }}</td>
    </tr>
    @endforeach
 
  </tbody>
</table>

    </div>

@stop


@section('styles')
<style> 
    div.dataTables_wrapper div.dataTables_paginate {
        display:none !important;
    }
    </style>
    
    <link href="{{asset('public/assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('public/assets/plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('public/assets/plugins/datatables/fixedHeader.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('public/assets/plugins/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('public/assets/plugins/datatables/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('public/assets/plugins/datatables/dataTables.colVis.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('public/assets/plugins/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('public/assets/plugins/datatables/fixedColumns.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>

@stop

@section('scripts')
    
    <script src="{{asset('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>

    <script src="{{asset('public/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/datatables/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/datatables/jszip.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('public/assets/plugins/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/datatables/buttons.print.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/datatables/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/datatables/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/datatables/responsive.bootstrap.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/datatables/dataTables.scroller.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/datatables/dataTables.colVis.js')}}"></script>
    <script src="{{asset('public/assets/plugins/datatables/dataTables.fixedColumns.min.js')}}"></script>

    <!-- init -->
    <script src="{{asset('public/assets/pages/jquery.datatables.init.js')}}"></script>        

    <script type="text/javascript">
        $(document).ready(function () {
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({keys: true});
            $('#datatable-responsive').DataTable();
            $('#datatable-colvid').DataTable({
                "dom": 'C<"clear">lfrtip',
                "colVis": {
                    "buttonText": "Change columns"
                }
            });
            $('#datatable-scroller').DataTable({
                ajax: "assets/plugins/datatables/json/scroller-demo.json",
                deferRender: true,
                scrollY: 380,
                scrollCollapse: true,
                scroller: true
            });
            var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
            var table = $('#datatable-fixed-col').DataTable({
                scrollY: "300px",
                scrollX: true,
                scrollCollapse: true,
                paging: false,
                fixedColumns: {
                    leftColumns: 1,
                    rightColumns: 1
                }
            });
        });
        TableManageButtons.init();

    </script>

@stop

