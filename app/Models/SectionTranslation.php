<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','locale'];
    public $timestamps = false;
    protected $table='section_translations'; 

}
