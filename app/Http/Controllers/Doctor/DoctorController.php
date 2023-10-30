<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DoctroRequest;
use App\Models\Doctor;
use App\Interfaces\Doctor\DoctroRepostryIntrface;
use Auth;
class DoctorController extends Controller
{
    

    private $doctor;

    public function __construct(DoctroRepostryIntrface $doctor)
    {
        $this->doctor = $doctor;
    }

    public function index()
    {
        return $this->doctor->index();
    }

    public function create(){

        return $this->doctor->create();
    }
  
    
    public function store(DoctroRequest $request)
    {

            return $this->doctor->store($request);
        
    }

   
    public function edit($id){
        return $this->doctor->edit($id);
    }
    
    public function update(DoctroRequest $request)
    {
            return $this->doctor->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->doctor->destroy($request);

    }
    public function update_status(Request $request){
        $this->validate($request, [
            'status' => 'required|in:0,1',
        ]);
        return $this->doctor->update_status($request);

    }

    public function updae_password(Request $request){
        
        
        $this->validate($request, [
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'
        ],[
            'password.min'=>"حقل الباسور يجب على الاقل 8 احرف",
            'password_confirmation'=>"حقل الباسور يجب على الاقل 8 احرف"
        ]);
        return $this->doctor->updae_password($request);
    }



    public function logout(Request $request){

        Auth::guard('doctor')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
