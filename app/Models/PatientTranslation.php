<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientTranslation extends Model
{
    use HasFactory;
    protected $table='patient_translations';
    protected $fillable = ['name','Address'];
    public $timestamps = false;

}
