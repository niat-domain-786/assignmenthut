





@extends('admin.layouts.master')

@section('styles')
    
    <link href="{{ url('public/assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('public/assets/plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('public/assets/plugins/datatables/fixedHeader.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('public/assets/plugins/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('public/assets/plugins/datatables/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('public/assets/plugins/datatables/dataTables.colVis.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('public/assets/plugins/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('public/assets/plugins/datatables/fixedColumns.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>

@stop

@section('scripts')
    
    <script src="{{ url('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ url('public/assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>

    <script src="{{ url('public/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{ url('public/assets/plugins/datatables/buttons.bootstrap.min.js')}}"></script>
    <script src="{{ url('public/assets/plugins/datatables/jszip.min.js')}}"></script>
    <script src="{{ url('public/assets/plugins/datatables/pdfmake.min.js')}}"></script>
    <script src="{{ url('public/assets/plugins/datatables/vfs_fonts.js')}}"></script>
    <script src="{{ url('public/assets/plugins/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{ url('public/assets/plugins/datatables/buttons.print.min.js')}}"></script>
    <script src="{{ url('public/assets/plugins/datatables/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{ url('public/assets/plugins/datatables/dataTables.keyTable.min.js')}}"></script>
    <script src="{{ url('public/assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{ url('public/assets/plugins/datatables/responsive.bootstrap.min.js')}}"></script>
    <script src="{{ url('public/assets/plugins/datatables/dataTables.scroller.min.js')}}"></script>
    <script src="{{ url('public/assets/plugins/datatables/dataTables.colVis.js')}}"></script>
    <script src="{{ url('public/assets/plugins/datatables/dataTables.fixedColumns.min.js')}}"></script>

    <!-- init -->
    <script src="{{ url('public/assets/pages/jquery.datatables.init.js')}}"></script>        

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

    <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">All Orders</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li><a href="#">Manage Orders</a></li>
                                        <li class="active">All Orders</li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <!-- <div class="row" style="margin-bottom: 15px;">
                                        <div class="col-sm-6"><h4 class="m-t-0 header-title"><b>All Orders List</b></h4></div>
                                        <div class="col-sm-6 text-right">
                                            <a href="add-designer.php" class="btn btn-success btn-sm btn-bordered waves-effect w-md waves-light">Add Designer</a>
                                        </div>
                                    </div> -->
                                    

                                    <table id="datatable-buttons" class="table table-striped  table-colored table-info">
                                        <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>WholeSeller Name</th>
                                            <th>Brand</th>
                                            <th>Season</th>
                                            <th>Style Number</th>
                                            <th>Style For</th>
                                            <th>Status</th>
                                            <th>Posted On</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($query)>0)
                                                <?php $i=1; 
                                                    $status = ['Pending','In-Process','Completed'];
                                                ?> 
                                                @foreach($query as $user)

                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td>{{$user->username}}</td>
                                                        <td>{{$user->name}}</td>
                                                        <td>{{$user->season_name}}</td>
                                                        <td>{{$user->style_number}}</td>
                                                        <td>{{$user->style_for}}</td>
                                                        <td>{{$status[$user->status]}}</td>
                                                        <td>{{date('F d, Y', strtotime($user->created_at))}}</td>
                                                        <td>
                                                            <a href="{{url('admin/order/history/'.$user->id)}}" class="btn btn-icon btn-xs waves-effect waves-light btn-success"> <i class="fa fa-eye"></i> </a>
                                                           <!--  <button class="btn btn-icon btn-xs waves-effect waves-light btn-info"> <i class="fa fa-pencil"></i> </button> -->
                                                            {{-- <button class="btn btn-icon btn-xs waves-effect waves-light btn-danger"> <i class="fa fa-trash-o"></i> </button> --}}
                                                        </td>
                                                    </tr>
                                                @endforeach 
                                            @else
                                                <tr>
                                                    <td><i>No Data Found</i></td>
                                                </tr> 
                                            @endif

                                            

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

@stop
