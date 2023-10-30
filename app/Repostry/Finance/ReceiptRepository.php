<?php
namespace App\Repostry\Finance;

use App\Interfaces\Finance\ReceiptRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\ReceiptAccount;
use App\Models\Patient;
use App\Models\FundAcount;
use App\Models\PatientAccount;


class ReceiptRepository implements ReceiptRepositoryInterface{

            public function index(){

                $receipts=ReceiptAccount::all();
                    return view('Dashboard.Receipt.index',compact('receipts'));
            
            }



            public function create(){
                $Patients=Patient::all();
                return view('Dashboard.Receipt.add',compact('Patients'));

            }

            // store Receipt
            public function store($request){
                
                try{
                   DB::beginTransaction();
                   $request->request->add(['date'=>date('Y-m-d')]);

                  $receipt= ReceiptAccount::create($request->all());
                   FundAcount::create([
                    'receipt_id'    =>$receipt->id,
                    'date'          =>date('Y-m-d'),
                    'Debit'         =>$receipt->amount,
                    'credit'        =>0.0
                   ]);

                   PatientAccount::create([
                    'receipt_id'    =>$receipt->id,
                    'date'          =>date('Y-m-d'),
                    'Debit'         =>0.0,
                    'credit'        =>$receipt->amount,
                    'patient_id'   =>$request->patient_id,

                   ]);

                   DB::commit();
                   return redirect()->back()->with(['add'=>""]);
                }catch(\Exception $ex){
               DB::rollback();
              return redirect()->back()->withErrors(['error' => $ex->getMessage()]);


                }
                



            }
        
            // edit Receipt
            public function edit($id){
                $Patients=Patient::all();
                $receipt_accounts = ReceiptAccount::find($id);

                return view('Dashboard.Receipt.edit',compact('Patients','receipt_accounts'));

            }
        
            // show Receipt
            public function show($id){

            }
        
            // Update Receipt
            public function update($request){


 try{
                   DB::beginTransaction();
                   $request->request->add(['date'=>date('Y-m-d')]);

                  $receipt= ReceiptAccount::find($request->id);
                  $receipt->update($request->all());

                  $fundaccount=FundAcount::where('receipt_id',$request->id)->first();
                  $fundaccount->update([
                      'receipt_id'    =>$receipt->id,
                      'date'          =>date('Y-m-d'),
                      'Debit'         =>$receipt->amount,
                      'credit'        =>0.0
                    
                  ]);
                  $patentisAcoount=PatientAccount::where('receipt_id',$request->id)->first();
                  $patentisAcoount->update([
                      'receipt_id'    =>$receipt->id,
                      'date'          =>date('Y-m-d'),
                      'Debit'         =>0.0,
                      'credit'        =>$request->amount,
                      'patient_id'   =>$request->patient_id,
                    
                  ]);

                
                   DB::commit();
                   return redirect()->route('receipt')->with(['edit'=>""]);
                }catch(\Exception $ex){
               DB::rollback();
              return redirect()->back()->withErrors(['error' => $ex->getMessage()]);


                }
                
                
            }
        
            // destroy Receipt
            public function destroy($request){

                $receipt_accounts = ReceiptAccount::find($request->id);
                if($receipt_accounts){
                    $receipt_accounts->delete();
                   return redirect()->route('receipt')->with(['delete'=>""]);

                }else{
               return redirect()->back()->withErrors(['error' => $ex->getMessage()]);

                }

            }

}