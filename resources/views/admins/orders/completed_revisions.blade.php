@extends('admins.layouts.master')

@section('title')

    Admin Panel | {{ config('app.name', 'Laravel') }}

@endsection





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


@section('content')

    
    <div class="row" style="padding-top:15px;">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Dashboard</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li><a href="#">{{ config('app.name', 'Laravel') }}</a></li>
                    {{-- <li><a href="#">Dashboard</a></li> --}}
                    <li class="active">Dashboard</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
                        

{{-- content here --}}  


    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-sm-6"><h4 class="m-t-0 header-title"><b>All Completed Revisions</b></h4></div>
                    {{-- <div class="col-sm-6 text-right">
                        <a href="{{ url('admin/contact/create') }}" class="btn btn-success btn-sm btn-bordered waves-effect w-md waves-light">Add contact</a>
                    </div> --}}
                </div>
                

                <table id="datatable-buttons" class="table table-striped  table-colored table-info col-md-12 table-hoverd">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>User</th>
                            <th>Service</th>
                            <th>Revision Count</th>
                            <th>Date</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($revisions as $revision)
                        <tr   style='cursor: pointer; cursor: hand;' onclick="window.location='{{ route('admin.order.deliver_revisions',[$revision->id]) }}'" >
                            <td>{{$revision->assignment_order_id}}</td>
                            <td>{{$revision->user->name}}</td>
                            <td>{{$revision->order->service->name}}</td>
                            <td>{{$revision->iteration}}</td>
                            <td>{{ date('F d, Y ', strtotime($revision->updated_at))}}</td>
                      {{--       <td>
                              <a href="{{ route('admin.order.deliver_revisions',[$revision->id]) }}" class="btn btn-icon btn-xs waves-effect waves-light btn-info"> <i class="fa fa-eye"></i> </a>
                            </td>  --}}
                        </tr>
                        @endforeach
                                                                                                            

                    </tbody>
                </table>
            </div>
        </div>
    </div>


                        

  

@endsection 