<?php
use Illuminate\Support\Facades\View;

View::composer([
    'CRM.elements.staff.form',
    'CRM.pages.staff'
], function ($view) {
    $statuses = \App\Admin\Status::whereIn('type',[
        'department_staff',
        'branch_staff',
        'position_staff'
    ])->get(['type','name','id']);
    $department_ids = $statuses->where('type','department_staff');
    $branch_ids = $statuses->where('type','branch_staff');
    $position_ids = $statuses->where('type','position_staff');
    $view->with(compact(
        'department_ids',
        'branch_ids',
        'position_ids'
    ));
});
