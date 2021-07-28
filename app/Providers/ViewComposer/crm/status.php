<?php

use App\Admin\Status;
use Illuminate\Support\Facades\View;

View::composer([
    'CRM.pages.status.status_form'
], function ($view) {
    $types = Status::$TYPE;
    $typeOfStatus = Status::$TYPEOFSTATUS;
    $view->with(compact(
        'types',
        'typeOfStatus'
    ));
});
