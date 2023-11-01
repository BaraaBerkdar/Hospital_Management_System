<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\DoctorDashController;
use App\Http\Controllers\dashbord_doctro\DiagnosticController;
use App\Http\Controllers\dashbord_doctro\RayController;
use App\Http\Controllers\dashbord_doctro\LaboratoriesController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Livewire\Chat\CreatChat;
use App\Livewire\Chat\Main;
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:doctor' ]
    ], function(){

        Route::group(['prefix'=>"doctor"],function(){

            Route::get('dashboard',function (){
            return view('Dashboard.doctordashbord.dashboard');
            })->name('doctor.dashboard');

                // begin invoice Route
                Route::get('invoice',[DoctorDashController::class,'index'])->name('doctor.invoice');
                Route::get('ivoice/complete',[DoctorDashController::class,"invoiceComplete"])->name('doctor.invoice_complet');
                Route::get('ivoice/review',[DoctorDashController::class,"invoiceReview"])->name('doctor.reviewinvoice');

                // end invoice Route 

                // begin invoice notifacation  Route
                Route::get('/invoice/notifacation/view/{id}',[DoctorDashController::class,'read_notifacation'])->name('read');
                Route::get('/invoice/notifacation/viewall',[DoctorDashController::class,'view_all_notfi'])->name('read_all');
                // end invoice  notifacation Route 

            // begin Diagnostic Route

            Route::post('/diagnostic/store',[DiagnosticController::class,'store'])->name('Diagnostics.store');
            Route::get('/diagnostic/show/{id}',[DiagnosticController::class,'show'])->name('Diagnostics.show');
            Route::post('review/store',[DiagnosticController::class,'storeReview'])->name('add_review');
            // end Diagnostic Route


            // begin Ray Route
            Route::post('ray/store',[RayController::class,'store'])->name('rays.store');
            Route::post('ray/update/{id}',[RayController::class,'update'])->name('rays.update');
            Route::post('ray/destroy/{id}',[RayController::class,'destroy'])->name('rays.destroy');
            Route::get('ray/show/{id}',[RayController::class,'show'])->name('ray.show');
            
            // end Ray Route

            // begin Laboratories Route 
            Route::post('laboratories',[LaboratoriesController::class,'store'])->name('Laboratories.store');
            Route::post('laboratories/update/{id}',[LaboratoriesController::class,'update'])->name('Laboratories.update');
            Route::post('laboratories/destroy/{id}',[LaboratoriesController::class,'destroy'])->name('Laboratories.destroy');
            Route::get('invoice/show/{id}',[LaboratoriesController::class,'show1'])->name('lab.show');
          
            // end Laboratories Route
            Route::get('list/pation',CreatChat::class)->name('pation.list');
            Route::get('list/chat',Main::class)->name('pationchat.list');
            
            Route::post('logout', [DoctorController::class, 'logout'])->name('logout/doctor');






        }); 

    });