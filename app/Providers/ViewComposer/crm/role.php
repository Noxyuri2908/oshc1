<?php

use App\Admin\Status;
use Illuminate\Support\Facades\View;

View::composer([
    'CRM.pages.role.form'
], function ($view) {
    $admins = \App\Admin::where('status',1)->pluck('admin_id','id');
    $view->with(compact(
        'admins'
    ));
});
