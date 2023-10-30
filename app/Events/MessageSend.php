<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\Patient;
use App\Models\Messages;
use App\Models\Consrvation;
use App\Models\Doctor;

class MessageSend implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $sender;
    public $reciver;
    public $conservation;

        public function __construct(Patient $sender ,Messages $message,Consrvation $conservation,Doctor $reciver)
    {
        $this->message=$message;
        $this->sender=$sender;
        $this->reciver=$reciver;
        $this->conservation=$conservation;
        
    }

    // public function broadcastWith()
    // {
    //     // return [
    //     //     'sender_email' => $this->sender->email,
    //     //     'message' => $this->message->id,
    //     //     'conversation_id' => $this->conservation->id,
    //     //     'receivere_email' => $this->reciver->email,
    //     // ];
    // }
    public function broadcastOn()
    {   return new Channel('chat.'.$this->reciver->id);
        // return new PrivateChannel('chat.'.$this->reciver->id);
      
    }
}
