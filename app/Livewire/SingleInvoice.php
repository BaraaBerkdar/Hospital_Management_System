<?php

namespace App\Livewire;
use App\Events\MyEvent;

use Livewire\Component;
use App\Models\Single_invoice;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Services;
use App\Models\SectionTranslation;
use App\Models\FundAcount;
use App\Models\PatientAccount;
use App\Models\Appointment;
use App\Models\Notifacation;
use Illuminate\Support\Facades\Redirect;
use DB;
class SingleInvoice extends Component
{

  public   $catchError ,$InvoiceSaved ,$InvoiceUpdated;
  public $show_table=true;
  public $updateMode=false;
  public $tax_rate = 17;
  public $doctor_id;
  public $section_id;
  public $username;
  public $Service_id;
  public $total;
public $type;
    public $price,$discount_value = 0,$patient_id;
    public $single_invoice_id;

    public function mount(){

        $this->username = auth()->user()->id;
     }



    public function render()
    {
        return view('livewire.single_invoices.single-invoices',
        [
            'single_invoices' =>Single_invoice::where('invoice_type',0)->get(),
            'Patients'        =>Patient::all(),
            'Doctors'         =>Doctor::all(),
            'Services'        =>Services::all(),
             'subtotal' => $Total_after_discount = ((is_numeric($this->price) ? $this->price : 0)) - ((is_numeric($this->discount_value) ? $this->discount_value : 0)),
            'tax_value'=> $Total_after_discount * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100)
        ]
        
        );
        
        
    }

    function calclutersubtotal(){
        $med=$this->price - $this->discount_value;
        $this->total=($med*$this->tax_rate)/100;
    }


//    
// 
// 
// 

    public function show_form_add(){
        $this->show_table = false;
    }

    public function get_section(){
        $doctor=Doctor::find($this->doctor_id);
        $this->section_id=$doctor->section->name;
    }

    public function get_price(){
       $service= Services::find($this->Service_id);
       $this->price=$service->price;
    }

    										
    public function store(){

        if($this->type==1){
        try{
    //  cach 

    // edit 
            if($this->updateMode){
                                    //    return redirect()->to('/single_invoices');
                                    DB::beginTransaction();

                                        // updaate invoices table 
                                    $invoice=Single_invoice::find($this->single_invoice_id);
                                    $invoice->update([
                                        "invoice_date"      =>date('Y-m-d'),
                                        "patient_id"     =>$this->patient_id,
                                        "doctor_id"      =>$this->doctor_id,
                                        "section_id"      =>SectionTranslation::where('name',$this->section_id)->first()->section_id,
                                        "Service_id"         =>$this->Service_id,
                                        "price"               =>$this->price,
                                        "discount_value"     =>$this->discount_value,
                                        "tax_rate"          =>$this->tax_rate,
                                        "tax_value"              =>($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100),
                                        "total_with_tax"         =>$this->price -  $this->discount_value +($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100),
                                        "type"                   =>$this->type
                                    ]);
                                    
                                    $account= FundAcount::where('invoice_id',$this->single_invoice_id)->first();
                                    $account->update([
                                        "date" =>date('Y-m-d'),
                                        "invoice_id" =>$invoice->id,
                                        "Debit"       =>$invoice->total_with_tax,
                                        "credit"    =>0.0
                                    ]);
                                    $this->InvoiceUpdated=true;
                                    DB::commit();

                                    return redirect()->to('/single_invoices');

                         }

            else{
                                // save in invoices table
                        DB::beginTransaction();

                            $invoice=Single_invoice::create([
                                    "invoice_date"      =>date('Y-m-d'),
                                    "patient_id"     =>$this->patient_id,
                                    "doctor_id"      =>$this->doctor_id,
                                    "section_id"      =>SectionTranslation::where('name',$this->section_id)->first()->section_id,
                                    "Service_id"         =>$this->Service_id,
                                    "price"               =>$this->price,
                                    "discount_value"     =>$this->discount_value,
                                    "tax_rate"          =>$this->tax_rate,
                                    "tax_value"              =>($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100),
                                    "total_with_tax"         =>$this->price -  $this->discount_value +($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100),
                                    "type"                   =>$this->type,
                                    "invoice_type"           =>0

                                ]);
                                // save in FundAcount  table

                                FundAcount::create([
                                    "date" =>date('Y-m-d'),
                                    "invoice_id" =>$invoice->id,
                                    "Debit"       =>$invoice->total_with_tax,
                                    "credit"    =>0.0

                                ]);
                                // $this->show_table =true;
                                
                                $pation=Patient::find($this->patient_id);
                               $notfication= Notifacation::create([
           
                                    "user_id" =>$this->doctor_id ,
                                    "message" => " كشف جديد باسم " .$pation->name,
                                ]);
                                $data=[
                                    'message'=>$notfication->message,
                                    'pation_id'=>$this->patient_id,
                                    'created_at' =>$notfication->created_at,
                                    'doctor_id'  =>$this->doctor_id
                                ];
                        //  event(new MyEvent($data));
                                    $app=Appointment::where('doctor_id',$this->doctor_id)->where('email',$pation->email)->first();
                                    
                                    if($app){
                                    $app->update(['type'=>"منتهي "]);
                                    }
                                DB::commit();

                                $this->InvoiceSaved =true;
                                // return redirect()->to('/single_invoices');

                 }
        
            }catch(\Exception $ex){
                DB::rollback();

                return $ex;
            }
        }

        // type not 1 
        else{


            // fututre
        try{
            if($this->updateMode){
                DB::beginTransaction();

                $invoice=Single_invoice::find($this->single_invoice_id);
                $invoice->update([
                 "invoice_date"      =>date('Y-m-d'),
                 "patient_id"     =>$this->patient_id,
                 "doctor_id"      =>$this->doctor_id,
                 "section_id"      =>SectionTranslation::where('name',$this->section_id)->first()->section_id,
                 "Service_id"         =>$this->Service_id,
                 "price"               =>$this->price,
                 "discount_value"     =>$this->discount_value,
                 "tax_rate"          =>$this->tax_rate,
                 "tax_value"              =>($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100),
                 "total_with_tax"         =>$this->price -  $this->discount_value +($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100),
                 "type"                   =>$this->type
                ]);
               $bank=PatientAccount::where('invoice_id',$this->single_invoice_id)->first();
               $bank->update([
                "date" =>date('Y-m-d'),
                "invoice_id" =>$invoice->id,
                "credit"       =>0.0,
                "patient_id"  =>$invoice->patient_id,
                "Debit"    =>$invoice->total_with_tax


               ]);
               $this->InvoiceUpdated=true;
               DB::commit();

               return redirect()->to('/single_invoices');
        
            }







                       else{
                            // save in invoices table
                    DB::beginTransaction();

                        $invoice=Single_invoice::create([
                        "invoice_date"      =>date('Y-m-d'),
                        "patient_id"     =>$this->patient_id,
                        "doctor_id"      =>$this->doctor_id,
                        "section_id"      =>SectionTranslation::where('name',$this->section_id)->first()->section_id,
                        "Service_id"         =>$this->Service_id,
                        "price"               =>$this->price,
                        "discount_value"     =>$this->discount_value,
                        "tax_rate"          =>$this->tax_rate,
                        "tax_value"              =>($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100),
                        "total_with_tax"         =>$this->price -  $this->discount_value +($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100),
                        "type"                   =>$this->type,
                        "invoice_type"           =>0

                 ]);

                            // save in PatientAccount  table

                            PatientAccount::create([
                                "date" =>date('Y-m-d'),
                                "invoice_id" =>$invoice->id,
                                "credit"       =>0.0,
                                "patient_id"  =>$invoice->patient_id,
                                "Debit"    =>$invoice->total_with_tax


                            ]);
                            $pation=Patient::find($this->patient_id);
                            $notfication= Notifacation::create([
        
                                 "user_id" =>$this->doctor_id ,
                                 "message" => " كشف جديد باسم " .$pation->name,
                             ]);
                             $data=[
                                 'message'=>$notfication->message,
                                 'pation_id'=>$this->patient_id,
                                 'created_at' =>$notfication->created_at,
                                 'doctor_id'  =>$this->doctor_id

                             ];
                    //   event(new MyEvent($data));
                                 $app=Appointment::where('doctor_id',$this->doctor_id)->where('email',$pation->email)->first();
                                 
                                 if($app){
                                 $app->update(['type'=>"منتهي "]);
                                 }


                                 $this->InvoiceSaved =true;

                         DB::commit();

                            return redirect()->to('/single_invoices');

                        }
                 }  
                 catch(\Exception $e){
                    DB::rollback();
                    $this->catchError = $e->getMessage();
                }

                    }

                    

                        
    }




    public function edit($id){
       

        $this->show_table = false;
        $this->updateMode = true;
        $single_invoice = Single_invoice::findorfail($id);
        $this->single_invoice_id = $single_invoice->id;
        $this->patient_id = $single_invoice->patient_id;
        $this->doctor_id = $single_invoice->doctor_id;
        $this->section_id = SectionTranslation::where('section_id', $single_invoice->section_id)->first()->name;
        $this->Service_id = $single_invoice->Service_id;
        $this->price = $single_invoice->price;
        $this->discount_value = $single_invoice->discount_value;
        $this->type = $single_invoice->type;


    }

    public function delete($id){
      
    $this->single_invoice_id=$id;
    $this->destroy();
    }


    public function destroy(){
        try{
            $single_invoice=Single_invoice::find($this->single_invoice_id);

        $single_invoice->delete();
        return redirect()->to('/single_invoices');
        }catch (\Exception $ez){
            dd($ez);
        }
    }


    public function print($id)
    {
        $single_invoice = Single_invoice::findorfail($id);
        return Redirect::route('Print_single_invoices',[
            'invoice_date' => $single_invoice->invoice_date,
            'doctor_id' => $single_invoice->Doctor->name,
            'section_id' => $single_invoice->Section->name,
            'Service_id' => $single_invoice->Service->name,
            'type' => $single_invoice->type,
            'price' => $single_invoice->price,
            'discount_value' => $single_invoice->discount_value,
            'tax_rate' => $single_invoice->tax_rate,
            'total_with_tax' => $single_invoice->total_with_tax,
            "patient_id"    =>$single_invoice->Patient->name
        ]);

    }



}   


