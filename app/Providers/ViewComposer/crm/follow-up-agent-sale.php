<?php
use Illuminate\Support\Facades\View;

View::composer([
    'CRM.elements.task.sale.table.follow_up_agent.data',
], function ($view) {
    $dichvu = \App\Admin\Dichvu::get();
    $view->with(compact(
        'dichvu'
    ));
});
