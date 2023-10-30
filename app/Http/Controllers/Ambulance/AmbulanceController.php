<?php

namespace App\Http\Controllers\Ambulance;
use App\Interfaces\Ambulance\AmbulanceRepostryIntrface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AmbulancesRequest;

class AmbulanceController extends Controller
{
    private $Ambulance;

    public function __construct(AmbulanceRepostryIntrface $Ambulance)
    {
        $this->Ambulance = $Ambulance;
    }
    public function index()
    {
        return $this->Ambulance->index();
    }

    
    public function create()
    {
        return view('Dashboard.Ambulances.create');
    }

   
    public function store(AmbulancesRequest $request)
    {
      return $this->Ambulance->store($request);
    }

 

   
    public function edit(string $id)
    {
      return $this->Ambulance->edit($id);
        
    }

  
    public function update(Request $request)
    {
        return $this->Ambulance->update($request);
    }

 
    public function destroy(Request $request)
    {
        return $this->Ambulance->destroy($request);
    }
}
