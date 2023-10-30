<?php

namespace App\Http\Controllers\Dashboard_Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Single_invoice;
use App\Models\Laboratorie;
use App\Models\Ray;
use App\Models\Appointment;
use Auth;
class pationController extends Controller
{

    public function getinvoice(){
        
        $invoices=Single_invoice::where('patient_id',auth()->user()->id)->get();
        if($invoices)
        return view('Dashboard.dashboard_patient.invoices',compact('invoices'));
        else
        abort('404');
    }

    public function getlab(){
        $laboratories=Laboratorie::where('patient_id',auth()->user()->id)->get();
        if($laboratories)
        return view('Dashboard.dashboard_patient.laboratories',compact('laboratories'));
        else
        abort('404');
    }
    
    public function viewlab($id){

        $laboratories=Laboratorie::where('id',$id)->where('patient_id',auth()->user()->id)->first();
     
        if($laboratories){

            return view('Dashboard.doctordashbord.invoices.view_laboratories',compact("laboratories"));
        }

        else{
       
            return redirect()->back()->withError(['error'=>"لامكن الوصول لهذا المريض"]);

        }
    }

    public  function getray(){
        $rays=Ray::where('patient_id',auth()->user()->id)->get();
        if($rays){
    
        return view('Dashboard.dashboard_patient.rays',compact('rays'));

 
        
        }else{
            abort('404');

        }
    }

    public function viewrys($id){
        $rays=Ray::where('id',$id)->where('patient_id',auth()->user()->id)->first();
        return view('Dashboard.doctordashbord.invoices.view_rays',compact('rays'));


    }
    public function logout(Request $request){

        Auth::guard('pation')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function appointment_approved(){
        $appointments=Appointment::where('email',auth()->user()->email)->where('type','مؤكد')->get();
        return view('Dashboard.pation_appointments.index',compact('appointments'));
    }

    public function appointment(){
        $appointments=Appointment::where('email',auth()->user()->email)->where('type','غير مؤكد')->get();
        return view('Dashboard.pation_appointments.index2',compact('appointments'));


    }
    public function destroy(Request $requst){
        $app=Appointment::find($requst->id);
         $app->delete();
         return redirect()->bacK()->with(['delete'=>""]);
     }
     public function register_view(){
        return view('Dashboard.User.Auth.signup');
     }
     public function register(Request $request){
        return $request;

     }  
}   
