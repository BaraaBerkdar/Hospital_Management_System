<?php

namespace App\Interfaces\DaashboardDoctor;

interface RayReposrtyIntrface {

    public function store($request);

    public function update($request,$id);

    public function destroy($id);

    
}