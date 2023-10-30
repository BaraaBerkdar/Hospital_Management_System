<?php

namespace App\Interfaces\Insyrance;

interface  InsyranceRepostryIntrface {


public function index();

public function store($req);

public function update($req);
public function destroy($req);
}
