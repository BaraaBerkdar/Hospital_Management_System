<?php

namespace App\Http\Controllers\dashbord_doctro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\DaashboardDoctor\RayReposrtyIntrface;

class RayController extends Controller
{
    private $Ray;

    public function __construct(RayReposrtyIntrface $Ray)
    {
        $this->Ray = $Ray;
    }

    public function store(Request $request){

        return $this->Ray->store($request);
    }
    public function update(Request $request,$id){
        return $this->Ray->update($request,$id);
    }
    public function destroy($id){
        return $this ->Ray->destroy($id);
    }

    public function show(string $id){
        return $this ->Ray->show($id);


    }

}
