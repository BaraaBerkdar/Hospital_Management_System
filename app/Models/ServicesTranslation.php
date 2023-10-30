<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public $timestamps = false;
    protected $table='services_translations'; 
}
