@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-3">
<!-- ========== Left Sidebar Start ========== -->

            @include('admins.partials.left-sidebar')

<!-- Left Sidebar End -->

				</div>
				<div class="col-md-8" id="vueapp">
					<div class="card">
						<div class="card-header" style="display: flex;justify-content: space-between;align-items: center;">
							<span>Order Information</span>
							<span id="status-bar" class="badge badge-pill @if($order->status == 'processing') badge-info @elseif($order->status == 'completed') badge-success @else badge-danger @endif" style="color:white;padding: 5px 10px;">Order Status: {{ ucwords($order->status) }}</span>
							
						</div>
						<div class="card-body">
							@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
							@endif

				       
        @if (session('success'))
            <div class="alert alert-success" role="alert" style="border-radius: 25px;">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert" style="border-radius: 25px;">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        {{ session('error') }}
            </div>
        @endif


							<strong>Ordered Service</strong>   :{{$order->service->name}}
							<br>
							<strong>Order ID</strong>  : <a class="badge badge-primary text-white px-2"><strong>{{ $order->id }}</strong></a>
							<br>
							<strong>Amount Paid</strong>  : {{number_format((float)$order->price, 2, '.', '') ." ".  $order->currency->name }}
							<br>
							<strong>Service</strong>  : {{ $order->service->name }} 
               <br>
              <strong>Paper Type</strong>  : {{ $order->paper->name }} 
               <br>
              <strong>Number Of Pages</strong>  : {{ $order->no_of_pages }} 
               <br>
              <strong>Time Of Order</strong>  : {{ $order->created_at->diffForHumans() }}


                                @if($order->exp_time->urgency_hour_or_day == "days")
                              <br> <strong>Expiry Date</strong>  : {{ $order->created_at->addDays($order->exp_time->urgency_value )->diffForHumans() }}
                                @endif

                                @if($order->exp_time->urgency_hour_or_day == "hours")
                               
                                  
              <br><strong>Expiry Date</strong>  : {{ $order->created_at->addHours($order->exp_time->urgency_value)->diffForHumans() }}


                                @endif
                                <br>
                                <hr>
                                
                                <strong><h5>Paper Details</h5></strong>
                                @if($order->meta_data)
                                <strong>Paper Format : </strong> {{ $order->meta_data->paper_format}}
                                <br>
                                <strong>Number Of Sources : </strong> {{ $order->meta_data->no_of_sources}}
                                <br>
                                <strong>Comments : </strong> <em>{{ $order->meta_data->order_comments}}</em>
                                @else
                                <strong>No Data Available...</strong>
                                @endif

                                <br>
                                <hr>
             

       
							
							
							@if($order->order_files)
							<br>
							<strong>File Attached By Customer</strong>  : 

              @foreach($order->order_files as $key => $file)
             <?php $fileNo = $key+1; ?>
              <a href="{{ route('orderfile.download',['id'=> $order->id, 'key'=>$key]) }}" class="btn btn-sm btn-outline-primary"> <i class="fa fa-download"></i> &nbsp;{{ "File ". $fileNo }}</a>
              @endforeach

							@endif
                  <hr> <strong><h5>Customer Information</h5></strong>
              <strong> Name</strong>  : {{ $order->user->name }}
              <br><strong> Email</strong>  : {{ $order->user->email }}
              <br><strong> Phone No</strong>  : {{ $order->user->phone ?? "---" }}
							<hr>
              <h3>Deliver Assignment</h3>
              <li>Select assignment files</li>
              <li>Create a ZIP of Multiple Files(Recomended, But Optional)</li>
              <li>Add Notes if required</li>
              <li>Then click the deliver button to send it to user.</li>
							<button class="btn btn-default m-2"  v-on:click="showAddNote">
							Add a Note </button>
							<button class="btn btn-default m-2" v-on:click="showAddFile">Upload files</button>

              @if($file_delivered > 0)

               @if($order->status == 'completed')
							<button class="btn btn-outline-primary m-2" id="btn-deliver-project" v-on:click="deliver_project" title="please upload assignment files" >Update This Project</button>
              @else              
               
              <button class="btn btn-primary m-2" id="btn-deliver-project" v-on:click="deliver_project" title="please upload assignment files" >Deliver This Project</button>
              @endif

              @endif

							<template v-if="addNoteView">
							<hr>
							<form action="{{ route('addnote',['id' => $order->id]) }}" method="post">
								@csrf
								<textarea name="note" id="" cols="30" rows="10" v-model="note" class="form-control" placeholder="Update Note"></textarea>
								<button class="btn btn-default btn-primary mt-1" v-html="submitButtonText"></button>
							</form>
							
							</template>
							<template v-if="addFileView">
							
							<form action="{{ route('addfile',['id' => $order->id]) }}" method="post" enctype="multipart/form-data">
								@csrf
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
					<div class="container">						
						<div class="mt-5">
							<h3>Additional Document Files To Deliver</h3>
							
							@foreach($order->files as $key=> $file)

            
             @if($file->file_delivered)
							<div class="container "style="display: flex;justify-content: space-between; align-items: center;">
								<span><a href="{{ route('solver_file.download',['id'=> $file->id]) }}" class="btn btn-sm btn-outline-primary p-1" style="margin:5px 1px;"> <i class="fa fa-download px-2"></i>
                  {{$key+1}}:&nbsp;{{ substr($file->file_delivered,32) }}</a></span>
					



							<a href="/" onclick="event.preventDefault()"><span  class="p-1 text-danger" data-toggle="modal" data-target="#deleteFile{{ $file->id}}" ><i class="fa fa-trash"></i>  &nbsp; Delete </span></a>
					




								<!-- Modal for deleting the note -->
<div class="modal fade" id="deleteFile{{$file->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteNote{{ $file->file_delivered }}label" aria-hidden="true">
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

								<strong>Note: </strong><p>File can't be recovered, and  this will remove for customer too.</p>
                  <p><strong>File: </strong>{{ substr($file->file_delivered,20) }}</p>
								
								
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type ="submit" name ="submit" class="btn  btn-danger">Delete</button> 
        </form>
      </div>
    </div>
  </div>

</div>
  @endif






							</div>
						
							@endforeach
					
				
					<div class="card mt-4">
						<div class="card-header" style="display: flex;justify-content: space-between;align-items: center;">
							<span>Note</span>
							
						</div>
						
						<div class="card-body">
							
							@foreach($order->notes as $note)
							<div style="display: flex;justify-content: space-between;align-items: center;">
								
								

							

								<span class="col-md-6">{{ $note->text }}</span>
								<span>{{ $note->created_at->diffForHumans() }}</span>
								 <a  href="/" onclick="event.preventDefault()"><span  class="text-danger" data-toggle="modal" data-target="#deleteNote{{ $note->id }}"><i class="fa fa-trash"></i>  &nbsp; Delete </span> </a>

								

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
axios.post('/addnote/{{ $order->id}}', {
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
axios.post('/addnote/{{ $order->id}}', {
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
handleFileUpload() {
this.file = this.$refs.file.files[0];
},

deliver_project(){
	console.log('deliver file');
	axios
  .post('{{ route('DeliverFile', [$order->id])  }}')
  .then(function(response) {
  	console.log(response.data);
  	var element = document.getElementById("status-bar");
    var btn = document.getElementById("btn-deliver-project");
    btn.innerHTML = "Project Delivered Successfully";
  		element.classList.remove("badge-info");
  		element.classList.add("badge-success");
  		element.innerHTML = "completed";
  })
  .catch(error => console.log(error))
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
</div> --}}
{{-- live chat code ends --}}

@endsection