<?php
namespace App\Repostry\Appointmetnt;
use App\Mail\Appoittment;

use App\Interfaces\Appointment\AppointmetnRepostryIntrface;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;

class AppointmetnRepostry implements AppointmetnRepostryIntrface
{

    public function index(){
     
        $appointments=Appointment::where('type','غير مؤكد')->get();  
        return view('Dashboard.appointments.index',compact('appointments'));
    }
    public function index2(){
        $appointments=Appointment::where('type','مؤكد')->get();  
        return view('Dashboard.appointments.index2',compact('appointments'));
    }

    public function aprove($requst,$id){
        $app=Appointment::find($requst->id);
        $app->update([
            'appointment'=>$requst->appointment,
            'type'       =>"مؤكد"
        ]);
        // Mail::to($app->email)->send(new Appoittment($app->name,$app->appointment,$app->Doctor->name));

      return redirect()->back()->with(['edit'=>""]);
    }
    public function destroy($requst){
       $app=Appointment::find($requst->id);
        $app->delete();
        return redirect()->bacK()->with(['delete'=>""]);
    }

}