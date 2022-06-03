<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
        if ($this->method() == 'PATCH'){

            $id = $this->get('_id');
            return [
                'slug'  => 'required|unique:services,slug,'.$id.',id',
                'image'  => 'required',
                'name'  => 'required',
                'price'  => 'required',
            ];
        }else{
            return [
                'slug'  => 'required|unique:services',
                'image'  => 'required',
                'name'  => 'required',
                'price'  => 'required',
            ];
        }          
    }

    public function messages()
    {
        return [
            'slug.required' => 'Đường dẫn không được để trống.',
            'slug.unique' => 'Đường dẫn không được trùng.',
            'image.required' => 'Ảnh không được để trống.',
            'name.required' => 'Tên không được để trống.',
            'price.required' => 'Giá tiền không được để trống.',
        ];
    }
}
