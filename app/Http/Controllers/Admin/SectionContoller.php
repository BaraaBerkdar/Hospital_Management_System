<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Section\SectionRepositoryInterface;

class SectionContoller extends Controller
{
   

     private $Sections;

     public function __construct(SectionRepositoryInterface $Sections)
     {
         $this->Sections = $Sections;
     }


    public function index()
    {   

        return $this->Sections->index();
        

    }

        public function show($id){
            return $this->Sections->show($id);
        }
   
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ],[
            'name.required'=>__('DoctorRequest.required') ,
        ]);


        return $this->Sections->store($request);
    }

    
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ],[
            'name.required'=>__('DoctorRequest.required') ,
        ]);
        return $this->Sections->update($request);
    }

   
    public function delete(Request $request)
    {
        return $this->Sections->destroy($request);
    }
}
