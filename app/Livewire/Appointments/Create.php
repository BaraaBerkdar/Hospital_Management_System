<?php

namespace App\Livewire\Appointments;

use Livewire\Component;
use App\Models\Section;
use App\Models\Doctor;
use App\Models\Appointment;
class Create extends Component
{

    public $message= "false";

    public $doctors=[];
    public $section;
    public $phone;
    public $notes;
    public $email;
    public $name;
    public $doctor;
    public function render()
    {   
        return view('livewire.appointments.create',[
            "sections" =>Section::all(),

        ]);
    }

    public function getdoctor(){
        $this->doctors=Doctor::where('section_id',$this->section)->get();
        // dd($this->doctors);
    }

    public function store(){
        try{
        Appointment::create([
            "name"           =>$this->name,
            "email"          =>$this->email,
            'phone'          =>$this->phone,
            "doctor_id"      =>$this->doctor,
            "section_id"     =>$this->section,
            'notes'          =>$this->notes,
        ]);
        $this->message ="true";
    }catch(\Exception $ex){
        dd($ex);
    }
    }

}
