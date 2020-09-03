@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    @include('partials.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">My Orders</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Amount</th>
                                        {{-- <th>Username</th> --}}
                                        <th>Ordered Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php $i=1; ?> 
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>
                                                {{ unserialize($order->description)['product']['category']['subject']['name'] }} {{ unserialize($order->description)['product']['category']['name'] }} <br>
                                                {{ unserialize($order->description)['product']['name'] }} 
                                            </td>
                                            <td>{{  $order->amount }} {{ unserialize($order->description)['currency']['name'] }}</td>    
                                            <td>{{ date('F d, Y h:s', strtotime($order->created_at))}}</td>
                                            <td>{{ ucwords($order->status) }}</td>

                                            <td>
                                                <a href="/order/{{$order->id}}" class="btn btn-icon btn-xs waves-effect waves-light btn-default"> View More</a>
                                            </td>                                
                                            {{-- <td>
                                                    <a href="{{ route('admin.order.show',['id' => $order->id])}}" class="btn btn-icon btn-xs waves-effect waves-light btn-success"> <i class="fa fa-eye"></i> </a>
                                            </td> --}}                                                                       
                                            
                                        </tr>
                                    @endforeach                                                                                                     

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
