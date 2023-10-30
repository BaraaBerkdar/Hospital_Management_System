<?php

namespace App\Events;
use App\Models\Patient;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MyEvent  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pation;
    public $message;
    public $created_at;
    public $doctor_id;
    public function __construct($data)
    {   $pation=Patient::find(($data['pation_id']));
        $this->pation   =$pation->name ;
        $this->message  =   $data['message'];
        $this->created_at=$data['created_at'];
        $this->doctor_id =$data['doctor_id'];
    }



    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new PrivateChannel('my-channel.'.$this->doctor_id);
        // return ['my-channel'];
    }

    public function broadcastAs()
    {
        return 'my-channel';
    }

}
