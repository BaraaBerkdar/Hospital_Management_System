<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consrvation extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function scopechekConversation($q,$auth_email,$receve_email){

    return $q->where('sender_email',$auth_email)->where('receiver_email',$receve_email)
        ->orwhere('receiver_email',$auth_email)->where('sender_email',$receve_email);
 
 
    }

    public function messages(){
        return $this ->hasMany('App\Models\Messages','consrvation_id');
    }
}
