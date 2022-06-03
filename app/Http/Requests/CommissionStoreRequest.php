<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommissionStoreRequest extends FormRequest
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
            'service_id'=>'nullable',
            'provider_id'=>'nullable',
            'comm'=>'required',
            'donvi'=>'required',
            'type_payment'=>'nullable',
            'validity_start_date'=>'nullable|date_format:d/m/Y',
            'gst'=>'nullable',
            'status'=>'nullable',
            'unit'=>'nullable',
            'policy'=>'nullable'
        ];
    }
}
