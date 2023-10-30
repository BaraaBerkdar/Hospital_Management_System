<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use HasFactory,Translatable;

    protected $table="doctors";
    public $translatedAttributes = ['name'];

    // protected $fillable =['name','email','password','section_id','phone','status'];
 protected $guarded=[];

 public function image(): MorphOne
 {
     return $this->morphOne(Image::class, 'imageable');
 }

 public function getPhotoAttribute($val){

    $val->image!=null ? asset('Dashboard/img/doctors/'.$val->image->filename) : "";
 }

 public function section(){
        return $this ->belongsTo('App\Models\Section','section_id');
 }


 public function getStatus(){

   return  $this->status == 1 ? trans('doctors.Enabled'):trans('doctors.Not_enabled');
 }
 public function alert(){
   return  $this->status == 1 ? 'success':'danger';
 }
 
 public function hasAppointment(){
    return $this->belongsTomany('App\Models\DoctorAppointments','appointmentdoctors','doctor_id','appointment_id');
 }
}
