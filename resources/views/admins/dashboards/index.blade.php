@extends('admins.layouts.master')
@section('title')
Admin Panel | {{ config('app.name', 'Laravel') }}
@endsection
@section('content')

<div class="row" style="padding-top:20px;">
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

<div class="row text-center">
    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="card-box widget-box-one">
            <div class="wigdet-one-content">
                <p class="m-0 text-uppercase font-600 font-secondary text-overflow">Users Registered</p>
                <h2 class="text-dark"><span data-plugin="counterup">{{  $users }}</span> </h2>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="card-box widget-box-one">
            <div class="wigdet-one-content">
                <p class="m-0 text-uppercase font-600 font-secondary text-overflow">Total Services</p>
                <h2 class="text-danger"><span data-plugin="counterup">{{ $services ?? "" }}</span></h2>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-6">
        <div class="card-box widget-box-one">
            <div class="wigdet-one-content">
                <p class="m-0 text-uppercase font-600 font-secondary text-overflow">New Orders </p>
                <h2 class="text-success"><span data-plugin="counterup">{{ $new_orders ?? ""  }}</span></h2>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6">
        <div class="card-box widget-box-one">
            <div class="wigdet-one-content">
                <p class="m-0 text-uppercase font-600 font-secondary text-overflow">Orders Completed</p>
                <h2 class="text-success"><span data-plugin="counterup">{{ $completed_orders ?? ""  }}</span></h2>
            </div>
        </div>
    </div>
    <a href = "{{ url('admin/change-email-request') }}"><div class="col-lg-2 col-md-3 col-sm-6">
        <div class="card-box widget-box-one">
            <div class="wigdet-one-content">
                <p class="m-0 text-uppercase font-600 font-secondary text-overflow text-danger">Email Requests</p>
                <h2 class="text-danger">
                    <span data-plugin="counterup">{{ $email_request_count ?? ""  }}</span></h2>
            </div>
        </div>
    </div>
</a>
    
 
</div>


{{-- shortcuts --}}

<div class="row text-center">
 <a href="{{url('admin/order')}}"> 
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card-box widget-box-one">
            <div class="wigdet-one-content">
               {{--  <p class="m-0 text-uppercase font-600 font-secondary text-overflow">New Orders</p> --}}
               <i class="mdi mdi-format-list-bulleted" style="color:#000; font-size:24px;"></i>
                <h4 class="text-dark">
                    <span>New Orders</span> </h4>
            </div>
        </div>
    </div>
</a>
   <a href="{{url('admin/completed-orders')}}">
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card-box widget-box-one">
            <div class="wigdet-one-content">
               {{--  <p class="m-0 text-uppercase font-600 font-secondary text-overflow">Orders Completed</p> --}}
                <i class="mdi  mdi-checkbox-multiple-marked" style="color:#000; font-size:24px;"></i>
                <h4 class="text-success"><span>Completed Orders</span></h4>
            </div>
        </div>
    </div></a>
    
   <a href="{{url('admin/revisions')}}">
    
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card-box widget-box-one">
            <div class="wigdet-one-content">
               {{--  <p class="m-0 text-uppercase font-600 font-secondary text-overflow">New Revisions </p> --}}
               <i class="mdi mdi-undo" style="color:#000; font-size:24px;"></i>
                <h4 class="text-dark"><span data-plugin="counterup">{{ "New Revisions"  }}</span></h4>
            </div>
        </div>
    </div>
</a>
   <a href="{{url('admin/completed-revisions')}}">
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card-box widget-box-one">
            <div class="wigdet-one-content">{{-- 
                <p class="m-0 text-uppercase font-600 font-secondary text-overflow">Completed Revisions</p> --}}

              <i class="mdi mdi-clipboard-check" style="color:#000; font-size:24px;"></i>
                <h4 class="text-success"><span data-plugin="counterup">{{ "Completed Revisions"  }}</span></h4>
            </div>
        </div>
    </div></a>
    
 
</div>




@if($orders->count() > 0)
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-color panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Resently completed Orders</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table table-hover m-0">
                        <thead>
                            
                            <tr>
                                <th>Order ID.</th>
                                <th>Service</th>
                                <th>Amount</th>
                                {{-- <th>Details</th> --}}
                                <th>User</th>
                                {{-- <th>Username</th> --}}
                                <th>Submission Date</th>
                                <th>Deadline</th>
                                <th>Expiry</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($orders as $order)
                            <tr style='cursor: pointer; cursor: hand;' onclick="window.location='{{url('/admin/order')}}{{"/"}}{{$order->id}}';">
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->service->name}}</td>
                                <td>{{  $order->price }} {{ $order->currency->name}}</td>
                                {{-- <td>{{  $order->details }}</td> --}}
                                <td>{{  $order->user->name }}</td>
                                <td>{{ date('F d, Y h:s', strtotime($order->updated_at))}}</td>
                                <td>{{ $order->deadline }} {{$order->exp_time->urgency_hour_or_day}}</td>

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

{{--    <link href="/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
<link href="/assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="/assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="/assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="/assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="/assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
<link href="/assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="/assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/> --}}
@stop
@section('scripts')

{{--   <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="/assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="/assets/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="/assets/plugins/datatables/jszip.min.js"></script>
<script src="/assets/plugins/datatables/pdfmake.min.js"></script>
<script src="/assets/plugins/datatables/vfs_fonts.js"></script>
<script src="/assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="/assets/plugins/datatables/buttons.print.min.js"></script>
<script src="/assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
<script src="/assets/plugins/datatables/dataTables.keyTable.min.js"></script>
<script src="/assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="/assets/plugins/datatables/responsive.bootstrap.min.js"></script>
<script src="/assets/plugins/datatables/dataTables.scroller.min.js"></script>
<script src="/assets/plugins/datatables/dataTables.colVis.js"></script>
<script src="/assets/plugins/datatables/dataTables.fixedColumns.min.js"></script>
<!-- init -->
<script src="{{asset('assets/pages/jquery.datatables.init.js')}}"></script>    --}}
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