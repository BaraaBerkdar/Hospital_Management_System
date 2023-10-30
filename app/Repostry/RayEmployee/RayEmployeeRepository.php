<?php

namespace App\Repository\RayEmployee;

use App\Interfaces\RayEmployee\RayEmployeeRepositoryInterface;
use App\Models\RayEmployee;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class RayEmployeeRepository implements RayEmployeeRepositoryInterface
{
    
    public function index(){
        return "index";
    }

    public function store($request){

    }

    public function update($request,$id){}

    public function destroy($id){}

}