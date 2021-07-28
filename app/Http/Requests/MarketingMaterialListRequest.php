<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarketingMaterialListRequest extends FormRequest
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
            'category_id'=>'nullable',
            'content'=>'nullable',
            'use_for'=>'nullable',
            'target'=>'nullable',
            'sub_target'=>'nullable',
            'file_attachment'=>'nullable|max:10000|mimes:jpeg,bmp,png,gif,svg,pdf,jpg,xlsx,xls,txt'
        ];
    }
}
