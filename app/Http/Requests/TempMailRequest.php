<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TempMailRequest extends FormRequest
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
                'type'  => 'required|unique:temp_mails,type,'.$id.',id',
                'banner'  => 'required',
                'background_footer'  => 'required',
                'content'  => 'required',
                'content_vi'  => 'required',
                'content_cn'  => 'required',
                'status'  => 'required',
            ];
        }else{
            return [
                'type'  => 'required|unique:conf_mails',
                'banner'  => 'required',
                'background_footer'  => 'required',
                'content'  => 'required',
                'content_vi'  => 'required',
                'content_cn'  => 'required',
                'status'  => 'required',
            ];
        }
    }
}
