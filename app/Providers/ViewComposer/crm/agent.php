<?php

use App\Admin;
use App\Admin\SaleTaskAssign;
use Illuminate\Support\Facades\View;

View::composer([
    'CRM.elements.agents.filter',
    'CRM.elements.agents.data',
    //'CRM.elements.agents.modal.modal_person_in_charge',
    'CRM.elements.table-agent',
    'CRM.elements.process.form',
    'CRM.elements.info-agent',
    'CRM.pages.agent-contact.filter',
    'CRM.elements.task.sale.table.follow_up_agent'

], function ($view) {
    $typeAgent = config('admin.type_agent');
    $userStatus = config('admin.status');
    $infoMarket = config('myconfig.market');
    $countries = config('country.list');
    $departments = config('myconfig.department');
    $admins = \App\Admin::pluck('admin_id','id');
    $typeSaleTask = SaleTaskAssign::$TYPE;
    $dichvus = \App\Admin\Dichvu::where('status',1)->select(['id','name','status'])->get();
    $configRating = config('myconfig.rating');

    $configAgent = config('settings.agents.keys');
    $configAgentByOrder = sortSettingsByOrder($configAgent);

    $configFollowUp = config('settings.follows_up.keys');
    $configFollowsUpByOrder = sortSettingsByOrder($configFollowUp);

    $view->with(compact(
        'typeAgent',
        'userStatus',
        'infoMarket',
        'countries',
        'departments',
        'admins',
        'typeSaleTask',
        'dichvus',
        'configRating',
        'configAgentByOrder',
        'configFollowsUpByOrder'
    ));
});

View::composer([
    'CRM.elements.form-agent'
], function ($view) {
    $dichvus = \App\Admin\Dichvu::where('status',1)->get();
    $staffs = Admin::where('status', 1)->get();
    $status = config('admin.status');
    $services = Admin\Service::where('status', 1)->get();

    $view->with(compact(
        'dichvus',
        'status',
        'staffs',
        'services'
    ));
});

