<?php

namespace App\Http\Controllers\Patient;
use App\Interfaces\Patient\PatientRepostryIntrface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientConroller extends Controller
{
    
    private $Patient;

    public function __construct(PatientRepostryIntrface $Patient)
    {
        $this->Patient = $Patient;
    }
    public function index()
    {
    return $this ->Patient->index();
    }

    public function create(){

        return view('Dashboard.Patients.create');
    }

   
    public function store(Request $request)
    {
        

            return $this->Patient->store($request);
    }

    public function show(string $id)
    {
        return $this->Patient->show($id);
        
    }

   
    public function edit(string $id)
    {   
        return $this->Patient->edit($id);
       
    }

    public function update(Request $request)
    {   
        return $this->Patient->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->Patient->destroy($request);
    }

  
}
