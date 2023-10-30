<?php
namespace  App\Repostry\Finance;
use  App\Interfaces\Finance\PymentRepostryIntrface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\PaymentAccount;
use App\Models\Patient;
use App\Models\FundAcount;
use App\Models\PatientAccount;
class PymentRepostry implements PymentRepostryIntrface{

// get All Receipt
public function index(){
   $payments=PaymentAccount::all();
    return view('Dashboard.Payment.index',compact('payments'));

}

// show form add
public function create(){
    $Patients=Patient::all();

    return view('Dashboard.Payment.add',compact('Patients'));
}

// store Receipt
public function store($request){

       
    try{
        DB::beginTransaction();
        $request->request->add(['date'=>date('Y-m-d')]);

       $receipt= PaymentAccount::create($request->all());
        FundAcount::create([
         'Payment_id'    =>$receipt->id,
         'date'          =>date('Y-m-d'),
         'Debit'         =>0.0,
         'credit'        =>$receipt->amount
        ]);

        PatientAccount::create([
         'Payment_id'    =>$receipt->id,
         'date'          =>date('Y-m-d'),
         'Debit'         =>$receipt->amount,
         'credit'        =>0.0,
         'patient_id'   =>$request->patient_id,

        ]);

        DB::commit();
        return redirect()->route('pyments')->with(['add'=>""]);
     }catch(\Exception $ex){
    DB::rollback();
   return redirect()->back()->withErrors(['error' => $ex->getMessage()]);


     }


}

// edit Receipt
public function edit($id){
    $payment_accounts=PaymentAccount::find($id);
    $Patients=Patient::all();

    return view('Dashboard.Payment.edit',compact('payment_accounts','Patients'));

}

// show Receipt
public function show($id){
    $payment_account=PaymentAccount::find($id);

    return view('Dashboard.Payment.print',compact('payment_account'));


}

// Update Receipt
public function update($request){

    try{
                   DB::beginTransaction();
                   $request->request->add(['date'=>date('Y-m-d')]);

                  $pyment= PaymentAccount::find($request->id);
                  $pyment->update($request->all());

                  $fundaccount=FundAcount::where('Payment_id',$request->id)->first();
                  $fundaccount->update([
                      'Payment_id'    =>$pyment->id,
                      'date'          =>date('Y-m-d'),
                      'Debit'         =>0.0,
                      'credit'        =>$pyment->amount
                    
                  ]);
                  $patentisAcoount=PatientAccount::where('Payment_id',$request->id)->first();
                  $patentisAcoount->update([
                      'Payment_id'    =>$pyment->id,
                      'date'          =>date('Y-m-d'),
                      'Debit'         =>$request->amount,
                      'credit'        =>0.0,
                      'patient_id'   =>$request->patient_id,
                    
                  ]);

                
                   DB::commit();
                   return redirect()->route('pyments')->with(['edit'=>""]);
                }catch(\Exception $ex){
               DB::rollback();
              return redirect()->back()->withErrors(['error' => $ex->getMessage()]);


                }
 


}

// destroy Receipt
public function destroy($request){
        $payment=PaymentAccount::find($request->id);
        $payment->delete();
        return redirect()->route('pyments')->with(['delete'=>""]);

    

}





}
