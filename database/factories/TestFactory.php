<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Test;
use Faker\Generator as Faker;

$factory->define(Test::class, function (Faker $faker) {
    return [
        //
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ];
});
//$factory->define(\App\Admin\CustomerDatabaseManager::class,function (Faker $faker){
//
//});
