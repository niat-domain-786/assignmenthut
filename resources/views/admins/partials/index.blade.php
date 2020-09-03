<div class="row">
    <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">All Instagram @if($packages[0]->type == 0) Flat @elseif($packages[0]->type ==1) Subscription @elseif($packages[0]->type ==2) Views @else Followers @endif Services</h4>
            <ol class="breadcrumb p-0 m-0">
                <li><a href="#">Manage Instagram Services</a></li>
                <li class="active">All Instagram @if($packages[0]->type == 0) Flat @elseif($packages[0]->type ==1) Subscription @elseif($packages[0]->type ==2) Views @else Followers @endif Services</li>
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
                <div class="col-sm-6"><h4 class="m-t-0 header-title"><b>All Instagram @if($packages[0]->type == 0) Flat @elseif($packages[0]->type ==1) Subscription @elseif($packages[0]->type ==2) Views @else Followers @endif Services</b></h4></div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.instagram.create') }}" class="btn btn-success btn-sm btn-bordered waves-effect w-md waves-light">Add New</a>
                </div>
            </div>
            

            <table id="datatable-buttons" class="table table-striped  table-colored table-info">
                <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Limit</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Registered Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?> 
                    @foreach($packages as $package)
                        <tr>
                            <td><?= $i++ ?></td>
                            <td>{{$package->limit }}</td>
                            <td>{{  number_format((float)$package->price/100, 2, '.', '') }}$</td>
                            <td>{{  $package->discount }}%</td>
                            <td>{{date('F d, Y', strtotime($package->created_at))}}</td>
                            
                            <td>                                
                                <a href="{{ route('admin.instagram.edit',['id'=> $package->id]) }}" class="btn btn-icon btn-xs waves-effect waves-light btn-info"> <i class="fa fa-pencil"></i> </a>
                                {!! Form::open(['route' => ['admin.instagram.destroy','id'=> $package->id ],'method' => 'delete','style'=> 'display: inline-block;']) !!}
                                    <button class="btn btn-icon btn-xs waves-effect waves-light btn-danger"> <i class="fa fa-trash-o"></i> </button>                    
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach                       

                </tbody>
            </table>
        </div>
    </div>
</div>
