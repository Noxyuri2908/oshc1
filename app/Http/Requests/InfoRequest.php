<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfoRequest extends FormRequest
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
                'user_id'  => 'required|unique:infos,user_id,'.$id.',id',
            ];
        }else{
            return [
                'user_id'  => 'required|unique:infos',
            ];
        }
    }

    public function messages()
    {
        return [
            'user_id.required' => 'User không được để trống.',
            'user_id.unique' => 'User không được trùng.',
        ];
    }
}
