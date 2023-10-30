<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory,Translatable;

    protected $table="insurances";
    protected $guarded=[];
    public $translatedAttributes = ['name','notes'];


}
