<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use Auth;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Messages;
use App\Models\Consrvation;
use Livewire\Attributes\On; 

class Chatbox extends Component
{
    public $receiver;
    public $selected_conversation;
    public $receviverUser;
    public $messages;
    public $auth_email;
    public $auth_id;
    public $event_name;
    public $chat_page;
    public $message_id;


    public function mount()
    {
        if (Auth::guard('pation')->check()) {
            $this->auth_email = Auth::guard('pation')->user()->email;
            $this->auth_id = Auth::guard('pation')->user()->id;
        } else {
            $this->auth_email = Auth::guard('doctor')->user()->email;
            $this->auth_id = Auth::guard('doctor')->user()->id;
        }

    }

    public function getListeners()
    {
        if (Auth::guard('pation')->check()) {
            $auth_id = Auth::guard('pation')->user()->id;
            $this->event_name = "MessageSend2";
            $this->chat_page = "chat2";

        } else {
            $auth_id = Auth::guard('doctor')->user()->id;
            $this->event_name = "MessageSend";
            $this->chat_page = "chat";
        }

        // return [
        //     "echo-private:$this->chat_page.{$auth_id},$this->event_name" => 'broadcastMassage'
        // ];
        return [
            "echo:$this->chat_page.{$auth_id},$this->event_name" => 'broadcastMassage'
        ];
    }


    public function broadcastMassage($event)
    {   dd('sds');
        $broadcastMessage = Message::find($event['message']);
        $broadcastMessage->read = 1;
        $this->pushMessage($broadcastMessage->id);
    }




    #[On('load_conversationDoctor')] 
    public function load_conversationDoctor(Consrvation $conversation, Doctor $receiver){
       
        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
        $this->messages = Messages::where('consrvation_id', $this->selected_conversation->id)->get();
        $this->readMessages();
        
    }
    #[On('load_conversationPatient')] 
    public function load_conversationPatient(Consrvation $conversation, Patient $receiver){
       
        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
        $this->messages = Messages::where('consrvation_id', $this->selected_conversation->id)->get();
        $this->readMessages();
    }

    public function readMessages(){
        foreach($this->messages as $mesage){
            $mesage->update(['read'=>1]);
        }
    }

    // #[On('pushMessage')] 

    // public function pushMessage($id){
    //    $this->message_id=$id;
    //    $this->dispatch('push');

    // }
    // #[On('push')] 

    public function render()
    {    

    //    $this->dispatch('load_conversationDoctor');
    if(!empty($this->selected_conversation)){
        
        return view('livewire.chat.chatbox',
    [
    
        "messges"=> Messages::where('consrvation_id', $this->selected_conversation->id)->get()
    ]
    );
    }        
    else{
        return view('livewire.chat.chatbox',
        [
        
            "messges"=>$this->messages
        ]
        );
    }

    }
}
