<?php

use App\Admin\CommentsTask;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

View::composer([
    'CRM.elements.staff.form'
], function ($view) {
    $roles = \Spatie\Permission\Models\Role::pluck('name','id');
    $view->with(compact(
        'roles'
    ));
});


View::composer([
    'CRM.partials.navbar'
], function ($view) {
    $commentTasks = \Illuminate\Support\Facades\DB::table('follows')
        ->select('*')
        ->rightJoin('comments_tasks', 'comments_tasks.follow_id', 'follows.id')
        ->where('comments_tasks.send_to_staff_id', Auth::user()->id)
        ->get();

    $countTasks = \Illuminate\Support\Facades\DB::table('comments_tasks')
        ->where('comments_tasks.send_to_staff_id', Auth::user()->id)
        ->where('see', 0)
        ->get();

    $countComments = $countTasks->count();
    $view->with(compact(
        'commentTasks',
        'countComments'
    ));
});
