@extends('layouts.master')
@section('content')
<div class="main-content">
    <!-- Section: home -->
    <section class="">
        <div class="container">
            <div class="row profile">

                <div class="col-md-3">
                
                  
@include('order.user_sidebar')
                </div>
                <div class="col-md-9">

     <h2>Revisions</h2>
                  
            

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
                                    <th>Order No</th>
                                    <th>Revision Count</th>
                                    <th>Service</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Solution</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <th>{{ $order->order->id }}</th>
                                    <th>{{ $order->iteration}}</th>
                                    <td>{{$order->service->name}}</td>
                                    <td>{{ date('F d, Y', strtotime($order->updated_at))}}</td>
<td>
@if($order->solved == "1")
<span class="text-success">{{'Solved'}}</span>
@else 
<span class="text-danger">{{ 'In Progress'}}</span>
@endif
</td>


<td>
@if($order->solved == "1")

<span data-toggle="modal" data-target="#download{{ $order->id }}" >
    <a href="#" onclick="event.preventDefault()"> <i class="fa fa-download"></i> &nbsp; {{ "Download"}} </a></span>

@else 
<td><span>@if($order->solved=="0") {{ "Pending.." }}   @endif</span></td>

@endif
</td>

</tr>






<!-- Modal to submit the review for order -->
<div class="modal fade" id="download{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="review{{ $order->id }}label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="margin-top:140px;">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel{{ $order->id }}">Download your files.</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

          <div class="container">
           <!--   <h4>File Attached for Revision</h4> </div> -->
           <!--<a href="{{ route('revision_attachment.download',['id'=> $order->id]) }}"> -->

           <!-- <div class="container">-->
           <!--     <span class="btn btn-sm btn-success">-->
           <!--         <i class="fa fa-download"></i>&nbsp; {{ "Download File" }}</span> </div></a>-->

              <div class="container"><h4>Files Delivered To You</h4> </div>
            @foreach($order->order->files as $key => $f)

        <form action="{{ route('download_completed_assignment') }}" method="POST" class="form-group" enctype="multipart/form-data">
        @csrf
        @if($f->revision_file)
        <div class="modal-body">

        <input type="hidden" value="{{ $order->order->id }}" name="orderId">    
        <input type="hidden" value="{{$f->revision_file}}" name="fileName">    
            
        <div class="container" style="font-size:1rem;"> 
            <button class="btn btn-sm btn-success p-1"  type="submit" name="submit">
                <i class="fa fa-download"></i>
                <?php echo $key; ?> {{ " Download File" }}

            </button> 

        </div> 

        </div>
        @endif
        </form>
         @endforeach
         </div>
        
        <div class="clear-fix"></div>
        <div style="float:left;" class="modal-body">
                  <h3>Notes by Admin: </h3>
                     @foreach($order->order->notes as $note)
                 
                    <p><li>{{$note->text}}</li></p>
                   

                    @endforeach

              
                   
            </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal" style="border-radius:25px;">Cancel</button>
     
      </div>
    </div>
  </div>



@endforeach
                       
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection