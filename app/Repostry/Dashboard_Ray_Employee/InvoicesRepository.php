<?php

namespace App\Repostry\Dashboard_Ray_Employee;
use App\Models\Image;

use  App\Interfaces\Dashboard_Ray_Employee\InvoicesRepositoryInterface;

use App\Models\Ray;
use Illuminate\Support\Facades\DB;
use App\Trait\UplodeImages;

use Auth;

class InvoicesRepository implements InvoicesRepositoryInterface
{
    use UplodeImages;
    public function index(){
        $invoices=Ray::where('case',0)->get();

        return view('Dashboard.dashboard_RayEmployee.invoices.index',compact('invoices'));
        
    }
    public function completed_invoices(){

        $invoices=Ray::where('case',1)->where('employee_id',Auth::user()->id)->get();
        
        return view('Dashboard.dashboard_RayEmployee.invoices.completed_invoices',compact('invoices'));

    }
    public function edit($id){
        $invoice=Ray::find($id);

        return view('Dashboard.dashboard_RayEmployee.invoices.add_diagnosis',compact('invoice'));
        
    }
    public function update($request,$id){
        try{
            DB::beginTransaction();
            $invoice=Ray::find($id);
            $invoice->update([
                'description_employee'         =>$request->description_employee,
                "employee_id"                  =>Auth::user()->id,
                'case'                           =>1
            ]);
        if($request->has('photos')){
            // move images
            $name=$invoice->Patient->name;
           
            foreach($request->photos as $photo){

         $this->uplodeImages($photo,public_path('Dashboard\img\Rays'),$name,'App\Models\Ray',$id);

            }
        }
        DB::commit();
        return redirect()->route('invoices_ray_employee.index')->with(['edit'=>""]);


     }catch(\Exception $ex){
        DB::rollback();

        return redirect()->back()->withErrors(['error'=>" error "]);

     }
    }
    public function view_rays($id){

        // $rays=Ray::find($id);
        $rays=Ray::where('id',$id)->where('employee_id',Auth::user()->id)->first();
        if($rays){

            return view('Dashboard.dashboard_RayEmployee.invoices.patient_details',compact('rays'));

        }

        else{
       
            return redirect()->back()->withError(['error'=>"لامكن الوصول لهذا المريض"]);

        }


    }
}