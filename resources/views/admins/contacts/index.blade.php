@extends('admins.layouts.master')

@section('styles')
    
    <link href="/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>

@stop

@section('scripts')
    
    <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
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
    <script src="/assets/pages/jquery.datatables.init.js"></script>        

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
                <h4 class="page-title">All contact</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li><a href="#">Manage contact</a></li>
                    <li class="active">All contact</li>
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
                    <div class="col-sm-6"><h4 class="m-t-0 header-title"><b>All contact List</b></h4></div>
                    <{{-- div class="col-sm-6 text-right">
                        <a href="{{ url('admin/contact/create') }}" class="btn btn-success btn-sm btn-bordered waves-effect w-md waves-light">Add contact</a>
                    </div> --}}
                </div>
                

                <table id="datatable-buttons" class="table table-striped  table-colored table-info">
                    <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Email</th>                        
                        <th>Username</th>                        
                        <th>Subject</th>
                        <th>Message</th>
                        {{-- <th>Action</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?> 
                        @foreach($contacts as $contact)
                            <tr>
                                <td><?= $i++ ?></td>                                
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->username }}</td>
                                <td>{{ $contact->subject }}</td>
                                <td>{{ $contact->message }}</td>
                                
                               {{--  <td>
                                    <a href="{{URL :: asset('admin/contact/copy/'.$contact->id)}}" class="btn btn-icon btn-xs waves-effect waves-light btn-info"> <i class="fa fa-files-o"></i> </a>
                                    <a href="{{URL :: asset('admin/contact/'.$contact->id)}}/edit" class="btn btn-icon btn-xs waves-effect waves-light btn-info"> <i class="fa fa-pencil"></i> </a>
                                    {!! Form::open(['route' => [ 'admin.contact.destroy','id'=>$contact->id ],'method' => 'delete','style'=> 'display: inline-block;']) !!}
                                    <button class="btn btn-icon btn-xs waves-effect waves-light btn-danger"> <i class="fa fa-trash-o"></i> </button>                    
                                {!! Form::close() !!}
                                </td> --}}
                            </tr>
                        @endforeach                       

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop
