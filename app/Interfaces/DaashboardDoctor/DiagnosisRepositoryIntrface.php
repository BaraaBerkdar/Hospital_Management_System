<?php

namespace App\Interfaces\DaashboardDoctor;

interface DiagnosisRepositoryIntrface 
{


    public function store($request);

    public function show($id);

    public function addReview($request);

}