<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptAccount extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function patients()
    {
        return $this->belongsTo('App\Models\Patient','patient_id');
    }
}
