<?php
use Illuminate\Support\Facades\View;

View::composer([
    'CRM.pages.checklist-setting.index',
    'CRM.pages.checklist-setting.form'
], function ($view) {
    $types = \App\Admin\CheckListSetting::$STATUS;
    $view->with(compact(
        'types'
    ));
});
