<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
          'name'=>"required",
       
          'password'=>"required_without:id|min:8",
          
          'section_id'  =>  'required|exists:sections,id',
          'phone' =>'required|unique:doctors,phone,'.$this -> id,
          'email'  => 'required|email|unique:doctors,email,'.$this -> id,
          'photo'       =>"required_without:id|mimes:jpg,jpeg,png"
        //   "appointments"
        ];
    }

    public function messages(){
return[
        'required'             =>__('DoctorRequest.required') ,
        'email.email'          =>__('DoctorRequest.email'),
        'unique.phone'         =>__('DoctorRequest.unique.phone'),
        "unique.email"         =>__('DoctorRequest.unique.email'),
        "photo.mims"           =>__('DoctorRequest.mims'),
        'password.min'         =>__('DoctorRequest.min'),
        'photo.required'       =>__('DoctorRequest.photo')
];
    }
}
