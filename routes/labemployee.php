<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Laboratorie\LaboratorieController;

use  App\Http\Controllers\Dashboard_Laboratorie_Employee\LabController;
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:lab_employee' ]
    ], function(){

        Route::group(['prefix'=>"labemployee"],function(){
            Route::get('dashboard',function (){
                return view('Dashboard.dashboard_LaboratorieEmployee.dashboard');
                })->name('labemployee.dashboard');


                Route::get('invoices',[LabController::class,'index'])->name('lab.invoices');
                Route::get('invoices/edit{id}',[LabController::class,'edit'])->name('lab.edit');
                Route::post('invoices/update{id}',[LabController::class,'update'])->name('lab.update');
                Route::get('invoice/complete',[LabController::class,'completeinvoice'])->name('lab.complete');
                Route::get('invoice/show/{id}',[LabController::class,'show'])->name('view_laboratories');
               







                Route::post('logout',[LaboratorieController::class,'logout'])->name('logout.laboratorie_employee');



        });

    });