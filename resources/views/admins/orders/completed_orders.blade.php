@extends('admins.layouts.master')
@section('title')
Admin Panel | {{ config('app.name', 'Laravel') }}
@endsection
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


@if($orders->count() > 0)
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-color panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Completed Orders</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="datatable-buttons" class="table table table-hover m-0">
                        <thead>
                            
                            <tr>
                                <th>Order ID</th>
                                <th>Service</th>
                                <th>Amount</th>
                                {{-- <th>Note</th> --}}
                                <th>User</th>
                                {{-- <th>Username</th> --}}
                                <th>Submission Date</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($orders as $order)
                            <tr  style='cursor: pointer; cursor: hand;' onclick="window.location='{{url('/admin/order')}}{{"/"}}{{$order->id}}';">
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->service->name }}</td>
                                <td>{{  $order->price }} {{ $order->currency->name }}</td>
                                {{-- <td>{{  $order->notes ?? "" }}</td> --}}
                                <td>{{  $order->user->name }}</td>
                                <td>{{ date('F d, Y h:s', strtotime($order->updated_at))}}</td>
                     
                                
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        {{ $orders->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endif

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
ajax: "{{asset('assets/plugins/datatables/json/scroller-demo.json')}}",
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