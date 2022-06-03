<?php

use Illuminate\Support\Facades\View;

View::composer([
    'CRM.pages.agent-commission.index',
    'CRM.pages.agent-commission.data',
    'CRM.pages.agent-commission.form',
    'CRM.elements.agents.modal-comm'
], function ($view) {
    $typePaymentConfig = config('myconfig.type_payment');
    $typeGstConfig = config('myconfig.gst');
    $typePolicyConfig = config('myconfig.policy');
    $typeUnitConfig = config('myconfig.donvi');
    $countries = config('country.list');
    $dichvus = \App\Admin\Dichvu::with([
        'providers'
    ])->get(['name','id']);
    $currencyConfig = config('myconfig.currency');
    $view->with(compact(
        'typePolicyConfig',
        'typeGstConfig',
        'typePaymentConfig',
        'typeUnitConfig',
        'countries',
        'dichvus',
        'currencyConfig'
    ));
});
