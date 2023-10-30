<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    use HasFactory,Translatable;


    protected $table="groups";
    protected $fillable = ["Total_before_discount",	"discount_value",	"Total_after_discount",	"tax_rate"	,"Total_with_tax"];
    public $translatedAttributes = ['name','notes'];

    public function hasServices(){
        
        return $this->belongsToMany('App\Models\Services','group_service','group_id','service_id');

    }
}
