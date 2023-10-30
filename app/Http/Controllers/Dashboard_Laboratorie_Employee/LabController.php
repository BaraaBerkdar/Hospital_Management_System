<?php

namespace App\Http\Controllers\Dashboard_Laboratorie_Employee;
use App\Interfaces\Dashboard_Laboratorie_Employee\InvoicesRepositoryInterfaceLab;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LabController extends Controller
{
    private $Lab;

    public function __construct(InvoicesRepositoryInterfaceLab $Lab)
    {
        $this->Lab = $Lab;
    }
    public function index(){

        return $this->Lab->index();
    
    }
    public function edit(string $id){
        return $this->Lab->edit($id);

    }
    public function update(Request $request ,string $id){
        return $this->Lab->update($request,$id);

    }

    public function show(string $id){
        return $this->Lab->view_laboratories($id);
        
    }
    public function completeinvoice(){
        return $this ->Lab->completed_invoices();
    }
}
