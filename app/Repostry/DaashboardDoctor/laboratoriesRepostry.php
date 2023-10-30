<?php

namespace App\Repostry\DaashboardDoctor;
use App\Interfaces\DaashboardDoctor\laboratoriesRepostryIntrface;
use App\Models\Diagnostic;
use App\Models\Single_invoice;
use App\Models\Ray;
use App\Models\Laboratorie;
use DB;
use Auth;
class laboratoriesRepostry implements laboratoriesRepostryIntrface
{


    
    public function store($request){
        Laboratorie::create($request->all());
        return redirect()->back()->with(['add'=>""]);

    }

    public function update($request,$id){

        $lab=Laboratorie::find($id);
        $lab->update(['description'=>$request->description]);
        return redirect()->back()->with(['edit'=>""]);

    }

    public function destroy($id){
        $lab=Laboratorie::find($id);
        $lab->delete();
        return redirect()->back()->with(['delete'=>""]);


    }
    public function show1($id){
        $laboratories=Laboratorie::where('id',$id)->where('doctor_id',Auth::user()->id)->first();
        if($laboratories){

            return view('Dashboard.doctordashbord.invoices.view_laboratories',compact("laboratories"));
        }

        else{
       
            return redirect()->back()->withError(['error'=>"لامكن الوصول لهذا المريض"]);

        }
    }
}