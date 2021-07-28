<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TemplateInvoiceManager extends Model
{
    //
    protected $fillable = [
        'name',
        'template_name',
        'extended_properties',
        'company_name',
        'company_address',
        'logo',
        'content',
        'company_phone',
        'company_website',
        'company_email',
        'company_name_vi',
        'company_address_vi_1',
        'company_phone_vi_1',
        'company_address_vi_2',
        'company_phone_vi_2',
        'company_email_vi'
    ];
    protected $table = 'template_invoice_managers';
}
