<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommissionRequest extends FormRequest
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
            'user_id' => 'required',
            'service_id'   => 'required',
            'type' => 'required',
            'comm'   => 'required',
            'date' => 'required',
            'status'   => 'required',
        ];

    }
    public function messages()
    {
        return [
            'user_id.required' => 'User không được để trống.',
            'service_id.required' => 'Dịch vụ không được để trống.',
            'type.required' => 'Loại dịch vụ không được để trống.',
            'comm.required' => 'Hoa hồng thái không được để trống.',
            'date.required' => 'Ngày hết hạn không được để trống.',
            'status.required' => 'Trạng thái không được để trống.',
        ];
    }
}
