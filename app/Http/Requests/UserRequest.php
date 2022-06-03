<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class UserRequest extends FormRequest
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
            $_id = $this->get('user_id');
            return [
                'email' => 'required|unique:users,email,'.$_id.',id',
                'name'   => 'required',
            ];
        }else{
            return [
                'email' => 'required|unique:users',
                'name'   => 'required',
                'password'   => 'required',
            ];
        }
        
    }
    public function messages()
    {
        return [
            'email.required' => 'Email không được để trống.',
            'email.unique' => 'Email không được trùng.',
            'name.required' => 'Tên người dùng không được để trống.',
            'password.required' => 'Mật khẩu không được để trống.',
            'status.required' => 'Trạng thái không được để trống.',
        ];
    }
}
