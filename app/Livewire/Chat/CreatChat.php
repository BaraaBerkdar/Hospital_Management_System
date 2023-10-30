<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Consrvation;
use App\Models\Messages;
use DB;
use Auth;
class CreatChat extends Component
{

    public $users;
    public $email;
    public $conservation;
    public function mount()
    {
       
    }


    public function render()
    {
        if(Auth::guard('pation')->check()){
            $this->users=Doctor::all();
        }else{
            $this->users=Patient::all();
        }
    

        return view('livewire.chat.creat-chat')->extends('Dashboard.layouts.master');
    }

    public function createConversation($receiver_email){
        try{

       
         $check=Consrvation::chekConversation(Auth::user()->email,$receiver_email)->get();  
        //  dd($check);
         if($check->count()==0){
            
         DB::beginTransaction();

       $this->conservation= Consrvation::create([
            "sender_email"     => Auth::user()->email,
            "receiver_email"   =>$receiver_email
        ]);
        // Messages::create([
        //     'consrvation_id' => $con->id,
        //     'sender_email' => Auth::user()->email,
        //     'receiver_email' => $receiver_email,
        //     'body' => 'السلام عليكم',
        // ]);

        DB::commit();
       
    $this->dispatch('selectConservation',$this->conservation);

            // $this->redirect('chat',compact('con'));
       
    }else{
        // $this->redirect('chat');
      

    $this->dispatch('selectConservation',$this->conservation);
    }
    }catch(\Exception $e){
            DB::rollBack();
            
        }
    }

}
