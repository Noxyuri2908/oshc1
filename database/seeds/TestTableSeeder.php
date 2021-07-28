<?php

use App\Test;
use Illuminate\Database\Seeder;

class TestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        factory(Test::class, 10000)->create();
        factory(\App\Admin\CustomerDatabaseManager::class,10000)->create();
    }
}
