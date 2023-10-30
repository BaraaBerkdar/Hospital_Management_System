<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\Consrvation;
class Main extends Component
{
    public $selected_conversation;
    #[On('selectConservation')] 
    public function selectConservation(Consrvation $con){
        dd('fddd');
        $this->selected_conversation=$con;

    }
    public function render()
    {
        return view('livewire.chat.main')->extends('Dashboard.layouts.master');
    }
    
}
