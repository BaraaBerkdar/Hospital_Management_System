<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Services extends Model
{
    use HasFactory,Translatable;

    protected $table="services";

    public $translatedAttributes = ['name'];
    
    protected $guarded=[];

    public function belongsGroups(){
        
        return $this->belongsToMany('App\Models\Groups','group_service','service_id','group_id');

    }

}
