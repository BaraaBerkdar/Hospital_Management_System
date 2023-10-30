<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsuranceRequest extends FormRequest
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
            'insurance_code' => 'required',
            'discount_percentage' =>'required|numeric',
            'company_rate' =>'required|numeric',
            'name' => 'required|unique:insurance_translations,name,'.$this->id,
        ];
    }



    public function messages()
    {
        return [
            'insurance_code.required' => trans('validation.required'),
            'discount_percentage.required' => trans('validation.required'),
            'discount_percentage.numeric' => trans('validation.numeric'),
            'company_rate.required' => trans('validation.required'),
            'company_rate.numeric' => trans('validation.numeric'),
            'name.required' => trans('validation.required'),
            'name.unique' => trans('validation.unique'),
        ];
    }

}
