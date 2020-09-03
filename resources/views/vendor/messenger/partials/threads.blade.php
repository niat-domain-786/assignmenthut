<div class="">
   <h4 class="text-center my-3"><i class="fa fa-envelope"></i>&nbsp; All Threads</h4>

    <div class="panel-body">
        @foreach ($threads as $key => $thread)
        
        
                
            @if ($thread->lastMessage)
            @if(!($thread->withUser->id == 1) && !($thread->withUser->id == auth()->id()))
                <a href="{{ url('/messenger/chat',[$thread->withUser->id]) }}" class="thread-link" >
                    <div style=" width: 90%;
    margin-left: 5%;
    margin-right: 5%;" class="row thread-row 
                    @if (
                        !$thread->lastMessage->is_seen &&
                        $thread->lastMessage->sender_id != auth()->id()
                    )
                        unseen 
                    @endif
                    @if ($thread->withUser->id == $withUser->id)
                        current
                    @endif
                    ">
                        <p class="thread-user"  style="text-transform:capitalize;">
                            <strong>{{$thread->withUser->name}}</strong>
                        </p>
                        <p class="thread-message">
                            @if ($thread->lastMessage->sender_id == auth()->id())
                                <i class="fa fa-reply" aria-hidden="true"></i>
                            @endif
                            {{substr($thread->lastMessage->message, 0, 20)}}
                        </p>
                    </div>
                </a>
                
             
                
            @endif
          
            @endif
        @endforeach
    </div>
</div>
