<?php

namespace App\Interfaces\Patient;

interface  PatientRepostryIntrface {


public function index();

public function store($req);

public function update($req);
public function destroy($req);
}
