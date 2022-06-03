<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TemplateInvoiceManagerStoreRequest extends FormRequest
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
            'name'=>'nullable',
            'template_name'=>'required|numeric|unique:template_invoice_managers,template_name',
            'extended_properties'=>'nullable',
            'company_name'=>'nullable',
            'company_address'=>'nullable',
            'logo'=>'nullable',
            'content'=>'nullable',
            'company_phone'=>'nullable',
            'company_website'=>'nullable',
            'company_email'=>'nullable',
            'company_name_vi'=>'nullable',
            'company_address_vi_1'=>'nullable',
            'company_phone_vi_1'=>'nullable',
            'company_address_vi_2'=>'nullable',
            'company_phone_vi_2'=>'nullable',
            'company_email_vi'=>'nullable'

        ];
    }
}
