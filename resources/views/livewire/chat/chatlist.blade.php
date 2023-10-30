<div wire:poll>
    <div class="main-chat-list" id="ChatList">
        @foreach($conversations as $conversation)
            <div class="media new"
                 wire:click="chatUserSelected({{ $conversation }},'{{ $this->getUsers($conversation,$name='id')}}')"
                 >
                <div class="media-body">
                    <div class="media-contact-name">
                        <span>{{$this->getUsers($conversation,$name='name')}}</span>
                        @if ($conversation->messages->count()>0)
                            @if ($conversation->messages->last()->read==1)
                            <span style="font: bold">{{$conversation->messages->last()->created_at->shortAbsoluteDiffForHumans()}}</span>
                                @else
                                <span>{{$conversation->messages->last()->created_at->shortAbsoluteDiffForHumans()}}</span>

                            @endif
                            
                        @endif
                    </div>
                    @if ($conversation->messages->count()>0)
                       @if ($conversation->messages->last()->read==1)
                    
                         <p style="font: bold">{{$conversation->messages->last()->body}}</p>
                        @else
                       <p>{{$conversation->messages->last()->body}}</p>
                       @endif

                    @endif
                </div>
            </div>
        @endforeach
    </div><!-- main-chat-list -->
</div>

