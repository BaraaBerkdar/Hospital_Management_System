<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InsuranceConrtoller;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SectionContoller;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Service\ServiceContoller;
use App\Http\Controllers\Ambulance\AmbulanceController;
use App\Http\Controllers\Recept\ReceiptController;
use App\Http\Controllers\Patient\PatientConroller;
use App\Http\Controllers\Recept\PyamentController;
use App\Http\Controllers\RayEmployee\RayEmployeeController;
use  App\Http\Controllers\Laboratorie\LaboratorieController;
use App\Http\Controllers\Appointment\AppointmentController;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Groups;
use App\Models\Section;
use App\Models\Services;
use App\Events\MyEvent;

use App\Livewire\Layout;
use App\Livewire\SingleInvoice;
define('PAGE',10);
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:admin' ]
    ], function(){ //...
        Route::group(['prefix'=>"admin"],function(){

            Route::get('dashboard',function (){

                $data['doctor']          = Doctor::count();
                $data['patient']         =Patient::count();
                $data['groupservice']     =Groups::count();
                $data['services']         =Services::count();
                $data['sections']         =Section::count();
                return view('Dashboard.Admin.dashboard',$data);})->name('admin.main');
            
                // begin Section Route 

                Route::get('/section',[SectionContoller::class,'index'])->name('admin.section');
                Route::post('/section/store',[SectionContoller::class,'store'])->name('admin.section.store');
                Route::post('/section/update',[SectionContoller::class,'update'])->name('admin.section.update');
                Route::get('/section/doctors/{id}',[SectionContoller::class,'show'])->name('section.showDoctors');
                Route::post('/section/destroy',[SectionContoller::class,'delete'])->name('admin.section.destroy');
                // end section Route 


                // begin Doctor Route 
                
                Route::get('/doctor',[DoctorController::class,'index'])->name('doctors');
                Route::get('/doctor/add',[DoctorController::class,'create'])->name('doctor.add');
                Route::post('/doctor/store',[DoctorController::class,'store'])->name('doctor.store');
                Route::get('/doctor/edit/{id}',[DoctorController::class,'edit'])->name('doctor.edit');
                Route::post('doctor/update',[DoctorController::class,'update'])->name('doctor.update');
                Route::post('/doctor/delete',[DoctorController::class,'destroy'])->name('doctor.destroy');
                Route::post('/dector/updatestatus',[DoctorController::class,'update_status'])->name('doctor.update_status');
                Route::post('/doctor/updae_password',[DoctorController::class,'updae_password'])->name('doctor.update_password');
                // end Doctor Route 
                
                
                // begin Service route

                Route::get('service/single',[ServiceContoller::class,'index'])->name('service.single');
                Route::post('service/stroe',[ServiceContoller::class,'store'])->name('service.store');
                Route::post('service/delete',[ServiceContoller::class,'destroy'])->name('service.delete');
                Route::post('service/update',[ServiceContoller::class,'update'])->name('service.update');
                
                // end service Route
                




                // begin Route Isurance 
                Route::get('/insurance',[InsuranceConrtoller::class,'index'])->name('insurance');
                Route::get('/insurance/create',[InsuranceConrtoller::class,'create'])->name('insurance.create');
                Route::post('/insurance/store',[InsuranceConrtoller::class,'store'])->name('insurance.store'); 
                Route::post('/insurance/destroy',[InsuranceConrtoller::class,'destroy'])->name('insurance.destroy');
                Route::get('/insurance/edit/{id}',[InsuranceConrtoller::class,'edit'])->name('insurance.edit');
                Route::post('/insurance/update',[InsuranceConrtoller::class,'update'])->name('insurance.update');
                // end route Isurance 

                // begin Route ambulances

                Route::get('/ambulances',[AmbulanceController::class,'index'])->name('ambulances');
                Route::get('/ambulances/create',[AmbulanceController::class,'create'])->name('Ambulance.create');
                Route::post('/ambulances/store',[AmbulanceController::class,'store'])->name('Ambulance.store');
                Route::get('/ambulances/edit/{id}',[AmbulanceController::class,'edit'])->name('ambulances.edit');
                Route::post('/ambulances/update',[AmbulanceController::class,'update'])->name('Ambulance.update');
                Route::post('/ambulances/destroy',[AmbulanceController::class,'destroy'])->name('Ambulance.destroy');
                // end Route ambulances
                

                // begin Route Patients
                Route::get('/patients',[PatientConroller::class,'index'])->name('patients');
                Route::get('/patients/create',[PatientConroller::class,'create'])->name('Patients.create');
                Route::post('/patients/store',[PatientConroller::class,'store'])->name('Patients.store');
                Route::get('/patients/edit/{id}',[PatientConroller::class,'edit'])->name('Patients.edit');
                Route::post('/patients/update/',[PatientConroller::class,'update'])->name('Patients.update');
                Route::post('/patients/destroy/',[PatientConroller::class,'destroy'])->name('Patients.destroy');
                Route::get('/patients/show/{id}',[PatientConroller::class,'show'])->name('Patients.show');
                
                // end Route Patients
                
                // begin Route Recepit 

                Route::get('/recept',[ReceiptController::class,'index'])->name('receipt');
                Route::get('/receipt/create',[ReceiptController::class,'create'])->name('receipt.create');
                Route::post('/receipt/store',[ReceiptController::class,'store'])->name('receipt.store');
                Route::get('/receiot/edit/{id}',[ReceiptController::class,'edit'])->name('receipt.edit');
                Route::post('/receipt/update',[ReceiptController::class,'update'])->name('receipt.update');
                Route::post('/receipt/destroy',[ReceiptController::class,'destroy'])->name('receipt.destroy');
                Route::get('/receipt/print/{id}',[ReceiptController::class,'show'])->name('receipt.print');
                // end Route Recepit
                

                // begin Route Pyment

                Route::get('/pyment',[PyamentController::class,'index'])->name('pyments');
                Route::get('/pyment/create',[PyamentController::class,'create'])->name('Payment.create');
                Route::post('/pyment/store',[PyamentController::class,'store'])->name('Payment.store');
                Route::get('/pyment/edit/{id}',[PyamentController::class,'edit'])->name('Payment.edit');
                Route::post('/pyment/update',[PyamentController::class,'update'])->name('Payment.update');
                Route::post('/pyment/destroy',[PyamentController::class,'destroy'])->name('Payment.destroy');
                Route::get('/pyment/print/{id}',[PyamentController::class,'show'])->name('Payment.show');
                


                // end Route Pyment

                // begin Route  RayEmployee
                Route::get('rayemployee',[RayEmployeeController::class,'index'])->name('RayEmployee.index');
                Route::post('rayemployee/store',[RayEmployeeController::class,'store'])->name('ray_employee.store');
                Route::post('rayemployee/update/{id}',[RayEmployeeController::class,'update'])->name('ray_employee.update');
                Route::post('rayemployee/destroy/{id}',[RayEmployeeController::class,'destroy'])->name('ray_employee.destroy');
               
                // end  Route RayEmployee

                // begin Route  Laboratorie
                Route::get('laboratorieemployee',[LaboratorieController::class,'index'])->name('lab_emoloyee.index');
                Route::post('laboratorieemployee/store',[LaboratorieController::class,'store'])->name('laboratorie_employee.store');
                Route::post('laboratorieemployee/update/{id}',[LaboratorieController::class,'update'])->name('laboratorie_employee.update');
                Route::post('laboratorieemployee/delete/{id}',[LaboratorieController::class,'destroy'])->name('laboratorie_employee.destroy');

                // end Routee Laboratorie


                // begin Appointments Route 

                Route::get('appointment',[AppointmentController::class,'index'])->name('appointments');
                Route::post('appointment/approval{id}',[AppointmentController::class,'aprove'])->name('appointments.approval');
                Route::get('appointment/approved',[AppointmentController::class,'index2'])->name('appointments.approved');
                Route::post('appointment/destrory',[AppointmentController::class,'destroy'])->name('appointments.destroy');
                // end Appointments Route 

                
                Route::post('logout',[AdminController::class,"logout"])->name('admin.logout');
                // 
                
            });
            
            require __DIR__.'/auth.php';
            
        });
        


        Route::group(['middleware'=>"auth:admin"],function(){

            // begin Route single Invoices
            Route::view('single_invoices','livewire.single_invoices.index')->name('Invoices.single');
            Route::view('Print_single_invoices','livewire.single_invoices.print')->name('Print_single_invoices');
    
            // Route::get('invoices',SingleInvoice::class)->name('Invoices.single');
            
            // end Route single Invoices

            // begin Route Groupinvoices 

            Route::view('group-invoices','livewire.group_invoices.index')->name('Invoices.Group');
            Route::view('group_Print_single_invoices','livewire.Group_invoices.print')->name('group_Print_single_invoices');

            // end Route Groupinvoices 

        });
        







        
        
        
        Route::get('/groupservices',Layout::class)->name('liveware')->middleware('auth:admin');
        
        
        
        
        
        
        
        
        