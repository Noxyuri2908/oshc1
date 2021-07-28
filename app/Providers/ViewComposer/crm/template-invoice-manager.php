<?php
use Illuminate\Support\Facades\View;

View::composer([
    'CRM.pages.template_invoice_manager.form',
    'CRM.pages.template_invoice_manager.filter',
    'CRM.pages.template_invoice_manager.data'

], function ($view) {
    $invoiceTypeConfig = config('myconfig.template_export');
    $view->with(compact(
        'invoiceTypeConfig'
    ));
});
