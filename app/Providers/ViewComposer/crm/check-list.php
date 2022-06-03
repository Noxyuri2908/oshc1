<?php
use Illuminate\Support\Facades\View;

View::composer([
    'CRM.elements.task.checklist-and-task.checklist.form',
    'CRM.elements.task.checklist-and-task.checklist.filter',
    'CRM.elements.task.checklist-and-task.checklist.data',
    'CRM.elements.task.checklist-and-task.task.data',
    'CRM.elements.task.media',
], function ($view) {
    $admins = \App\Admin::pluck('admin_id','id');
    $statuses = \App\Admin\Status::whereIn('type',[
        'web_media'
    ])->get();
    $webMedias = $statuses->where('type','web_media');
    $results = \App\Admin\CheckList::$RESULT;
    $types = \App\Admin\CheckList::$TYPE;
    $lvprocessor = \App\Admin\CheckList::$LVPROCESSOR;
    $checklistSetting = \App\Admin\CheckListSetting::where('type','checklist_type')->get()->toTree();
    $checklistSettingType = \App\Admin\CheckListSetting::with('children')->where('type','checklist_type')->get();
    $solution_it_checklist = \App\Admin\Status::where('type','solution_it_checklist')->get();
    //dd($checklistSetting->where('id',1)->first()->children);
    $view->with(compact(
        'admins',
        'webMedias',
        'results',
        'types',
        'checklistSetting',
        'checklistSettingType',
        'solution_it_checklist',
        'lvprocessor'
    ));
});
