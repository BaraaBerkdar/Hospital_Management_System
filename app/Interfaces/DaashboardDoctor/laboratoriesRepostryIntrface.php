<?php

namespace App\Interfaces\DaashboardDoctor;

interface laboratoriesRepostryIntrface {

    public function store($request);

    public function update($request,$id);

    public function destroy($id);

    
}