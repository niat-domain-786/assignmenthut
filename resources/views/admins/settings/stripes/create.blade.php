@extends('admins.layouts.master')

@section('content')

	<div class="row" style="margin-top: 50px;">
		<div class="col-md-6 col-md-offset-3">
			<h1>Create New Stripe Key</h1>

			{!! Form::open(['route' => 'admin.stripe.store','method' => 'post']) !!}

				{!! Form::label('name','Name') !!}
				{!! Form::text('name',null,['class' => 'form-control']) !!}

				{!! Form::label('clientid','Client Id Key') !!}
				{!! Form::text('clientid',null,['class' => 'form-control']) !!}

				{!! Form::label('clientsecret','Client Secret Key') !!}
				{!! Form::text('clientsecret',null,['class' => 'form-control']) !!}

				{!! Form::label('mode','Mode') !!}
				<select name="mode" class="form-control">
	              	<option value="test">Test</option>
	              	<option value="live">Live</option>
	              
	            </select>  

				
				{!! Form::submit('Submit',['class'=>'btn btn-success btn-top-spacing']) !!}

			{!! Form::close() !!}

		</div>
	</div>




@stop
