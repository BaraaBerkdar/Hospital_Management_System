<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Repostry\Sections\SectionRepository;
use App\Interfaces\Section\SectionRepositoryInterface;
use App\Repostry\Doctor\DoctorReposrty;
use App\Interfaces\Doctor\DoctroRepostryIntrface;
use App\Interfaces\Service\ServiceRepostryIntrface;
use App\Repostry\Service\ServiceRepostry;
use App\Interfaces\Insyrance\InsyranceRepostryIntrface;
use App\Repostry\Insyrance\InsyranceRepostry;
use App\Interfaces\Ambulance\AmbulanceRepostryIntrface;
use  App\Repostry\Ambulance\AmbulanceRepostry;
use App\Interfaces\Patient\PatientRepostryIntrface;
use App\Repostry\Patient\PatientRepostry;
use App\Interfaces\Finance\ReceiptRepositoryInterface;
use App\Repostry\Finance\ReceiptRepository;
use App\Interfaces\Finance\PymentRepostryIntrface;
use App\Repostry\Finance\PymentRepostry;
use App\Interfaces\DaashboardDoctor\InvoicesRepositoryInterface;
use App\Repostry\DaashboardDoctor\InvoicesRepository;
use App\Interfaces\DaashboardDoctor\DiagnosisRepositoryIntrface;
use App\Repostry\DaashboardDoctor\DiagnosisRepository;
use App\Interfaces\DaashboardDoctor\RayReposrtyIntrface;
use App\Repostry\DaashboardDoctor\RayRepostry;
use App\Interfaces\DaashboardDoctor\laboratoriesRepostryIntrface;
use App\Repostry\DaashboardDoctor\laboratoriesRepostry;
use App\Interfaces\RayEmployee\RayEmployeeRepositoryInterface;
use App\Repostry\RayEmployee\RayEmployeeRepository;
use App\Interfaces\LaboratorieEmployee\LaboratorieEmployeeRepositoryInterface;
use  App\Repostry\LaboratorieEmployee\LaboratorieEmployeeRepository;
use App\Interfaces\Dashboard_Laboratorie_Employee\InvoicesRepositoryInterfaceLab;
use App\Repostry\Dashboard_Laboratorie_Employee\InvoicesRepositoryLab;
use App\Interfaces\Appointment\AppointmetnRepostryIntrface;
use App\Repostry\Appointmetnt\AppointmetnRepostry;


class RepositoryServiceProvider extends ServiceProvider
{
   
    public function register(): void
    {
        $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);
        $this->app->bind(DoctroRepostryIntrface::class, DoctorReposrty::class);
        $this->app->bind(ServiceRepostryIntrface::class, ServiceRepostry::class);
        $this->app->bind(InsyranceRepostryIntrface::class, InsyranceRepostry::class);
        $this->app->bind(AmbulanceRepostryIntrface::class, AmbulanceRepostry::class);
        $this->app->bind(PatientRepostryIntrface::class, PatientRepostry::class);
        $this->app->bind(ReceiptRepositoryInterface::class, ReceiptRepository::class);
        $this->app->bind(PymentRepostryIntrface::class, PymentRepostry::class);
        $this->app->bind(InvoicesRepositoryInterface::class, InvoicesRepository::class);
        $this->app->bind(DiagnosisRepositoryIntrface::class, DiagnosisRepository::class);
        $this->app->bind(RayReposrtyIntrface::class, RayRepostry::class);
        $this->app->bind(laboratoriesRepostryIntrface::class, laboratoriesRepostry::class);
        $this->app->bind(RayEmployeeRepositoryInterface::class, RayEmployeeRepository::class);
        $this->app->bind('App\Interfaces\Dashboard_Ray_Employee\InvoicesRepositoryInterface',
        'App\Repostry\Dashboard_Ray_Employee\InvoicesRepository');

        $this->app->bind(LaboratorieEmployeeRepositoryInterface::class, LaboratorieEmployeeRepository::class);
        $this->app->bind(InvoicesRepositoryInterfaceLab::class, InvoicesRepositoryLab::class);
        $this->app->bind(AppointmetnRepostryIntrface::class, AppointmetnRepostry::class);
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
