<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table='appointments';
    protected $fillable = ['name','email','notes','phone','doctor_id','section_id','appointment','type'];

    public function Doctor()
    {
     return $this ->belongsTo('App\Models\Doctor','doctor_id');
    }



}
