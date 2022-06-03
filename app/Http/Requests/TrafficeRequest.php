<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrafficeRequest extends FormRequest
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
            'start_date'=>'nullable|string|date_format:d/m/Y',
            'end_date'=>'nullable|string|date_format:d/m/Y',
            'total_view'=>'nullable|numeric',
            'total_user'=>'nullable|numeric',
            'total_like'=>'nullable|numeric',
            'total_reach'=>'nullable|numeric',
            'note'=>'nullable|string',
        ];
    }
}
