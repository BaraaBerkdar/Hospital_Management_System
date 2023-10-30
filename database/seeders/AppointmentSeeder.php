<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use App\Models\DoctorAppointments;
class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doctor_appointments')->delete();
        $days=['السبت','الاحد','الاثنين','الثلاثاء','الاربعاء','الخميس','الحمعة'];
        foreach($days as $day){
            DoctorAppointments::create(['name'=>$day]);
        }
        

    }
}
