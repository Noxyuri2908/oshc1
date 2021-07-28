<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerGetPriceRequest extends FormRequest
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
            'start_date'=>'required|date_format:d/m/Y|after_or_equal:today',
            'end_date'=>'required|date_format:d/m/Y',
            'adults'=>'required',
            'childs'=>'required'
        ];
    }
}
