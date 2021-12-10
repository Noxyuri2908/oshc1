<?php
use Illuminate\Support\Facades\View;

View::composer([
    'CRM.pages.marketing-material.form',
    'CRM.pages.marketing-material.filter'
], function ($view) {
    $statuses = \App\Admin\Status::whereIn('type',[
        'category_marketing_material',
        'use_for_marketing_material',
        'target_marketing_material',
        'type_marketing_material'
    ])->get(['id','name','type','value']);
    $categories = $statuses->where('type','category_marketing_material');
    $use_fors = $statuses->where('type','use_for_marketing_material');
    $targets = $statuses->where('type','target_marketing_material');
    $type = $statuses->where('type','type_marketing_material');
    $admins = \App\Admin::pluck('username', 'id');
    $view->with(compact(
        'categories',
        'use_fors',
        'type',
        'targets',
        'admins'
    ));
});
