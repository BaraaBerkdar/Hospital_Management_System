<?php

namespace App\Livewire;
use App\Models\Patient;
use App\Models\Doctor;
use Livewire\Component;
use App\Models\group_invoice;
use App\Models\Groups;
use App\Models\Single_invoice;

use App\Models\Services;
use App\Models\SectionTranslation;
use App\Models\FundAcount;
use App\Models\PatientAccount;
use Illuminate\Support\Facades\Redirect;
use DB;

class GroupInvoices extends Component
{
    public   $catchError ,$InvoiceSaved ,$InvoiceUpdated;
    public $show_table=true;
    public $updateMode=false;
    public $tax_rate=0 ;
    public $doctor_id;
    public $section_id;
    public $Service_id;
    public $Group_id;
    public $total;
  public $type;
      public $price,$discount_value = 0,$patient_id;
      public $single_invoice_id;




    public function render()
    {
        return view('livewire.group_invoices.group-invoices',
        [
            "group_invoices" =>Single_invoice::where('invoice_type',1)->get(),
            'Patients'        =>Patient::all(),
            'Doctors'         =>Doctor::all(),
            'Groups'   =>Groups::all(),
            'subtotal' => $Total_after_discount = ((is_numeric($this->price) ? $this->price : 0)) - ((is_numeric($this->discount_value) ? $this->discount_value : 0)),
            'tax_value'=> $Total_after_discount * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100)
        ]
    
    
    );
    }
    public function show_form_add(){
        $this->show_table = false;
    }

    public function get_section(){
        $doctor=Doctor::find($this->doctor_id);
        $this->section_id=$doctor->section->name;
    }

    public function get_price(){
        $this->price= Groups::where('id',$this->Group_id)->first()->Total_before_discount;
        $this->discount_value= Groups::where('id',$this->Group_id)->first()->discount_value;
        $this->tax_rate= Groups::where('id',$this->Group_id)->first()->tax_rate;

        
    
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
                                        "Group_id"         =>$this->Group_id,
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

                                    return redirect()->to('/group-invoices');

                         }

            else{
                                // save in invoices table
                        DB::beginTransaction();
                            $invoice=Single_invoice::create([


                                    "invoice_date"           => date('Y-m-d'),
                                    "patient_id"             =>$this->patient_id,
                                    "doctor_id"               =>$this->doctor_id,
                                    "section_id"             =>SectionTranslation::where('name',$this->section_id)->first()->section_id,
                                    "Group_id"               =>$this->Group_id,
                                    "price"                  =>$this->price,
                                    "discount_value"         =>$this->discount_value,
                                    "tax_rate"               =>$this->tax_rate,
                                    "tax_value"              =>($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100),
                                    "total_with_tax"         =>$this->price -  $this->discount_value +($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100),
                                    "type"                   =>$this->type,
                                    "invoice_type"           =>1
                                ]);
             
                     
                          
                                // save in FundAcount  table

                                FundAcount::create([
                                    "date" =>date('Y-m-d'),
                                    "invoice_id" =>$invoice->id,
                                    "Debit"       =>$invoice->total_with_tax,
                                    "credit"    =>0.0

                                ]);
                    //   dd('d');
                              
                                $this->show_table =true;
                                DB::commit();

                                $this->InvoiceSaved =true;
                                return redirect()->to('/group-invoices');

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
          
                // dd('after');
                
                $invoice->update([
                    "invoice_date"      =>date('Y-m-d'),
                    "patient_id"     =>$this->patient_id,
                    "doctor_id"      =>$this->doctor_id,
                    "section_id"      =>SectionTranslation::where('name',$this->section_id)->first()->section_id,
                    "Group_id"         =>$this->Group_id,
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
            //    dd('after banck');
               $this->InvoiceUpdated=true;
               DB::commit();

               return redirect()->to('/group-invoices');
        
            }







                       else{
                            // save in invoices table
                   
                    DB::beginTransaction();

                        $invoice=Single_invoice::create([
                        "invoice_date"      =>date('Y-m-d'),
                        "patient_id"     =>$this->patient_id,
                        "doctor_id"      =>$this->doctor_id,
                        "section_id"      =>SectionTranslation::where('name',$this->section_id)->first()->section_id,
                        "Group_id"               =>$this->Group_id,
                        "price"               =>$this->price,
                        "discount_value"     =>$this->discount_value,
                        "tax_rate"          =>$this->tax_rate,
                        "tax_value"              =>($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100),
                        "total_with_tax"         =>$this->price -  $this->discount_value +($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100),
                        "type"                   =>$this->type,
                        "invoice_type"           =>1

                 ]);

                            // save in PatientAccount  table
               
                            PatientAccount::create([
                                "date" =>date('Y-m-d'),
                                "invoice_id" =>$invoice->id,
                                "credit"       =>0.0,
                                "patient_id"  =>$invoice->patient_id,
                                "Debit"    =>$invoice->total_with_tax


                            ]);
                            $this->InvoiceSaved =true;
                         DB::commit();

                            return redirect()->to('/group-invoices');

                        }
                 }  
                 catch(\Exception $ex){
                    DB::rollback();
                    $this->catchError = $ex->getMessage();
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
        $this->Group_id = $single_invoice->Group_id;
        $this->price = $single_invoice->price;
        $this->discount_value = $single_invoice->discount_value;
        $this->type = $single_invoice->type;
        $this->tax_rate = $single_invoice->tax_rate;

    }


    public function delete($id){
      
        $this->single_invoice_id=$id;
        // $this->destroy();
        }
    
    
        public function destroy(){
            try{
                $group_invoice=Single_invoice::find($this->single_invoice_id);
    
            $group_invoice->delete();
            return redirect()->to('/group-invoices');
            }catch (\Exception $ez){
                dd($ez);
            }
        }

        public function print($id)
        {
            $single_invoice = Single_invoice::findorfail($id);
            return Redirect::route('group_Print_single_invoices',[
                'invoice_date' => $single_invoice->invoice_date,
                'doctor_id' => $single_invoice->Doctor->name,
                'section_id' => $single_invoice->Section->name,
                'Group_id' => $single_invoice->Group->name,
                'type' => $single_invoice->type,
                'price' => $single_invoice->price,
                'discount_value' => $single_invoice->discount_value,
                'tax_rate' => $single_invoice->tax_rate,
                'total_with_tax' => $single_invoice->total_with_tax,
                "patient_id"    =>$single_invoice->Patient->name
            ]);
        }
}

