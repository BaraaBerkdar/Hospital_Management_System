<?php

namespace App\Http\Controllers\dashbord_doctro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\DaashboardDoctor\laboratoriesRepostryIntrface;


class LaboratoriesController extends Controller
{
    private $Laboratories;

    public function __construct(laboratoriesRepostryIntrface $Laboratories)
    {
        $this->Laboratories = $Laboratories;
    }


    public function store(Request $request){
        return $this->Laboratories->store($request);
    }

    public function update(Request $request, string $id){
        return $this->Laboratories->update($request,$id);
    }
    public function delete($id){
        return $this->Laboratories->delete($id);

    }
    public function show1(string $id){
        return $this ->Laboratories->show1($id);

    }
}
