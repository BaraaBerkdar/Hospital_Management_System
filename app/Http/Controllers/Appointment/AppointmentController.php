<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Appointment\AppointmetnRepostryIntrface;

class AppointmentController extends Controller
{ private $Appointment;

    public function __construct(AppointmetnRepostryIntrface $Appointment)
    {
        $this->Appointment = $Appointment;
    }
 
    
    public function index(){

        return $this->Appointment->index();
    }
    public function index2(){
        return $this->Appointment->index2();

    }

    public function aprove(Request $request ,$id){
        return $this->Appointment->aprove($request,$id);
        
    }
    public function destroy(Request $request){
        return $this->Appointment->destroy($request);

    }
}
