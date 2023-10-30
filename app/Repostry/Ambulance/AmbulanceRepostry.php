<?php

namespace App\Repostry\Ambulance;
use  App\Interfaces\Ambulance\AmbulanceRepostryIntrface;
use App\Models\Ambulance;


class AmbulanceRepostry implements AmbulanceRepostryIntrface{


    public function index(){

        $ambulances=Ambulance::all();
        return view('Dashboard.Ambulances.index',compact('ambulances'));
    }

    public function store($req){
        try{
            Ambulance::create($req->all());
      return redirect()->route('ambulances')->with(["add"=>"ff"]);



        }catch(\Exception $ex){

            return redirect()->back()->withError(['error'=>"error"]);


        }

    }


    public function edit($id){
        $ambulance=Ambulance::find($id);
        if($ambulance){
            return view('Dashboard.Ambulances.edit',compact('ambulance'));
        }else{
            return redirect()->back()->withError(['error'=>"error"]);

        }

    }

    
    public function update($req){

        try{
        $ambulance=Ambulance::find($req->id);
        if($ambulance){
            if(!$req->has('is_available')){
                $req->request->add(['is_available'=>2]);
            }

            $ambulance->update($req->all());

            return redirect()->route('ambulances')->with(["edit"=>"ff"]);


        }else{
            return redirect()->back()->withError(['error'=>"error"]);

        }


        }catch(\Exception $ex){
            return redirect()->back()->withError(['error'=>"error"]);


        }


   
    }
    public function destroy($req){

 $ambulance=Ambulance::find($req->id);
        if($ambulance){
          

            $ambulance->delete();

            return redirect()->route('ambulances')->with(["delete"=>"ff"]);


        }else{
            return redirect()->back()->withError(['error'=>"error"]);

        }

    }

}