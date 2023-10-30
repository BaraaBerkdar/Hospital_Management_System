<?php

namespace App\Repostry\DaashboardDoctor;
use  App\Interfaces\DaashboardDoctor;
use App\Models\Single_invoice;
use App\Models\Notifacation;
use App\Interfaces\DaashboardDoctor\InvoicesRepositoryInterface;

class InvoicesRepository implements InvoicesRepositoryInterface{
 // Get Invoices Doctor
 public function index(){
    $id=auth()->user()->id;
    $invoices=Single_invoice::where('doctor_id',$id)->where('invoice_status',1)->where('invoice_date',date('Y-m-d'))->get();
    return view('Dashboard.doctordashbord.invoices.index',compact('invoices'));
    
 }

 // Get reviewInvoices Doctor
 public function reviewInvoices(){

   $id=auth()->user()->id;
   $invoices=Single_invoice::where('doctor_id',$id)->where('invoice_status',2)->where('invoice_date',date('Y-m-d'))->get();
   return view('Dashboard.doctordashbord.invoices.review_invoices',compact('invoices'));


 }

 // Get completedInvoices Doctor
 public function completedInvoices(){
   $id=auth()->user()->id;
   $invoices=Single_invoice::where('doctor_id',$id)->where('invoice_status',3)->get();
   return view('Dashboard.doctordashbord.invoices.completed_invoices',compact('invoices'));



 }

    public function read_notifacation($id)
        {
           $notf=Notifacation::find($id);
          $notf->update(['reader_status'=>1]);
          return redirect()->route('doctor.invoice');
        }
        public function view_all_notfi(){
       
          $notfs=Notifacation::where('user_id',auth()->user()->id)->get();
          
          foreach($notfs as $notf){
              $notf->update(['reader_status'=>1]);
            }
            return redirect()->back();
        }


 // View rays
 public function show($id){}

 // View Laboratories
 public function showLaboratorie($id){}
}