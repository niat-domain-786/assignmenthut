@php
$authId = auth()->id();
@endphp
@if ($messages)
    @foreach ($messages as $key => $message)
        <div class="row message-row d-flex" style="margin:5px;">
    <p style="border-radius:20px; " title="{{date('d-m-Y h:i A',strtotime($message->created_at))}}"
                @if ($message->sender_id == Auth::User()->id)
                    class="sent"
                @else
                    class="received"
                @endif >

                <span>
                @if( Auth::User()->isAdmin == 1 && $message->sender_id == $authId )            

                <img src="{{ asset('assets/icon.png') }}" alt="" width="25px" class="rounded-circle ">  &nbsp;

                @elseif($message->sender_id == $authId && $withUser->isAdmin == 1)
                
               {{--  <img src="{{ asset('files/profile/'.$withUser->profile_image) }}" alt="" width="25px" class="rounded-circle "> --}}

                  @if(Auth::User()->profile_image == "sample_img.jpg")
                            <img src='{{ asset("public/files/profile/sample_img.jpg") }}' class="img-responsive rounded-circle " alt="profile image" width="25px">  &nbsp;

                            @else

                             <img src='{{ asset('storage/app')."/".Auth::User()->profile_image }}' class="img-responsive rounded-circle " alt="profile image" width="25px">  &nbsp;
                            @endif

                @elseif( $withUser->isAdmin == 0)
                
               {{--  <img src="{{ asset('files/profile/'.$withUser->profile_image) }}" alt="" width="25px" class="rounded-circle "> --}}
                @if($withUser->profile_image == "sample_img.jpg")
                            <img src='{{ asset("public/files/profile/sample_img.jpg") }}' class="img-responsive rounded-circle " alt="profile image" width="25px">  &nbsp;

                            @else

                             <img src='{{ asset('storage/app')."/".$withUser->profile_image }}' class="img-responsive rounded-circle " alt="profile image" width="25px">  &nbsp;
                            @endif

                @elseif($withUser->isAdmin == 1)
                
                <img src="{{ asset('assets/icon.png') }}" alt="" width="25px" class="rounded-circle ">  &nbsp;
                
               
                @endif


                </span> {{$message->message}}
            </p>
            @if ($message->sender_id == $authId)
                <i class="fa fa-ellipsis-h fa-2x pull-right" aria-hidden="true">
                    <div class="delete" data-id="{{$message->id}}">Delete</div>
                </i>
            @else
                <i class="fa fa-ellipsis-h fa-2x pull-left" aria-hidden="true">
                    <div class="delete" data-id="{{$message->id}}">Delete</div>
                </i>
            @endif
        </div>
    @endforeach
@endif
