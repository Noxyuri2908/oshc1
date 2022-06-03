<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommissionUpdateRequest extends FormRequest
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
            //
            'user_id'=>'required',
            'service_id'=>'required',
            'provider_id'=>'required',
            'comm'=>'required',
            'donvi'=>'required',
            'type_payment'=>'nullable',
            'validity_start_date'=>'nullable',
            'gst'=>'nullable',
            'status'=>'nullable',
            'unit'=>'nullable',
            'policy'=>'nullable'
        ];
    }
}
