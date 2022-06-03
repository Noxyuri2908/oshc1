<?php
use Illuminate\Support\Facades\View;

View::composer([
    'CRM.pages.mail-skype-list.form',
    'CRM.pages.mail-skype-list.filter',
    'CRM.pages.mail-skype-list.data'
], function ($view) {
    $statuses = \App\Admin\Status::whereIn('type',[
        'type_domain_hosting',
        'domain_mail_skype'
    ])->get(['id','name','type','value']);
    $domains = $statuses->where('type','domain_mail_skype');
    $admins = \App\Admin::pluck('username', 'id');
    $view->with(compact(
        'domains',
        'admins'
    ));
});
