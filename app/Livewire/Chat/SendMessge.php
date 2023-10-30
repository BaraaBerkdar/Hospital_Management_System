<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use Auth;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Messages;
use App\Models\Consrvation;
use Livewire\Attributes\On; 
use App\Events\MessageSend;
 
class SendMessge extends Component
{   public $selected_conversation;
    public $body;
    public $createdMessage;
    public $receviverUser;
    public $sender;
    #[On('load_conversationDoctor')] 
    public function load_conversationDoctor(Consrvation $conversation, Doctor $receiver){
       
        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
    }

    #[On('load_conversationPatient')] 
    public function load_conversationPatient(Consrvation $conversation, Patient $receiver){
       
      
        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
    }

    public function sendMessage(){
        
        $this->createdMessage =Messages::create([
            'consrvation_id'=>$this->selected_conversation->id,
            "sender_email"  =>Auth::user()->email,
            'receiver_email' =>$this->receviverUser->email,
            'body'           =>$this->body
        ]);

        $this->selected_conversation->last_time_message = $this->createdMessage->created_at;
        $this->dispatch('pushMessage',$this->createdMessage->id);
        // $this->dispatch('dispatchSentMassage');
        $this->body="";
        
    }
    #[On('dispatchSentMassage')] 

    public function dispatchSentMassage(){
        
        if(Auth::guard('pation')->check()){
            $this->sender=Auth::guard('pation')->user();
        }else{
            $this->sender=Auth::guard('doctor')->user();
        
        }
      
        broadcast(new MessageSend(
            $this->sender,
            $this->createdMessage,
            $this->selected_conversation,
            $this->receviverUser
        ));

    }

    public function render()
    {
        return view('livewire.chat.send-messge');
    }
}
