<?php

use App\Admin;
use App\Admin\Dichvu;
use App\Admin\School;
use Illuminate\Support\Facades\View;

View::composer([
    'CRM.elements.flywire.form',
    'CRM.elements.flywire.filter',
    'CRM.elements.flywire.data',
], function ($view) {
    $schools = getSchoolFlywire();
    $staffs = Admin::orderby('admin_id')->where('status', 1)->get(['id', 'admin_id']);
    $countries = config('country.list');
    $typePayment = config('myconfig.payment_type');
    $dichvus = cache()->remember('GetServiceFlywire', 10, function () {
        return Dichvu::get(['id', 'name', 'type_form', 'status']);
    });
    $dichvu = $dichvus->where('type_form', 3)->where('status', 1)->first();
    $dichvu_id = (!empty($dichvu)) ? $dichvu->id : null;
    $service = cache()->remember('GetProviderFlywire', 10, function () use ($dichvu_id) {
        return Admin\Service::where('dichvu_id', $dichvu_id)->where('status', 1)->select(['id'])->first();
    });
    $provider = (!empty($service)) ? $service->id : null;
    $paymentStatus = config('myconfig.flywire_status');
    $typeGender = config('myconfig.gender');
    $paymentMethod = \Config::get('myconfig.payment_method');
    $comstatus = \Config::get('myconfig.com_status');
    $promotionCode = Admin\Promotion::orderByDesc('id')->get();
    $currencyConfig = config('myconfig.currency');
    $view->with(compact('paymentMethod',
        'schools',
        'staffs',
        'countries',
        'typePayment',
        'dichvus',
        'dichvu_id',
        'provider',
        'paymentStatus',
        'typeGender',
        'promotionCode',
    'currencyConfig',
    'comstatus'
    ));
});
