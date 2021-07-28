<?php

use Illuminate\Support\Facades\View;

View::composer([
    'CRM.elements.table-promotion',
    'CRM.elements.promotions.modal-update',
], function ($view) {
    $currencyConfig = config('myconfig.currency');
    $view->with(compact(
        'currencyConfig'
    ));
});
