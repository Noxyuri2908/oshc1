<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocRequest extends FormRequest
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
                'name'  => 'required',
                'name_cn'  => 'required',
                'name_vi'  => 'required',
                'link'  => 'required',
                'service_id'  => 'required',
            ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên tiếng Anh không được để trống.',
            'name_cn.required' => 'Tên tiếng Trung không được để trống.',
            'name_vi.required' => 'Tên tiếng Việt không được để trống.',
            'link.required' => 'Đường dẫn không được để trống.',
            'service_id.required' => 'Dịch vụ không được để trống.',
        ];
    }
}
