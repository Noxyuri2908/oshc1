<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tags')->delete();
        
        \DB::table('tags')->insert(array (
            0 => 
            array (
                'id' => 1,
                'menu_id' => 2,
                'slug' => 'oshc',
                'name' => 'oshc',
                'name_cn' => 'oshc',
                'name_vi' => 'oshc',
                'type' => NULL,
                'note' => NULL,
                'status' => 1,
                'created_at' => '2019-08-27 10:16:51',
                'updated_at' => '2020-09-11 18:29:01',
            ),
            1 => 
            array (
                'id' => 2,
                'menu_id' => 2,
                'slug' => 'oshc-australia',
                'name' => 'oshc australia',
                'name_cn' => 'oshc australia',
                'name_vi' => 'oshc australia',
                'type' => NULL,
                'note' => NULL,
                'status' => 1,
                'created_at' => '2019-08-27 10:17:26',
                'updated_at' => '2020-09-11 18:30:06',
            ),
            2 => 
            array (
                'id' => 3,
                'menu_id' => 2,
                'slug' => 'overseas student health cover',
                'name' => 'overseas student health cover',
                'name_cn' => 'overseas student health cover',
                'name_vi' => 'overseas student health cover',
                'type' => NULL,
                'note' => NULL,
                'status' => 1,
                'created_at' => '2019-08-27 10:18:17',
                'updated_at' => '2020-09-11 18:29:37',
            ),
        ));
        
        
    }
}