<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Section extends Model
{
    use HasFactory,Translatable;

    protected $table='sections';
   
    protected $fillable =['name','description'];
    // 3. To define which attributes needs to be translated
    
    public $translatedAttributes = ['name','description'];


        public function hasdoctors(){

            return $this ->hasMany('App\Models\Doctor','section_id');
        }
}
