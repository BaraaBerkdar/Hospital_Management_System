<?php

namespace App\Interfaces\Section;

interface  SectionRepositoryInterface {


public function index();

public function store($req);

public function update($req);
public function destroy($req);
}
