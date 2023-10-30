<?php

namespace App\Http\Controllers\dashbord_doctro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\DaashboardDoctor\DiagnosisRepositoryIntrface;


class DiagnosticController extends Controller
{
    private $Diagnostic;

    public function __construct(DiagnosisRepositoryIntrface $Diagnostic)
    {
        $this->Diagnostic = $Diagnostic;
    }

    public function store(Request $request){
       
        return $this->Diagnostic->store($request);
    }
    public function show($id){
        return $this ->Diagnostic->show($id);
    }
    public function storeReview(Request $request){
    
        return $this->Diagnostic->addReview($request);
    }

}
