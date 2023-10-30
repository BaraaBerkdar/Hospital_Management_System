<?php

namespace App\Repostry\Insyrance;
use  App\Interfaces\Insyrance\InsyranceRepostryIntrface;
use App\Models\Insurance;
class InsyranceRepostry implements InsyranceRepostryIntrface
{

    public  function index(){

        $insurances=Insurance::all();  

        return view('Dashboard.insurance.index',compact('insurances'));

    }

    public function store($req){
       
        Insurance::create($req->all());
      return redirect()->route('insurance')->with(["add"=>"ff"]);
        
    }

        public function update($req){
           
            try{
     
                $insurance=Insurance::find($req->id);
                if($insurance){
                    if(!$req->has('status')){
                        $req->request->add(['status'=>0]);
                    }
                    $insurance->update($req->all());
                    return redirect()->route('insurance')->with(['edit'=>""]);
    
                }else{
                    return redirect ()->route('insurance')->withErrors(['name'=>"not found"]);
    
                }
    
            }catch(\Exception $ex){
         
                return redirect ()->route('insurance')->withErrors(['name'=>"error"]);
    
            }


        }

        public function edit($id){
          
            $insurances=Insurance::find($id);
            return view('Dashboard.insurance.edit',compact('insurances'));



        }
       public function destroy($req){
       
        try{

            $insurance=Insurance::find($req->id);
            if($insurance){
                $insurance->delete();
                return redirect()->route('insurance')->with(['delete'=>""]);

            }else{
                return redirect ()->route('doctors')->withErrors(['name'=>"not found"]);

            }

        }catch(\Exception $ex){
            return redirect ()->route('doctors')->withErrors(['name'=>"error"]);

        }

        }

}