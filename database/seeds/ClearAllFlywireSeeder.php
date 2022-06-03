<?php

use Illuminate\Database\Seeder;

class ClearAllFlywireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Admin\Apply::where('payment_method', 4)
            ->where('type_get_data_payment', 2)->delete();
    }
}
