<?php

namespace App\Repostry\Patient;
use  App\Interfaces\Patient\PatientRepostryIntrface;
use App\Models\Patient;
use App\Models\Single_invoice;
use App\Models\group_invoice;
use App\Models\ReceiptAccount;

use App\Models\PatientAccount;

class PatientRepostry implements PatientRepostryIntrface
{

    public function index(){

        $Patients=Patient::all();
        return view('Dashboard.Patients.index',compact('Patients'));

    }

    public function store($req){
     
            try{
                $req->request->add(['password'=>bcrypt($req->Phone)]);
                Patient::create($req->all());
      return redirect()->route('patients')->with(["add"=>"ff"]);


            }catch(\Exception $ex){
                return $ex;
                return redirect ()->back()->withErrors(['name'=>"error"]);

                  
            }


    }
    
    public function edit($id){

        $Patient=Patient::find($id);
        return view('Dashboard.Patients.edit',compact('Patient'));

    }



    public function update($req){
        
        try{

        $Patient=Patient::find($req->id);
            if($Patient){
                $Patient->update($req->all());
                return redirect()->route('patients')->with(["edit"=>"ff"]);

            }else{
                return redirect ()->route('patients')->withErrors(['name'=>"error"]);

            }
        }catch(\Exception $ex){


        }

        



    }
    public function destroy($req){

        $Patient=Patient::find($req->id);
        if($Patient){
            $Patient->delete();
            return redirect()->route('patients')->with(['delete'=>""]);

        }else{
            return redirect ()->route('patients')->withErrors(['name'=>"error"]);

        }
    }

    public function show($id){
        
        $Patient = patient::findorfail($id);
        // $group_invoices=group_invoice::where('patient_id', $id)->get();
        $invoices = Single_invoice::where('patient_id', $id)->get();

        $receipt_accounts = ReceiptAccount::where('patient_id', $id)->get();
        $Patient_accounts = PatientAccount::where('patient_id', $id)->get();
        return view('Dashboard.Patients.show', compact('Patient', 'invoices', 'receipt_accounts', 'Patient_accounts'));

     
    }

 
 

}