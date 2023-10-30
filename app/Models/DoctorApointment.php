<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorApointment extends Model
{
    use HasFactory;

    protected $table='appointmentdoctors';
     protected $guarded=[];

}
