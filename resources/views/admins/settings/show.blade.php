@extends('admins.layouts.master')

@section('content')
	
	<div class="row" style="margin-top: 50px;">
		<div class="col-md-8 col-md-offset-2">
			<p><strong>User ID:</strong> {{ $payout->user->id }}</p>			
			<p><strong>User Name:</strong> {{ $payout->user->name }}</p>			
			<p><strong>Amount:</strong> {{ $payout->amount }}</p>			
			<p><strong>Type:</strong> {{ $payout->type }}</p>			
			<p><strong>Date:</strong> {{ $payout->updated_at->diffForHumans() }} / {{ $payout->updated_at }}</p>					
		</div>		
    </div>
@stop
