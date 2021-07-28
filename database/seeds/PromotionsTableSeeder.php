<?php

use Illuminate\Database\Seeder;

class PromotionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('promotions')->delete();
        
        \DB::table('promotions')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'Allianz Christmas 2019',
                'start_date' => '10/10/2019',
                'end_date' => '20/10/2019',
                'amount' => '11',
                'code' => 'PRO18918',
                'status' => 1,
                'created_at' => '2019-11-28 06:17:51',
                'updated_at' => '2020-01-01 15:54:42',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Allianz 2/2020',
                'start_date' => '10/02/2020',
                'end_date' => '29/02/2020',
                'amount' => '15',
                'code' => '15',
                'status' => 1,
                'created_at' => '2020-02-21 07:51:22',
                'updated_at' => '2020-02-21 09:22:06',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'Allianz 1/2020',
                'start_date' => '01/01/2020',
                'end_date' => '31/01/2020',
                'amount' => '15',
                'code' => 'Allianz 1/2020',
                'status' => 1,
                'created_at' => '2020-02-21 09:23:30',
                'updated_at' => '2020-02-21 09:23:30',
            ),
        ));
        
        
    }
}