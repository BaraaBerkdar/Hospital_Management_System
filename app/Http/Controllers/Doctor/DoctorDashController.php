<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Interfaces\DaashboardDoctor\InvoicesRepositoryInterface;
class DoctorDashController extends Controller
{
    private $invoice;

    public function __construct(InvoicesRepositoryInterface $invoice)
    {
        $this->invoice = $invoice;
    }

    public function index(){

        return $this->invoice->index();
    }

    public function invoiceComplete(){

        return $this->invoice->completedInvoices();
    }

    public function invoiceReview(){
        return $this->invoice->reviewInvoices();
    }



    public function read_notifacation($id){
        return $this->invoice->read_notifacation($id);

    }
    public function view_all_notfi(){
        return $this->invoice->view_all_notfi();

    }

   
}
