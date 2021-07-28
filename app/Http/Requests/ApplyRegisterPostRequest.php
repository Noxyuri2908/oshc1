<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyRegisterPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'main_title'=>'required',
            'main_gender'=>'required',
            'main_first_name'=>'required',
            'main_last_name'=>'required',
            'main_date'=>'required',
            'main_month'=>'required',
            'main_passport_number'=>'required',
            'main_country'=>'required',
            'main_education'=>'required',
            'location_australia'=>'required',
            'main_phone'=>'required',
            'main_email'=>'required',
            'main_email_confirm'=>'required',
            'main_is_locate'=>'required'
        ];
    }
}
