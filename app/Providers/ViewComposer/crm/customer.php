<?php

use App\Admin;
use App\Admin\Dichvu;
use App\Admin\Promotion;
use App\Admin\School;
use Illuminate\Support\Facades\View;

View::composer([
    'CRM.elements.customers.filter.cus',
    'CRM.elements.customers.filter.com',
    'CRM.elements.customers.filter.profit',
    'CRM.elements.customers.filter.refund',
    'CRM.elements.customers.data.refund',
    'CRM.elements.customers.filter.extend'
], function ($view) {
    $countries = config('country.list');
    $statuses = config('myconfig.status_invoice');
    $service_countries = config('myconfig.service_country');
    $services = \App\Admin\Dichvu::pluck('name', 'id');
    $type_invoices = config('myconfig.type_invoice');
    $providers = \App\Admin\Service::where('dichvu_id', 2)->pluck('name', 'id');
    $policies = config('myconfig.policy');
    $type_visas = config('myconfig.type_visa');
    $promotions = \App\Admin\Promotion::pluck('code', 'id');
    $type_payment = config('myconfig.payment_method');
    $type_payment_note = config('myconfig.payment_note_provider');
    $users = \App\Admin::pluck('admin_id', 'id');
    $location_australia = config('location_australia');
    $visa_status = config('myconfig.status_visa');
    $policy_status = config('myconfig.policy_status');
    $configLivingInA = config('myconfig.live_in_AS');
    $profit_status = cache()->remember('profit_status.customer', 86400, function () {
        return \App\Admin\Profit::$STATUS;
    });
    $commission_payment_status = cache()->remember('commission_payment_status.customer', 86400, function () {
        return \App\Admin\Profit::$commissionPaymentStatus;
    });
    $gst_status_agent_profit = cache()->remember('gst_status_agent_profit.customer', 86400, function () {
        return \App\Admin\Profit::$gst_status_agent_profit;
    });
    $std_status = config('myconfig.status_refund');
    $remind_status = config('crm.remind_status');
    $gstConfig = config('myconfig.gst');
    $configTypeOfRefund = config('myconfig.type_of_refund_profit');

    $view->with(compact(
        'remind_status',
        'std_status',
        'gst_status_agent_profit',
        'commission_payment_status',
        'profit_status',
        'countries',
        'statuses',
        'service_countries',
        'services',
        'type_invoices',
        'providers',
        'policies',
        'type_visas',
        'promotions',
        'type_payment',
        'type_payment_note',
        'users',
        'location_australia',
        'visa_status',
        'policy_status',
        'gstConfig',
        'configTypeOfRefund',
        'configLivingInA'
    ));
});
View::composer([
    'CRM.elements.customers.create',
    'CRM.elements.customers.modal-create',
    'CRM.elements.customers.content'
], function ($view) {
    $staffs = Admin::orderby('username')->where('status', 1)->get(['admin_id','id']);
    $dichvus = Dichvu::with(['providers'])->where('type_form',1)->orderby('name')->get(['id','type_form','name']);
    $providers = Admin\Service::orderby('name')->where('status', 1)->get(['id','status','name']);
    $promotions = Promotion::get(['id','name','amount','code']);
    $schools = School::orderby('name')->get(['id','name']);
    $gstConfig = config('myconfig.gst');
    $typePaymentConfig = config('myconfig.type_payment');

    $view->with(compact(
        'staffs',
        'dichvus',
        'promotions',
        'providers',
        'schools',
        'gstConfig',
        'typePaymentConfig'
    ));
});
