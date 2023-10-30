<?php 
namespace App\Repostry\Dashboard_Laboratorie_Employee;
use App\Models\Image;
use App\Trait\UplodeImages;
use  App\Interfaces\Dashboard_Laboratorie_Employee\InvoicesRepositoryInterfaceLab;

use App\Models\Laboratorie;
use Illuminate\Support\Facades\DB;

use Auth;

class InvoicesRepositoryLab implements InvoicesRepositoryInterfaceLab
{
    use UplodeImages;
    public function index(){
        $invoices=Laboratorie::where('case',0)->get();
        return view('Dashboard.dashboard_LaboratorieEmployee.invoices.index',compact('invoices'));


    }


    public function completed_invoices(){
        $invoices=Laboratorie::where('case',1)->get();
        return view('Dashboard.dashboard_LaboratorieEmployee.invoices.completed_invoices',compact('invoices'));



    }
    public function edit($id){
       $invoice= Laboratorie::find($id);
        return view('Dashboard.dashboard_LaboratorieEmployee.invoices.add_diagnosis',compact('invoice'));


    }
    public function update($request,$id){
        try{
            DB::beginTransaction();
            $invoice=Laboratorie::find($id);
            $invoice->update([
                'description_employee'         =>$request->description_employee,
                "employee_id"                  =>Auth::user()->id,
                'case'                           =>1
            ]);
        if($request->has('photos')){
            // move images
            $name=$invoice->Patient->name;
      
            foreach($request->photos as $photo){
                
        $this->uplodeImages($photo,public_path('Dashboard\img\laboratories'),$name,'App\Models\Laboratorie',$id);
            }
        }
        DB::commit();
        return redirect()->route('lab.invoices')->with(['edit'=>""]);


     }catch(\Exception $ex){
        DB::rollback();

        return redirect()->back()->withErrors(['error'=>" error "]);

     }

    }
    public function view_laboratories($id){
        $laboratorie=Laboratorie::where('id',$id)->where('employee_id',Auth::user()->id)->first();
        if($laboratorie){

            return view('Dashboard.dashboard_LaboratorieEmployee.invoices.patient_details',compact("laboratorie"));
        }

        else{
       
            return redirect()->back()->withError(['error'=>"لامكن الوصول لهذا المريض"]);

        }

    }
}