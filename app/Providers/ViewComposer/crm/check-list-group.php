<?php
use Illuminate\Support\Facades\View;

View::composer([
    'CRM.elements.task.checklist-and-task.checklist.index',
    'CRM.elements.task.checklist-and-task.task.index'
], function ($view) {
    $user_id = \Illuminate\Support\Facades\Auth::user()->id;
    $groups = \App\Admin\CheckListGroup::with(['checkLists'])->where('created_by',$user_id)->orderBy('id','desc')->get()->map(function($process){
        $process->countProcessingg = $process->checkLists->where('result_id',1)->count();
        return $process;
    });
    $view->with(compact(
        'groups'
    ));
});
