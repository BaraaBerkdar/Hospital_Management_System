<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorie extends Model
{
    use HasFactory;
    public $guarded=[];
    public function Doctor()
    {
     return $this ->belongsTo('App\Models\Doctor','doctor_id');
    }

    public function employee(){
     return $this ->belongsTo('App\Models\LaboratorieEmoloyee','employee_id');

    }
    public function Patient(){
        return $this->belongsTo('App\Models\Patient','patient_id');

    }

  
 public function images()
 {
     return $this->morphMany(Image::class, 'imageable');
 }

}
