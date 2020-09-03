@extends('admins.layouts.master')


@section('content')
	<div class="row" style="margin-top: 50px;">
		<div class="col-md-6 col-md-offset-3">
			<h1>Edit paypal key</h1>

			{!! Form::model($key,['route' => ['admin.paypal.update','id'=>$key->id],'method' => 'put']) !!}

				{!! Form::label('name','Name') !!}
				{!! Form::text('name',null,['class' => 'form-control']) !!}

				{!! Form::label('clientid','Client Id Key') !!}
				{!! Form::text('clientid',null,['class' => 'form-control']) !!}

				{!! Form::label('clientsecret','Client Secret Key') !!}
				{!! Form::text('clientsecret',null,['class' => 'form-control']) !!}

				{!! Form::label('mode','Mode') !!}
				<select name="mode" class="form-control">
	              	<option @if($key->mode == 'test') selected="selected" @endif value="test">Test</option>
	              	<option @if($key->mode == 'live') selected="selected" @endif value="live">Live</option>	              
	            </select> 

				
				{!! Form::submit('Submit',['class'=>'btn btn-success btn-top-spacing']) !!}

			{!! Form::close() !!}

		</div>
	</div>


@stop
