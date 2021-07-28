<?php

use Illuminate\Database\Seeder;

class DichvusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('dichvus')->delete();
        
        \DB::table('dichvus')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'OSHC',
                'viettat' => 'SI',
                'slug' => 'oshc',
                'type_form' => 1,
                'pos' => 2,
                'status' => 1,
                'created_at' => '2019-12-12 02:24:41',
                'updated_at' => '2019-12-12 02:36:33',
                'service_id' => 1,
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'OVHC',
                'viettat' => NULL,
                'slug' => 'OVHC',
                'type_form' => 1,
                'pos' => 2,
                'status' => 1,
                'created_at' => '2020-09-21 11:47:02',
                'updated_at' => '2020-09-21 11:47:02',
                'service_id' => 2,
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'Student insurance',
                'viettat' => NULL,
                'slug' => 'Student insurance',
                'type_form' => 1,
                'pos' => 3,
                'status' => 1,
                'created_at' => '2020-09-21 11:47:51',
                'updated_at' => '2020-09-21 11:47:51',
                'service_id' => NULL,
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'Flywire',
                'viettat' => NULL,
                'slug' => 'Flywire',
                'type_form' => 3,
                'pos' => 4,
                'status' => 1,
                'created_at' => '2020-10-12 14:08:04',
                'updated_at' => '2020-10-12 14:08:04',
                'service_id' => NULL,
            ),
        ));
        
        
    }
}