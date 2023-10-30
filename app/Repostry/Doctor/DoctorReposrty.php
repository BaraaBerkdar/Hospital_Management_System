<?php

namespace App\Repostry\Doctor;

use App\Interfaces\Doctor\DoctroRepostryIntrface;
use  App\Interfaces\Doctor\SectionRepositoryInterface;
use App\Models\Doctor;
use App\Models\DoctorAppointments;
use App\Models\Appointment;
use App\Models\Image;
use DB;
use App\Models\Section;
use Storage;
class DoctorReposrty implements DoctroRepostryIntrface
{

    public  function index(){

        $doctors=Doctor::all();
        return view('Dashboard.Doctor.index',compact('doctors'));


    }


    public function create(){
        $sections=Section::all();
        $appointments=DoctorAppointments::all();
        return view('Dashboard.Doctor.add',compact('sections','appointments'));

    }

    public function store($request){
      try{
        // return $request;
        $appointments = implode(',',$request->appointments);
        // return $appointments;
        DB::beginTransaction();
       $doctor= Doctor::create([
            'name'=>$request->name,
            'email' =>$request->email,
            "phone"  =>$request->phone,
            "password" =>bcrypt($request->password),
            "section_id" =>$request->section_id,
        ]);
        $doctor->hasAppointment()->syncWithoutDetaching($request->appointments);
       uplodeImage($doctor,public_path('Dashboard\img\doctors'),$request->photo,'App\Models\Doctor');
        DB::commit();
      return redirect()->route('doctors')->with(["add"=>"ff"]);
      }catch(\Exception $e){
        DB::rollback();
        return $e;
        return redirect()->route('doctors')->withErrors(['name'=>"e"]);

      }
    }

        public function update($req){

            $doctro=Doctor::find($req->id);

            if($doctro){
                    

                        $doctro->update([
                            
                            'name'=>$req->name,
                            'email' =>$req->email,
                            'phone' =>$req->phone,
                            'section_id'=>$req->section_id,
                        ]);
        $doctro->hasAppointment()->sync($req->appointments);


                    if($req->has('photo')){
                        if($doctro->image){
                        deleteAttach('doctor',$doctro->image->filename,$req->id);
                    }
                      uplodeImage($doctro,public_path('Dashboard\img\doctors'),$req->photo,'App\Models\Doctor');

                        
                    }
            
                return redirect()->route('doctors')->with(["edit"=>"ff"]);
            }
            else{
                return redirect()->withErorr(['no']);
            }
        }   

        public function destroy($req){
            
            try{
                if($req->page_id==1){
                    $doctor= Doctor::find($req->id);
                    
                    if($doctor){
                        
                        if($req->has('filename')){
                            deleteAttach('doctor',$req->filename,$req->id);
                            $doctor->delete();   
                            
                            return redirect()->route('doctors')->with(['delete'=>""]);
                    }else{
                        $doctor->delete();   
                            
                       
                        return redirect()->route('doctors')->with(['delete'=>""]);
                    }
                    

                    
                }else{
                    return redirect ()->route('doctors')->withErrors(['name'=>"error"]);

                }
            }else{
                $doctors=explode(',',$req->delete_select_id);
                foreach($doctors as $doctor){
                    $doctor= Doctor::find($doctor);

                    if($doctor){
                        deleteAttach('doctor',$doctor->image->filename,$doctor->id);
                        $doctor->delete();
                        
                    }
                    
                }    
                return redirect()->route('doctors')->with(['delete'=>""]);
            }


          }catch(\Exception $ex){

            return redirect ()->route('doctors')->withErrors(['name'=>"error"]);
           
          }

            }

            public function update_status($req){
                $doctor= Doctor::find($req->id);
                $doctor->update(['status'=>$req->status]);
                return redirect()->route('doctors')->with(['edit'=>""]);


            }


            public function edit($id){
                $doctor= Doctor::find($id);
                $sections=Section::all();
                $appointments=DoctorAppointments::all();

            return view('Dashboard.doctor.edit',compact('doctor','sections','appointments'));


            }

            public function updae_password($req){
        //         $this->validate($req, [
        //     'password' => 'required|min:6|confirmed',
        //     'password_confirmation' => 'required|min:6'
        // ]);
                try{
                    
                $doctor= Doctor::find($req->id);
                if($req->password===$req->password_confirmation){
                $doctor->update(['password'=>bcrypt($req->password)]);
                return redirect()->route('doctors')->with(['edit'=>""]);
                }else{
            return redirect ()->route('doctors')->withErrors(['name'=>"password not mathced"]);

                }
            
                }catch(\Exception $e){
                    return redirect ()->route('doctors')->withErrors(['name'=>"error"]);

                }
            }


}