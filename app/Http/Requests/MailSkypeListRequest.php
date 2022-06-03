<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailSkypeListRequest extends FormRequest
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
        $statuses = \App\Admin\Status::whereIn('type',[
            'type_domain_hosting',
            'domain_mail_skype'
        ])->get(['id','name','type','value']);
        $domains = $statuses->where('type','domain_mail_skype')->pluck('id')->implode(',');
        $admins = \App\Admin::pluck('id')->implode(',');

        return [
            'domain_id'=>'nullable|in:'.$domains,
            'email'=>'nullable|email',
            'person_in_charge'=>'nullable|in:'.$admins,
            'password'=>'nullable|string',
            'skype'=>'nullable|string',
            'crm'=>'nullable|string',
            'dropbox'=>'nullable|string',
            'note'=>'nullable|string'
        ];
    }
}
