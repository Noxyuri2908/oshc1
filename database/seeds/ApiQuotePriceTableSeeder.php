<?php

use App\Admin\Customer;
use Illuminate\Database\Seeder;

class ApiQuotePriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $applies = \App\Admin\Apply::get();
        foreach($applies as $apply){
            if(!empty($apply->start_date) && !empty($apply->end_date)){
                $month = count(convertDateRangeToMonth($apply->start_date,$apply->end_date));
                $day = $apply->getCountDay();
                $apply->update([
                    'count_month'=>$month,
                    'count_day'=>$day
                ]);
            }
        }
    }
}
