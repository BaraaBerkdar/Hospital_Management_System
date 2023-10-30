<?php

namespace App\Interfaces\Doctor;

interface  DoctroRepostryIntrface {


public function index();

public function store($req);

public function update($req);
public function destroy($req);
}
