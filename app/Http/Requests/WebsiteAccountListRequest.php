<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebsiteAccountListRequest extends FormRequest
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
            'type'=>'required|numeric|in:1,2',
            'website'=>'nullable|string',
            'service'=>'nullable|string',
            'link'=>'nullable|string',
            'website_and_service_id'=>'nullable|string',
            'password'=>'nullable|string',
            'supporter'=>'nullable|string',
            'note'=>'nullable|string'

        ];
    }
}
