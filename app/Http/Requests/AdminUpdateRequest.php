<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('users.update');
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
            'username' => 'sometimes|string|required|unique:admins,username,'.$this->route('staff'),
            'email' => 'required|email',
            'password' => 'nullable|string',
            'status'=>'required|in:1,0',
            'roles' => 'nullable|array',
            'admin_id'=>'nullable|string',
            'date_of_birth'=>'nullable|date_format:d/m/Y',
            'address'=>'nullable|string',
            'phone'=>'nullable|digits:10|numeric',
            'department_id'=>'nullable',
            'branch_id'=>'nullable',
            'position_id'=>'nullable'
        ];
    }
}
