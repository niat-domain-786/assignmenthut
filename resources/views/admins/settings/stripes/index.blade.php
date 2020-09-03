@extends('admins.layouts.master')


@section('content')


	<div class="row" style="margin-top: 50px;">
		<div class="col-md-6">
			<h1>All Stripe Keys</h1>
			<table class="table">

				<thead>
					<th>#</th>
					<th>Name</th>
					<th>Mode</th>										
					<th>Active</th>										
					<th></th>
					<th></th>
					<th></th>
				</thead>

				@foreach($keys as $key)
					<tbody>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $key->name }}</td>
					<td>{{ $key->mode }}</td>
					<td>{!! $key->is_active == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-times" aria-hidden="true"></i>' !!}</td>
					<td>
						@if($key->is_active != 1) 
							<a class="btn btn-primary" href="{{ route('admin.stripe.activate',['id' => $key->id]) }}">Activate Now</a>
						@endif
					</td>
					<td>
						<a class="btn btn-primary" href="{{ route('admin.stripe.edit',['id' => $key->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
					</td>
					<td>
						{!! Form::open(['route' => [ 'admin.stripe.destroy','key->id'=>$key->id ],'method' => 'delete']) !!}
							<button type="submit" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
						{!! Form::close() !!}
					</td>

 					</tbody>
				@endforeach

			</table>
			
		</div>
		<div class="col-md-6">
			<a class="btn btn-success btn-block btn-top-spacing" href="{{ route('admin.stripe.create') }}">Create New Key</a>
		</div>
	</div>


@stop
