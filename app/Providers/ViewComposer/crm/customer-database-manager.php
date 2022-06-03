<?php
use Illuminate\Support\Facades\View;

View::composer([
    'CRM.pages.customer_database_manager.form',
    'CRM.pages.customer_database_manager.filter',
    'CRM.pages.customer_database_manager.data'
], function ($view) {
    $genderType = \App\Admin\CustomerDatabaseManager::$GENDER;
    $potentialityType = \App\Admin\CustomerDatabaseManager::$Potentiality;
    $emailStatusType = \App\Admin\CustomerDatabaseManager::$EmailStatus;
    $statuses = \App\Admin\Status::whereIn('type',[
        'customer_database_manager_type_of_customer',
        'customer_database_manager_resource',
        'customer_database_manager_english_center',
        'customer_database_manager_event',
        'customer_database_manager_study_tour'
    ])->get();
    $typeOfCustomer = $statuses->where('type','customer_database_manager_type_of_customer');
    $resource = $statuses->where('type','customer_database_manager_resource');
    $englishCenter = $statuses->where('type','customer_database_manager_english_center');
    $event = $statuses->where('type','customer_database_manager_event');
    $studyTour = $statuses->where('type','customer_database_manager_study_tour');
    $agents = \App\User::pluck('name','id');
    $countries = config('country.list');
    $services = \App\Admin\Service::pluck('name','id');
//    dd(array_rand($services));
    $view->with(compact(
        'genderType',
        'potentialityType',
        'emailStatusType',
        'typeOfCustomer',
        'resource',
        'emailStatusType',
        'englishCenter',
        'event',
        'studyTour',
        'agents',
        'countries',
        'services'
    ));
});
