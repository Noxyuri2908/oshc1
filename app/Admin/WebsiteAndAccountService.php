<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class WebsiteAndAccountService extends Model
{
    //
    protected $table= 'website_and_account_service_lists';
    protected $fillable = [
        'type',
        'website',
        'service',
        'link',
        'website_and_service_id',
        'password',
        'supporter',
        'note'
    ];
    public static $TYPE = [
        1=>'website',
        2=>'service'
    ];
}
