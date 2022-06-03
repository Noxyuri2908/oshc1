<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
                'slug'  => 'unique:posts,slug,'.$id.',id',
                'image'  => 'required',
                'name'  => 'required',
                'content'  => 'required',
                'des_s'  => 'required',
                'cat_id'  => 'required',
            ];
        }else{
            return [
                'slug'  => 'unique:posts',
                'image'  => 'required',
                'name'  => 'required',
                'content'  => 'required',
                'des_s'  => 'required',
                'cat_id'  => 'required',
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
            'content.required' => 'Nội dung không được để trống.',
            'des_s.required' => 'Miêu tả ngắn không được để trống.',
            'cat_id.required' => 'Chuyên mục không được để trống.',
        ];
    }
}
