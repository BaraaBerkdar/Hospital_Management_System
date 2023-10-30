<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\Insyrance\InsyranceRepostryIntrface;
use App\Http\Requests\InsuranceRequest;
class InsuranceConrtoller extends Controller
{
    private $insurance;

    public function __construct(InsyranceRepostryIntrface $insurance)
    {
        $this->insurance = $insurance;
    }
    
    public function index()
    {
     return $this->insurance->index();
    }

    
    public function create()
    {
        return view('Dashboard.insurance.create');
    }

  
    public function store(InsuranceRequest $request)
    {
        return $this->insurance->store($request);
    }

   

  
    public function edit(string $id)
    {
      return $this->insurance->edit($id);
    }

   
    public function update(InsuranceRequest $request)
    {
        return $this->insurance->update($request);
    }

   
    public function destroy(Request $request)
    {   
            return $this ->insurance->destroy($request);
    }
}
