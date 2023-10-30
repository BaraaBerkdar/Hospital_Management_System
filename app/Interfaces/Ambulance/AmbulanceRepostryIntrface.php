<?php

namespace App\Interfaces\Ambulance;

interface  AmbulanceRepostryIntrface {


public function index();

public function store($req);

public function update($req);
public function destroy($req);
}
