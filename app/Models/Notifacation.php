<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifacation extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function scopeGetNotifacation($q){

        $q->where('user_id',auth()->user()->id)->where('reader_status',0);
    }

}
