<div  wire:poll>
    @if($selected_conversation)
   
    <div class="main-content-body main-content-body-chat">
        <div class="main-chat-header">
            @if ($receviverUser->image)
            <div class="main-img-user"><img alt="" src="{{URL::asset('Dashboard/img/doctors/'.$receviverUser->image->filename)}}"></div>
                
            @endif
            <div class="main-chat-msg-name">
                <h6>{{$receviverUser->name}}</h6>
            </div>
            <nav class="nav">
                <a class="nav-link" href=""><i class="icon ion-md-more"></i></a> <a class="nav-link" data-toggle="tooltip" href="" title="Call"><i class="icon ion-ios-call"></i></a> <a class="nav-link" data-toggle="tooltip" href="" title="Archive"><i class="icon ion-ios-filing"></i></a> <a class="nav-link" data-toggle="tooltip" href="" title="Trash"><i class="icon ion-md-trash"></i></a> <a class="nav-link" data-toggle="tooltip" href="" title="View Info"><i class="icon ion-md-information-circle"></i></a>
            </nav>
        </div><!-- main-chat-header -->
        <div class="main-chat-body" id="ChatBody">
            <div class="content-inner">

                @foreach($messges as $message)
                <div class="media {{auth()->user()->email == $message->sender_email ?'flex-row-reverse':''}}">
                    <div class="media-body">
                        <div class="main-msg-wrapper right">
                            {{$message->body}}
                        </div>
                        <div>
                            <span>{{$message->created_at}}</span> <a href=""><i class="icon ion-android-more-horizontal"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

</div>
