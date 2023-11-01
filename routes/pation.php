<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Laboratorie\LaboratorieController;
use App\Http\Controllers\Dashboard_Patient\pationController;
use App\Livewire\Chat\CreatChat;
use App\Livewire\Chat\Main;

use  App\Http\Controllers\Dashboard_Laboratorie_Employee\LabController;
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:pation' ]
    ], function(){
    
        Route::group(['prefix'=>"pation"],function(){
            Route::get('dashboard',function (){
           
                    return view('Dashboard.dashboard_patient.dashboard');
                })->name('pation.dashboard');

                Route::get('/invoice',[pationController::class,"getinvoice"])->name('pation.invoices');
                Route::get('/lab',[pationController::class,"getlab"])->name('pation.lab');
                Route::get('/viewlab/{id}',[pationController::class,"viewlab"])->name('pation.viewlab');
                Route::get('/ray',[pationController::class,"getray"])->name('pation.ray');
                Route::get('/viewray/{id}',[pationController::class,"viewrys"])->name('rays.view');
                Route::get('pation/appointments/approved',[pationController::class,"appointment_approved"])->name('pation.app.aprove');
                Route::get('pation/appointments',[pationController::class,"appointment"])->name('pation.app');
                Route::post('delete',[pationController::class,'destroy'])->name('app.destroy');
                Route::post('/logout',[pationController::class,"logout"])->name('logout.patient');
            }); 
        

            Route::get('list/doctro',CreatChat::class)->name('doctor.list');
            Route::get('list/chat',Main::class)->name('chat.list');

    });



    Route::get('register/form',[pationController::class,'register_view'])->name('pation.register.view');
    Route::post('/register',[pationController::class,'register'])->name('pation.register');




    // https://dashboard.pusher.com/