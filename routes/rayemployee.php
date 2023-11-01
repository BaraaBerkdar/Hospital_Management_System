<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\DoctorDashController;
use App\Http\Controllers\dashbord_doctro\DiagnosticController;
use App\Http\Controllers\dashbord_doctro\RayController;
use App\Http\Controllers\dashbord_doctro\LaboratoriesController;
use  App\Http\Controllers\RayEmployee\RayEmployeeController;
use  App\Http\Controllers\Dashboard_Ray_Employee\InvoiceController;
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:ray_employee' ]
    ], function(){

        Route::group(['prefix'=>"rayemployee"],function(){
            Route::get('dashboard',function (){
                return view('Dashboard.dashboard_RayEmployee.dashboard');
                })->name('employee.dashboard');


                Route::get('invoices',[InvoiceController::class,'index'])->name('ray.invoices');
                Route::get('invoices/edit{id}',[InvoiceController::class,'edit'])->name('invoices_ray_employee.edit');
                Route::post('invoices/update{id}',[InvoiceController::class,'update'])->name('invoices_ray_employee.update');
                Route::get('invoice/complete',[InvoiceController::class,'completeinvoice'])->name('ray.invoiceComplete');
                Route::get('invoice/show/{id}',[InvoiceController::class,'show'])->name('invoice.show');
               
                Route::post('logout',[RayEmployeeController::class,'logout'])->name('logout.ray_employee');
        }); 




    });