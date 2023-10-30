<?php

namespace App\Repostry\DaashboardDoctor;
use App\Interfaces\DaashboardDoctor\RayReposrtyIntrface;
use App\Models\Diagnostic;
use App\Models\Single_invoice;
use App\Models\Ray;
use Auth;
use DB;
class RayRepostry implements RayReposrtyIntrface
{
    public function store($request){
        Ray::create($request->all());
        return redirect()->back()->with(['add'=>""]);    
    }

    public function update($request,$id){
        $ray=Ray::find($id);
        $ray->update(['diagnosis'=>$request->diagnosis]);
        return redirect()->back()->with(['edit'=>""]);    


    }

    public function destroy($id){
        $ray=Ray::find($id);
        $ray->delete();
        return redirect()->back()->with(['delete'=>""]);    

    }
    public function show($id){
        
        
        $rays=Ray::where('id',$id)->where('doctor_id',Auth::user()->id)->first();
     
        if($rays){

            return view('Dashboard.dashboard_RayEmployee.invoices.patient_details',compact("rays"));
        }

        else{
       
            return redirect()->back()->withError(['error'=>"لامكن الوصول لهذا المريض"]);

        }
       
    }
}