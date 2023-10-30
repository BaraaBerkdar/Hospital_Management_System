<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Single_invoice extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function Service(){
        return $this->belongsTo('App\Models\Services','Service_id');
    }

    public function Patient(){
        return $this->belongsTo('App\Models\Patient','patient_id');
    }

    public function Doctor(){
        return $this->belongsTo('App\Models\Doctor','doctor_id');

    }
    public function Section(){
        return $this->belongsTo('App\Models\Section','section_id');

    }
    public function Group(){
        return $this->belongsTo('App\Models\Groups','Group_id');
    }
}
