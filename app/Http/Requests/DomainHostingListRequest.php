<?php

namespace App\Http\Requests;

use App\Admin\Status;
use Illuminate\Foundation\Http\FormRequest;

class DomainHostingListRequest extends FormRequest
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
        $admins = \App\Admin::pluck('id')->implode(',');
        $types = Status::where('type','type_domain_hosting')->pluck('id')->implode(',');
        return [
            'type'=>'nullable|numeric|in:'.$types,
            'name'=>'nullable|string',
            'link'=>'nullable|string',
            'user'=>'nullable|string',
            'password'=>'nullable|string',
            'provider'=>'nullable|string',
            'person_in_charge'=>'nullable|numeric|in:'.$admins,
            'email_in_charge'=>'nullable|string|email',
            'expiry_date'=>'nullable|date_format:d/m/Y',
            'fee'=>'nullable|string',
            'note'=>'nullable|string'
        ];
    }
}
