<?php
namespace App\Repostry\LaboratorieEmployee;
use  App\Interfaces\LaboratorieEmployee\LaboratorieEmployeeRepositoryInterface;
use App\Models\LaboratorieEmoloyee;

class LaboratorieEmployeeRepository implements LaboratorieEmployeeRepositoryInterface
{


    public function index(){

        $laboratorie_employees=LaboratorieEmoloyee::all();
        return view('Dashboard.laboratorie_employee.index',compact('laboratorie_employees'));


    }

    public function store($request){
       
      try{
        LaboratorieEmoloyee::create([
            'name' =>$request->name,
            "email"=>$request->email,
            "password"=>bcrypt($request->password) 
        ]);
        return redirect()->back()->with(['add'=>""]);

      }catch(\Exception $ex){
        return redirect()->back()->withError('error');
      }     

    }

    public function update($request,$id){
     
        $employy=LaboratorieEmoloyee::find($id);
        if(empty($request->password)){
           $employy->update([
            'name'=>$request->name,
            'email'=>$request->email
           ]);
        }else{
            $employy->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password)
               ]);
        }

        return redirect()->back()->with(['edit'=>""]);



    }

    public function destroy($id){
        $employy=LaboratorieEmoloyee::find($id);
        $employy->delete();

        return redirect()->back()->with(['delete'=>""]);


    }

    
}