@extends('admins.layouts.master')


@section('content')

<div class="container" style="padding-top:15px;">
	<div class="col-md-8">
		<div class="card shadow-md" style="background-color:#fff; margin:10px; padding:20px;">
			<div class="card-header">
				<h2>search Result</h2>
				<hr>
			</div>
			<div class="card-body">
				@forelse($results as $result)
				<p><strong>Order No: </strong> {{$result->id}}</p>
				<p><strong>User Name: </strong> {{$result->user->name}}</p>
				<p><strong>User Email: </strong>{{$result->user->email}}</p>
				<p><strong>Status: </strong>{{$result->status}}</p>
				<p><strong>Date: </strong>{{$result->updated_at}}</p>
				@if($result->revisions)
				@forelse($result->revisions as $revision)
				<span><strong>Revisions: </strong><a href="{{ route('admin.order.deliver_revisions',[$revision->id]) }}" class="btn btn-icon btn-xs waves-effect waves-light btn-info" target="_blank"> <i class="fa fa-eye"></i>  :  <span>{{ $revision->updated_at }} </span></a></span>
				{{-- <p><strong></strong>{{$revision->id}}</p> --}}

				
				

				@empty
				<p>No revisions found.</p>
				@endforelse

				@endif
				<div>
<hr>
				 <a href="/admin/order/{{$result->id}}" class="btn btn-icon btn-xs waves-effect waves-light btn-info" target="_blank"> <i class="fa fa-eye"></i> <strong> : View Order </strong> </a> 
				</div>
@empty
<h4>No Results Found!</h4>

				@endforelse
			</div>
			
		</div>
	</div>
</div>

@stop
