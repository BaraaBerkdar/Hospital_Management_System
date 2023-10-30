<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Consrvation;
use Auth;
use App\Models\Doctor;
use App\Models\Patient;
use Livewire\Attributes\On; 

class Chatlist extends Component
{

    public $conversations;
    public $receveUser;
    public $selected_consrvation;
    #[On('pushMessage')] 

    public function render()
    {
        $this->conversations=Consrvation::where('sender_email',Auth::user()->email)->orwhere('receiver_email',Auth::user()->email)->orderBy('created_at','DESC')->get();


        return view('livewire.chat.chatlist');
    }


    public function getUsers(Consrvation $conversation,$request){

        if($conversation->sender_email == Auth::user()->email){
            $this->receveUser=Doctor::where('email',$conversation->receiver_email)->first();
        }else{
            $this->receveUser=Patient::where('email',$conversation->sender_email)->first();

        }
        if(isset($this->receveUser)){
            return $this->receveUser->$request;
        }


        
    }
    public  function chatUserSelected(Consrvation $conversation ,$id){
      
        $this->selected_consrvation =$conversation;
        if(Auth::guard('pation')->check()){
           
            $this->receveUser=Doctor::find($id);
            $this->dispatch('load_conversationDoctor',$this->selected_consrvation,$this->receveUser);
      
        }else{
            $this->receveUser=Patient::find($id);
       
            $this->dispatch('load_conversationPatient',$this->selected_consrvation,$this->receveUser);

        }
    


        // $this->emit('chat.chatbox','load_conversationDoctor', $this->selected_consrvation, $this->receveUser);
        
        

    }
}
