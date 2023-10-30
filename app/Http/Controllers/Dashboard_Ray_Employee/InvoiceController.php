<?php

namespace App\Http\Controllers\Dashboard_Ray_Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Interfaces\Dashboard_Ray_Employee\InvoicesRepositoryInterface;

class InvoiceController extends Controller
{

    private $Invoice;

    public function __construct(InvoicesRepositoryInterface $Invoice)
    {
        $this->Invoice = $Invoice;
    }

    public function index(){
        return $this->Invoice->index();

    }
    public function edit($id){
        return $this->Invoice->edit($id);

    }
    public function update(Request $request , string  $id)
    {
        return $this->Invoice->update($request,$id);
        
    }
    public function show(string $id){
        return $this->Invoice->view_rays($id);

    }
    public function completeinvoice(){

        return $this->Invoice->completed_invoices();

    }

   
}
