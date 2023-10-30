<?php

namespace App\Repostry\Service;
use  App\Interfaces\Service\ServiceRepostryIntrface;
use App\Models\Services;

class ServiceRepostry implements ServiceRepostryIntrface
{

    public  function index(){
 
        $services=Services::paginate(PAGE);
        return view('Dashboard.Services.Single Service.index',compact('services'));



    }

    public function store($req){
    
        Services::create([
            'name'           =>$req->name,
            "description"    =>$req->description,
            "price"          =>$req->price

        ]);
      return redirect()->back()->with(["add"=>"ff"]);

    
    }

        public function update($req){
            $service=Services::find($req->id);
            $service->update($req->all());

            return redirect()->route('service.single')->with(["edit"=>"ff"]);
            
        }   

        public function destroy($req){
           
         try{
            $service=Services::find($req->id);
            if($service){
            $service->delete();
            return redirect()->route('service.single')->with(['delete'=>""]);
         

            }else{
                return redirect()->route('service.single')->withErrors(['name'=>"error"]);


            }
         }catch(\Exception $ex){
            return $ex;
            return redirect()->route('service.single')->withErrors(['name'=>"error"]);


         }

        }

        public function show($id){
        

        }
}