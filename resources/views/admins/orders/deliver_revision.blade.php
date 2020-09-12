@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-3 col-sm-12">
					
<!-- ========== Left Sidebar Start ========== -->
            @include('admins.partials.left-sidebar')
         

<!-- Left Sidebar End -->


				
				</div>

				<div class="col-md-8 col-sm-12" id="vueapp">
					<div class="card">
						<div class="card-header" style="display: flex;justify-content: space-between;align-items: center;">
							<span>Revision Information</span>
							<span id="status-bar" class="btn btn-sm @if($revisions->order->status == 'In Progress') btn-info @elseif($revisions->order->status == 'completed') btn-success @else btn-danger @endif" style="color:white;padding: 10px;">Order Status: {{ ucwords($revisions->order->status) }}</span>
							<span id="revision-status" class="btn btn-sm @if($revisions->solved == '0') btn-secondary @elseif($revisions->solved == '1') btn-success @else btn-danger @endif" style="color:white;padding: 10px;"> @if($revisions->solved == '1') Revision Status: {{ "Sloved" }} @else Revision Status: {{ 'In Progress'}}  @endif</span>
							
						</div>
						<div class="card-body">
							@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
							@endif
							@if (session('error'))
							<div class="alert alert-danger" role="alert">
								{{ session('error') }}
							</div>
							@endif
							<strong>Ordered Service</strong>   : {{ $revisions->service->name }}
							
							<br>
							<strong>Revision Count</strong>  : <a class="badge badge-secondary text-white" style="padding:5px;"><strong>{{ $revisions->iteration }}</strong></a>
							<br>
							<strong>Order No</strong>  : <a class="badge badge-success text-white" style="padding:5px;"><strong>{{ $revisions->assignment_order_id }}</strong></a>
							<br>
							<strong>Amount</strong>  : {{  $revisions->order->price }} {{$revisions->order->currency->name}}
							<br>
							
							<strong>Date</strong>  : {{ $revisions->updated_at }}
							
								      <br>
                                <hr>
                                
                                <strong><h5>Paper Details</h5></strong>
                                @if($revisions->order->meta_data)
                                <strong>Paper Format : </strong> {{ $revisions->order->meta_data->paper_format}}
                                <br>
                                <strong>Number Of Sources : </strong> {{ $revisions->order->meta_data->no_of_sources}}
                                <br>
                                <strong>Comments : </strong> <em>{{ $revisions->order->meta_data->order_comments}}</em>
                                @else
                                <strong>No Data Available...</strong>
                                @endif

                                <br>
                                <hr>
                                
							<strong><h5>User Info</h5></strong>
							<strong>Name</strong>  : {{ $revisions->user->name }}<br>
							<strong>Email</strong>  : {{ $revisions->user->email }}<br>
							<strong>Phone</strong>  : {{ $revisions->user->phone }}

							
							<hr>
							<strong>Note Sent By User</strong>  : {{ $revisions->note }}
							<br>
						
							
                                @if($revisions->file)
                            <br>
                            <strong>Files(Sent By User)</strong>  :
                            @foreach($revisions->file as $key => $value)
                             <a href="{{ route('revision-file-download',['id'=> $revisions->id, 'key'=>$key]) }}" class="btn btn-sm btn-outline-secondary"> <i class="fa fa-download"></i> &nbsp;
                              {{$key+1}}-{{ "Download File" }}</a>
                              @endforeach
                            @endif
                            <hr>

                            <h3>Submit This Revision</h3>
                            <li>Please upload files</li>
                            <li>Write a note if required</li>
                            <li>Then deliver button will appear</li>
                            <li>Press the button</li>
                            <li>Pressing multiple times will simply update the revision submission</li>
							
							
							
						
							<button class="btn btn-default m-2"  v-on:click="showAddNote">
							Add Note </button>
							<button class="btn btn-default m-2" v-on:click="showAddFile">Upload Documents</button>
							@if($filecount > 0)
							 @if($revisions->solved == '1')
							 <button class="btn btn-success m-2" v-on:click="deliver_revision" style="border-radius:25px;" id="submit-rev-btn">Update Revision</button>
							 @else

							<button class="btn btn-success m-2" v-on:click="deliver_revision" style="border-radius:25px;" id="submit-rev-btn">Submit The Revision</button>
							@endif

							@endif
							<template v-if="addNoteView">
							<hr>
							<form action="{{ route('addnote',['id' => $revisions->order->id]) }}" method="post">
								@csrf
								<textarea name="note" id="" cols="30" rows="10" v-model="note" class="form-control" placeholder="Update Note"></textarea>
								<button class="btn btn-default btn-primary mt-1" v-html="submitButtonText"></button>
							</form>
							
							</template>
							<template v-if="addFileView">
							<hr>
							<form action="{{ route('add_revision_file') }}" method="POST" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name="orderID" value="{{ $revisions->order->id }}">
								<input
								type="file"
								class="file"
								name="file"
								>
								
								<small>Maximum upload file size: 10 MB</small>
								<br>
								<button class="btn btn-default btn-primary mt-1" v-html="submitButtonText"></button>
							</form>
							</template>
							
						</div>
					</div>

					{{-- revision files --}}


					<div class="card mt-4">
						<div class="card-header" style="display: flex;justify-content: space-between;align-items: center;">
							<h3>Revision Files</h3>
							
						</div>
						
						<div class="card-body">
							{{-- @dump($revisions->order->files) --}}
							
							@foreach($revisions->order->files->sortByDesc('id') as $key => $file)
								@if($file->revision_file)
							<div style="display: flex;justify-content: space-between;align-items: center; margin:5px 10px;">
								<span><a class="btn btn-outline-success btn-sm p-1" href="{{ route('admin-revision-file-download',['id'=> $file->id]) }}">
									<?php echo $key; ?> - {{" Revision File " }}&nbsp; <i class="fa fa-download"></i></a>
								</span>

								<a href="/" onclick="event.preventDefault()"><span  class="p-1 text-danger" data-toggle="modal" data-target="#deleteRevisionFile{{ $file->id}}" ><i class="fa fa-trash"></i>  &nbsp; Delete </span></a>

								@endif
								{{-- <span>uploaded {{ $file->created_at->diffForHumans() }}</span> --}}
								<!-- Modal for deleting the note -->
								<div class="modal fade" id="deleteRevisionFile{{$file->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteNote{{ $file->revision_file }}label" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Delete File?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
												</button>
											</div>
		<form action="{{ route('deleteFile') }}" method="POST">
												<div class="modal-body">
													@csrf
													@method('DELETE')
		<input type="hidden" name="FileId" value="{{ $file->id }}">
		<input type="hidden" name="FilePath" value="{{ $file->revision_file }}">
		<p>This action will be permanent.</p>
	<span><strong>Name: </strong>{{ substr($file->revision_file, 41) }}</span>
													
													
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
													<button type ="submit" name ="submit" class="btn  btn-danger">Delete</button>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
							<hr>
							@endforeach
								<div class="clearfix"></div>

					<div class="card mt-4">
						<div class="card-header" style="display: flex;justify-content: space-between;align-items: center;">
							<h3>Additional Files (submitted by the admin while delivering assignment)</h3>
							
						</div>
						
						<div class="card-body">
							
							@foreach($revisions->order->files->sortByDesc('id') as $key => $file)
							@if($file->file_delivered)
							<div style="display: flex;justify-content: space-between;align-items: center;">

								<span>
					<a href="{{ route('solver_file.download',['id'=> $file->id]) }}" class="btn btn-sm p-1 btn-outline-success">
									<?php echo $key+1; ?>-{{ "Download Assignment File" }} &nbsp; <i class="fa fa-download"></i>
								</a></span>
								<a href="/" onclick="event.preventDefault()"><span  class="p-1 text-danger" data-toggle="modal" data-target="#deleteFile{{ $file->id}}" ><i class="fa fa-trash"></i>  &nbsp; Delete </span></a>

								{{-- <span>uploaded {{ $file->created_at->diffForHumans() }}</span> --}}
								<!-- Modal for deleting the note -->
								<div class="modal fade" id="deleteFile{{$file->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteNote{{ $file->file_delivered}}label" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Delete File?</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												</button>
											</div>
		<form action="{{ route('deleteFile') }}" method="POST">
			<div class="modal-body">
													@csrf
													@method('DELETE')
			<input type="hidden" name="FileId" value="{{ $file->id }}">
			<input type="hidden" name="FilePath" value="{{ $file->file_delivered }}">
			<p>This action is not reversible. It will remove for end user too.</p>
			<span><strong>Name: </strong>{{ substr($file->file_delivered,32) }}</span>
													
													
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
													<button type ="submit" name ="submit" class="btn  btn-danger">Delete</button>
												</form>
											</div>
										</div>
									</div>
								</div>

							</div>
							<hr>
							@endif
							@endforeach
						</div>
										
					
					<div class="card mt-4">
						<div class="card-header" style="display: flex;justify-content: space-between;align-items: center;">
							<h3>Notes By Admin</h3>
							
						</div>
						
						<div class="card-body">
							
							@foreach($revisions->order->notes->sortByDesc('id') as $note)
							<div style="display: flex;justify-content: space-between;align-items: center;">
								
								
								
								<span class="col-md-6">{{ $note->text }}</span>
								<span>{{ $note->created_at->diffForHumans() }}</span>
								<a href="/" onclick="event.preventDefault()"><span  class="text-danger" data-toggle="modal" data-target="#deleteNote{{ $note->id }}"><i class="fa fa-trash"></i> &nbsp;Delete &nbsp; </span> </a>
								
								<!-- Modal for deleting the note -->
								<div class="modal fade" id="deleteNote{{ $note->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteNote{{ $note->id }}label" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Delete Note?</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form action="{{ route('deleteNote') }}" method="POST">
												<div class="modal-body">
													@csrf
													@method('DELETE')
													<input type="hidden" name="noteId" value="{{ $note->id }}">
													<span><strong>Note: </strong>{{ $note->text }}</span>
													
													
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
													<button type ="submit" name ="submit" class="btn  btn-danger">Delete</button>
												</form>
											</div>
										</div>
									</div>
								</div>
								
							</div>
							<hr>
							@endforeach
						
					</div>
						</div>
					

					{{-- //revision files --}}

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('vue')
<script>
	new Vue({
		el: '#vueapp',
		data: {
		message: 'Hello Vue!',
		addNoteView:false,
		addFileView:false,
		note:"",
		submitButtonText:"Submit"
	},
	methods: {
		showAddNote() {
		console.log('clicking');
		this.addNoteView = !this.addNoteView;
		this.addFileView = false;
	},
	showAddFile() {
		console.log('clicking');
		this.addFileView = !this.addFileView;
		this.addNoteView = false;
	},
	addNote(){
		console.log('adding note');
		axios.post('/addnote/{{ $revisions->order->id}}', {
		note:this.note
	},
	{
		headers: {
		"Content-Type": "multipart/form-data"
		}
	})
	.then(function (response) {
	console.log(response);
	self.submitting = false;
	if(response.data.link){
	window.location.href = response.data.link;
	return;
	}
	self.error = response.errors;
	self.submitButtonText = 'Submit & Pay'
	})
	.catch(function (error) {
	// console.log('error');
	// console.log(error.response.data.errors);
	self.submitting = false;
	self.error = error.response.data.errors;
	self.submitButtonText = 'Submit & Pay'
	});
	},
		submitFile(){
    		console.log('adding note');
    		let formData = new FormData();
    		formData.append("file", this.file);
    		this.submitButtonText = '<i class="fa fa-spinner fa-spin"></i>'
    		this.submitting = true;
    		axios.post('/addnote/{{ $revisions->order->id}}', {
    		note:this.note
		},
			{
				headers: {
				"Content-Type": "multipart/form-data"
				}
		})
		.then(function (response) {
            return;
    	
		})
		.catch(function (error) {
            return;
		});
	},
	handleFileUpload() {
	this.file = this.$refs.file.files[0];
	},
	deliver_revision(){
		console.log('submit revision and file');
		axios
	.post('{{ route('admin.order.submit_revision')  }}', {
		revisionID:{{ $revisions->id }},
		orderID:{{ $revisions->order->id }},
	})
	.then(function(response) {
		console.log(response.data);
		var element = document.getElementById("status-bar");
		var btn = document.getElementById("submit-rev-btn");
		btn.innerHTML = "Revision Delivered Successfully!"
			
			element.innerHTML = "Success! Revision Submited Successfully";
		var revision_status = document.getElementById('revision-status');
			revision_status.innerHTML = "Revision Completed";
		
			revision_status.classList.add("btn-success");
	})
	.catch(function(error){
			var d = document.getElementById("status-bar");
			d.classList.remove("badge-success");
			d.classList.add("badge-danger");
			d.innerHTML = "Sorry! Revision Not Submited, Please Try again";
	})
	
	
	},
	}
	})
</script>
@endsection


@section('livechat-styles')
        <style>
            #livechat-compact-container {
  height: 153px;
  position: fixed;
  right: 0;
  top: 200px;
  top: 30vh;
  z-index: 10000;
}
.btn-chat a {
  font-family: arial;
  color: #fff;
  text-decoration: none;
  background: #1798F7;
  padding: 24px 20px 8px;
  display: block;
  font-weight: bold;
  font-size: 14px;
  box-shadow: 0 0 0 1px #03b2ff inset;
  border: 1px solid #144866;
  border-radius: 2px;
  -ms-transform: rotate(90deg) translate(0, -20px);
  -webkit-transform: rotate(90deg) translate(0, -20px);
  transform: rotate(90deg) translate(0, -20px);
  position: relative;
  right: -27px;
  transition: background 0.2s, right 0.2s;
}
.btn-chat a:hover {
  background: #47B6F5;
  right: -20px;
  transition: background 0.2s, right 0.2s;
}
        </style>

@endsection

@section('livechat-code')
    {{-- live chat code --}}
  {{--  <div class="btn-chat" id="livechat-compact-container" style="visibility: visible; opacity: 1;">
    <div class="btn-holder">
        <a  href="{{ url('/messenger/chat', [$order->user->id]) }}" class="link" target="_blank"> Chat Here</a>
    </div>
</div> 
 --}}
{{-- live chat code ends --}}

@endsection