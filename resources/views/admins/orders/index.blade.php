@extends('admins.layouts.master')

@section('styles')
<style> 
    div.dataTables_wrapper div.dataTables_paginate {
        display:none !important;
    }
    </style>
    
    <link href="{{asset('assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/datatables/fixedHeader.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/datatables/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/datatables/dataTables.colVis.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/datatables/fixedColumns.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>

@stop

@section('scripts')
    
    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>

    <script src="{{asset('assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/jszip.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/responsive.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.scroller.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.colVis.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.fixedColumns.min.js')}}"></script>

    <!-- init -->
    <script src="{{asset('assets/pages/jquery.datatables.init.js')}}"></script>        

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

@section('content')

    <div class="row" style="padding-top:15px;">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">New Orders</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li><a href="/admin/order">Manage Orders</a></li>
                    <li class="active">New Orders</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->
    


    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-sm-6"><h4 class="m-t-0 header-title"><b>New Orders </b></h4></div>
                    {{-- <div class="col-sm-6 text-right">
                        <a href="{{ url('admin/contact/create') }}" class="btn btn-success btn-sm btn-bordered waves-effect w-md waves-light">Add contact</a>
                    </div> --}}
                </div>
                

               {{--  
                add if needs to display print buttons
                <table id="datatable-buttons" class="table table-striped  table-colored table-info"> --}}

                      <table id="datatable-buttons"  class="table table-striped  table-colored table-info">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Service</th>
                            <th>Amount</th>
                            {{-- <th>Details</th> --}}
                            <th>User</th>
                            <th>Deadline</th>
                            <th>Time of Order</th>
                            <th>Expiry time</th>
                            {{-- <th>Time Left</th> --}}
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php $i=1; ?> 
                        @foreach($orders as $order)
                            <tr style='cursor: pointer; cursor: hand;' onclick="window.location='{{url("/admin/order")."/"}}{{$order->id}}';">
                            
                               
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->service->name}}</td>
                                
                                <td>{{  number_format((float)$order->price, 2, '.', '') }} {{$order->currency->name}}</td>                                                            
                                {{-- <td>{{  $order->details }}</td>                                --}}
                                <td>{{  $order->user->name }}</td>
                                <td>{{  $order->exp_time->urgency_value }} - {{$order->exp_time->urgency_hour_or_day}}</td>
                                <td>{{ date('F d, Y', strtotime($order->created_at))}}</td>
                                

                                @if($order->exp_time->urgency_hour_or_day == "days")
                              
                                <td>{{ $order->created_at->addDays($order->exp_time->urgency_value )->diffForHumans() }}</td>
                                @endif

                                @if($order->exp_time->urgency_hour_or_day == "hours")
                               
                                <td>{{ $order->created_at->addHours($order->exp_time->urgency_value)->diffForHumans() }}</td>


                                @endif

                               

                                                                                              
                            </tr>
                       

                        @endforeach                                                                                                     

                    </tbody>
                </table>
<nav aria-label="Page navigation example">
  <ul class="pagination">
   {{ $orders->links() }} 
  </ul>
</nav>
            </div>
        </div>
    </div>
@stop


