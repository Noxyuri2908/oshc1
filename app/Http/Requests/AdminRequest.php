<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Admin;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('users.store');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'sometimes|required|unique:admins',
            'email' => 'required|email',
            'password' => 'required|string',
            'status'=>'required|in:1,0',
            'roles' => 'nullable|array',
            'admin_id'=>'nullable|string',
            'date_of_birth'=>'nullable|date_format:d/m/Y',
            'address'=>'nullable|string',
            'phone'=>'nullable|numeric|size:11',
            'department_id'=>'nullable',
            'branch_id'=>'nullable',
            'position_id'=>'nullable'
        ];
    }
}
