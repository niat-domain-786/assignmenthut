@extends('layouts.master')
@section('content')
@can('isUser')
<div class="main-content">
    <!-- Section: home -->
    <section class="">
        <div class="container">
            <div class="row profile">
                <div class="col-md-3">
                  @include('order.user_sidebar')

                </div>
                <div class="col-md-9">
                  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


                        @if(session('message'))
                        <span role="alert" class="alert alert-success">{{ session('message') }}</span>
                        @endif 

                        @if(session('error'))
                        <span role="alert" class="alert alert-danger">{{ session('error') }}</span>
                        @endif
                        
                    <div class="profile-content">

               


                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Order No</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Service</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Solution</th>
                                    <th scope="col">Revision</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <th>{{ $order->id }}</th>
                                    <th>{{ round($order->price, 2) }} {{ $order->currency->name }}</th>
                                    <td>{{$order->service->name}}</td>
                                   
<td>
@if( !($order->completed == 1) )
<p class="text-danger">{{"Incomplete Order"}}</p>
{{-- <a class=" btn btn-sm btn-success" style="margin-bottom:2px; border-radius:24px;" href="{{url('checkout', [$order->id])}}">checkout Now</a> --}}
    <form action="{{ route('delete_user_order') }}" method="POST">
        @csrf

        <input type="hidden" name="orderId" value="{{$order->id}}">
        <input type="submit" style=" border-radius:24px;" name="submit" class="btn btn-sm btn-danger text-danger" value="Delete Order">
    </form>
@else

@if($order->status == "completed")
<span class="text-success">{{ "Completed " }}</span>
@else 
<span class="text-danger">{{" In Progress "}}</span>
@endif

@endif
</td>
 <td>{{ date('F d, Y', strtotime($order->created_at))}}</td>


<td>
@if($order->status == "completed")


<p data-toggle="modal" data-target="#filesDelivered{{ $order->id }}" >
    <a href="#" onclick="event.preventDefault()">
      {{ "Download"}} </a></p>



<!-- Modal to download files delivered -->
<div class="modal fade" id="filesDelivered{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="filesDelivered{{ $order->id }}label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="margin-top:140px;">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel{{ $order->id }}"> <i class="fa fa-download" ></i> Download your files.</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>



          {{-- @endforeach --}}
         {{-- @endif --}}
              <div class="container"><h3>Files Delivered - Click to download</h3>
              <br>

          </div>

             
            @forelse($order->files as $f)
        

        <form action="{{ route('download_completed_assignment') }}" method="POST" class="form-group" enctype="multipart/form-data">
        @csrf
        @if($f->file_delivered)
          <div class="modal-body">

        <input type="hidden" value="{{ $order->id}}" name="orderId">    
        <input type="hidden" value="{{$f->file_delivered}}" name="fileName">  

            
        <div class="container" style="font-size:1rem;">

        @php
        $path = 'public/files/orders/'.Auth::User()->id.'/delivered/';
        $fileName = str_replace($path, "", $f->file_delivered); 
        @endphp 
            <button class="btn btn btn-warning" type="submit" name="submit">
             {{$fileName}} </button>  </div>            
        </div>
        @endif
        </form>
        @empty
        <div class="container">
          <blockquote>
            <h4>Admin sent 0 files</h4>
          </blockquote>
        </div>
        
         @endforelse

                 <div style="float:left;" class="modal-body">
                  <h3>Notes by Admin: </h3>
                    @foreach($order->notes as $note)
                 
                    <p><li>{{$note->text}}</li></p>
                   

                    @endforeach

              
                    <hr>
            </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-warning" data-dismiss="modal" style="border-radius:25px;">Cancel</button>
     
      </div>
    </div>
  </div>
</div>



@else 
<td> 
  
    {{$order->solution ?? "-"}} 

</td>

@endif
</td>

@if($order->status == "completed")
<td><span data-toggle="modal" data-target="#review{{ $order->id }}" ><a href="#">{{ "Request"}} </a></span></td>
 @else 
<td><span >{{ "-"}}</span></td>

@endif
</tr>



<!-- Modal to submit the review for order -->
<div class="modal fade" id="review{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="review{{ $order->id }}label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="margin-top:140px;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel{{ $order->id }}"><strong>Need A Revision?</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="{{ route('submitRevision') }}" method="POST" class="form-group" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
        <div class="my-4">
        <h4>Please Fill the following form.</h4>
       <input type="hidden" name="orderID" value="{{ $order->id }}">
       <input type="hidden" name="service" value="{{ $order->service->id }}">
       <textarea name="note"  cols="30" rows="10" class="form-control" placeholder="Your Notes"></textarea>
       <h4>Attach a file if needed.</h4>
       <h4 style="display:none; color:red;" id="warning{{$order->id}}">Error! Please Select Up To 5 Files(or make a ZIP) </h4>
       <input type="file" name="files[]" multiple="multiple">
     
           </div>                     
        
                                
      </div>
      <div class="modal-footer" style="display:block;">
        <button type="button" class="btn btn-warning" data-dismiss="modal" style="border-radius:25px;">Cancel</button>
        <button id="submit_btn{{$order->id}}"  type ="submit" name ="submit" class=" submit_btn btn  btn-success" style="border-radius:25px;">Request A Revision</button> 
        </form>
                <script>

                  $("input[type='file']").on("change", function(){  
                    var numFiles = $(this).get(0).files.length;
                    if(numFiles > 5){
                    document.getElementById('submit_btn{{$order->id}}').setAttribute("disabled", "disabled");
                    document.getElementById('warning{{$order->id}}').style.display= 'block';
                     // alert(numFiles);
                    }else{
                    document.getElementById('submit_btn{{$order->id}}').removeAttribute("disabled", "disabled");
                    document.getElementById('warning{{$order->id}}').style.display = 'none';

                    }
                  });
        </script>

        @section('styles')

<script src="{{asset('assets/js/jquery-2.2.4.min.js')}}"></script>



        @endsection
    
      </div>
    </div>
  </div>








@endforeach
                                {{--  <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endcan
@endsection