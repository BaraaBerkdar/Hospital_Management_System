<?php

namespace App\Http\Controllers\RayEmployee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\RayEmployee\RayEmployeeRepositoryInterface;
use App\Models\RayEmployee;
use Auth;
class RayEmployeeController extends Controller
{
    // private $RayEmployee;

    // public function __construct(RayEmployeeRepositoryInterface $RayEmployee)
    // {
    //     $this->RayEmployee = $RayEmployee;
    // }

    public function index(){
        $ray_employees=RayEmployee::all();
        return view('Dashboard.ray_employee.index',compact('ray_employees'));
        // return $this->RayEmployee->index();
    }

    public function store(Request $request){
        RayEmployee::create([
            'name'=>$request->name,
            'email' =>$request->email,
            'password'=>bcrypt($request->password)
        ]);
        return redirect()->back()->with(['add'=>""]);
    }

    public function update(Request $request,string $id){
        
        $employy=RayEmployee::find($id);
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
        $employy=RayEmployee::find($id);
        $employy->delete();
        return redirect()->back()->with(['delete'=>""]);


    }


    public function logout(Request $request){

        Auth::guard('ray_employee')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
