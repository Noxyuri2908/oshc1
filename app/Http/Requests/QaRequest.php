<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QaRequest extends FormRequest
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
            'content' => 'required',
            'name'   => 'required',
            'content_cn' => 'required',
            'name_cn'   => 'required',
            'content_vi' => 'required',
            'name_vi'   => 'required',
        ];
        
    }
    public function messages()
    {
        return [
            'content.required' => 'Nội dung (EN) không được để trống.',
            'name.required' => 'Câu hỏi (EN) không được để trống.',
            'content_cn.required' => 'Nội dung (CN) không được để trống.',
            'name_cn.required' => 'Câu hỏi (CN) không được để trống.',
            'content_cn.required' => 'Nội dung (VI) không được để trống.',
            'name_vi.required' => 'Câu hỏi (VI) không được để trống.',
        ];
    }
}
