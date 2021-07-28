<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Admin\CustomerDatabaseManager::class, function (Faker $faker) {
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
    $agents = \App\User::pluck('id');
    $countries = config('country.list');
    $services = \App\Admin\Service::pluck('name','id')->toArray();
    return [
        'type_of_customer_id'=>$typeOfCustomer->random()->id,
        'full_name'=>$faker->name,
        'source_id'=>$resource->random()->id,
        'agent_id'=>$agents->random(),
        'english_center_id'=>$englishCenter->random()->id,
        'event_id'=>$event->random()->id,
        'identification'=>$faker->phoneNumber,
        'gender'=>array_rand($genderType),
        'date_of_birth'=>$faker->date('Y-m-d'),
        'mail'=>$faker->email,
        'phone_number'=>$faker->phoneNumber,
        'social_link'=>$faker->imageUrl(),
        'country_id'=>array_rand($countries),
        'city_name'=>$faker->country,
        'school_name'=>$faker->name,
        'study_tour'=>$studyTour->random()->id,
        'departure_date'=>$faker->date('Y-m-d'),
        'destination_to_study'=>array_rand($countries),
        'potentiality'=>array_rand($potentialityType),
        'potential_service'=>array_rand($services),
        'email_status'=>array_rand($emailStatusType),
        'note'=>$faker->address
    ];
});
