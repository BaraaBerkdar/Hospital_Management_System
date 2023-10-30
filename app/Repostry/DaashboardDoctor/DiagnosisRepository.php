<?php

namespace App\Repostry\DaashboardDoctor;
use App\Interfaces\DaashboardDoctor\DiagnosisRepositoryIntrface;
use App\Models\Diagnostic;
use App\Models\Single_invoice;
use App\Models\Ray;
use App\Models\Laboratorie;

use DB;
class DiagnosisRepository implements DiagnosisRepositoryIntrface
{

    public function store($request){
        try {
            DB::beginTransaction();
        $request->request->add(['date'=>date('Y-m-d')]);
       $dag= Diagnostic::create($request->all());
        $invoice=Single_invoice::find($request->invoice_id);
        $invoice->update(['invoice_status'=>3]);
        DB::commit();
        return redirect()->back()->with(['add'=>""]);

        }catch(\Exception $ex){
            DB::roleback();
            return redirect()->back()->withErrors(['error'=>""]);

        }
    }

    public function show($id){
        
    $patient_records=Diagnostic::where('patient_id',$id)->get();
    $patient_rays=Ray::where('patient_id',$id)->get();
   $patient_Laboratories=Laboratorie::where('patient_id',$id)->get();
    return view('Dashboard.doctordashbord.invoices.patient_details',compact('patient_records','patient_rays','patient_Laboratories')); 

    }


    public function addReview($request){
    
        try {
            DB::beginTransaction();
        $request->request->add(['date'=>date('Y-m-d')]);
       $dag= Diagnostic::create($request->all());
        $invoice=Single_invoice::find($request->invoice_id);
        $invoice->update(['invoice_status'=>2]);
        DB::commit();
        return redirect()->back()->with(['add'=>""]);

        }catch(\Exception $ex){
            DB::rollback();
            return $ex;
            return redirect()->back()->withErrors(['error'=>$ex]);

        }


    }


}