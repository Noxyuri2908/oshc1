<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupportRequest extends FormRequest
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
            'process' => 'required',
            'role'   => 'required',
        ];
        
    }
    public function messages()
    {
        return [
            'process.required' => 'Nội dung không được để trống.',
            'role.required' => 'Người tạo chưa chọn.',
        ];
    }
}
