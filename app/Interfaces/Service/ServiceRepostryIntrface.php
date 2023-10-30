<?php

namespace App\Interfaces\Service;

interface  ServiceRepostryIntrface {


public function index();

public function store($req);

public function update($req);
public function destroy($req);
}
