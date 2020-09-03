@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    @include('partials.sidebar')
                </div>
                <div class="col-md-9" id="vueapp">
                    <div class="card">
                        <div class="card-header" style="display: flex;justify-content: space-between;align-items: center;">
                            <span>Order Information</span>
                            <span class="badge badge-pill @if($order->status == 'processing') badge-info @elseif($order->status == 'completed') badge-success @else badge-danger @endif" style="color:white;padding: 5px 10px;">{{ ucwords($order->status) }}</span>
                            
                        </div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
                                    {{ session('status') }}
                                </div>
                            @endif

                            <strong>Ordered Service</strong>   : {{ ucwords(unserialize($order->description)['product']['category']['subject']['name']) }} {{ ucwords(unserialize($order->description)['product']['category']['name']) }} 
                                                {{ ucwords(unserialize($order->description)['product']['name']) }} 

                            <br>

                            <strong>Amount</strong>  : {{  $order->amount }} {{ unserialize($order->description)['currency']['name'] }}

                            <br>

                            <strong>Details</strong>  : {{ $order->details }}
                            
                            @if($order->file)
                            <br>

                            <strong>File Attached</strong>  : <a href="{{ route('orderfile.download',['id'=> $order->id]) }}"> {{ substr($order->file,6) }}</a>

                            @endif

                            <hr>

                            <button class="btn btn-default" v-on:click="showAddNote">Add Note</button>
                            <button class="btn btn-default" v-on:click="showAddFile">Upload Documents</button>

                            <template v-if="addNoteView">
                                <hr>
                                <form action="{{ route('addnote',['id' => $order->id]) }}" method="post">
                                    @csrf
                                    <textarea name="note" id="" cols="30" rows="10" v-model="note" class="form-control"></textarea>
                                    <button class="btn btn-default btn-primary mt-1" v-html="submitButtonText"></button>
                                </form>
                                
                            </template> 
                            <template v-if="addFileView">
                                <hr>
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

                    <div class="card mt-4">
                        <div class="card-header" style="display: flex;justify-content: space-between;align-items: center;">
                            <span>Additional Files</span>
                            
                        </div>
                        

                        <div class="card-body">
                            
                            @foreach($order->files->sortByDesc('id') as $file)
                                <div style="display: flex;justify-content: space-between;align-items: center;">
                                    <span><a href="{{ route('file.download',['id'=> $file->id]) }}">{{ substr($file->file,6) }}</a></span>
                                    <span>uploaded {{ $file->created_at->diffForHumans() }}</span>                                    
                                </div>
                                <hr>
                            @endforeach



                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header" style="display: flex;justify-content: space-between;align-items: center;">
                            <span>Notes</span>
                            
                        </div>
                        

                        <div class="card-body">
                            
                            @foreach($order->notes->sortByDesc('id') as $note)
                                <div style="display: flex;justify-content: space-between;align-items: center;">
                                    <span>{{ $note->text }}</span>
                                    <span>{{ $note->created_at->diffForHumans() }}</span>                                    
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
                }
            }
        })
    
    
    </script>

@endsection
