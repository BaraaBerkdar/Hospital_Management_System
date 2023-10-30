<?php

namespace App\Livewire;

use Livewire\Component;

class GroupsService extends Component
{

    public $count = 2;
 
    public function increment()
    {
        $this->count++;
    }

    public function render()
    {
        return view('livewire.GroupService.groups-service')->layout('livewire.GroupService.empty');
    }
}
