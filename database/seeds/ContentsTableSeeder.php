<?php

use Illuminate\Database\Seeder;

class ContentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('contents')->delete();

        \DB::table('contents')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Loveie Zhao',
                'link' => NULL,
                'des_s' => '<p>China</p>',
                'des_f' => '<p>Highly recommend!! Great customer service with very quick response. Anyone need help please ask Janey without hesitation!!! She is a very good and nice staff member!!</p>',
                'image' => 'FILES/source/Zhao.jpg',
                'pos' => 1,
                'section_id' => 1,
                'type' => NULL,
                'note' => NULL,
                'created_by' => 1,
                'status' => 1,
                'created_at' => '2019-08-03 07:15:29',
                'updated_at' => '2020-09-11 17:13:51',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Davide Traverso',
                'link' => NULL,
                'des_s' => '<p>Italy</p>',
                'des_f' => '<p>Great customer service, they helped me straight away after my questions</p>',
                'image' => 'FILES/source/Davide%20Traverso.jpg',
                'pos' => 2,
                'section_id' => 1,
                'type' => NULL,
                'note' => NULL,
                'created_by' => 1,
                'status' => 1,
                'created_at' => '2019-08-03 08:00:48',
                'updated_at' => '2020-09-11 17:37:48',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Nguyen Quang Hung',
                'link' => NULL,
                'des_s' => '<p>Vietnam</p>',
                'des_f' => '<p>Best team ever with amazing, helpful information and friendly staff!</p>',
                'image' => 'FILES/source/quang-hung.png',
                'pos' => 3,
                'section_id' => 1,
                'type' => NULL,
                'note' => NULL,
                'created_by' => 1,
                'status' => 1,
                'created_at' => '2019-08-03 08:01:46',
                'updated_at' => '2020-09-11 17:39:44',
            ),
            3 =>
            array (
                'id' => 5,
                'name' => 'Christina Duong',
                'link' => '#',
                'des_s' => '<p>Vietnam</p>',
                'des_f' => '<p>Good service and friendly staff!</p>',
                'image' => 'FILES/source/christina-duong.jpg',
                'pos' => 6,
                'section_id' => 1,
                'type' => NULL,
                'note' => NULL,
                'created_by' => 1,
                'status' => 1,
                'created_at' => '2019-09-24 10:33:50',
                'updated_at' => '2020-09-11 17:40:45',
            ),
            4 =>
            array (
                'id' => 6,
                'name' => 'Saini Jeevan',
                'link' => NULL,
                'des_s' => '<p>Philipines</p>',
                'des_f' => '<p>Trusted... in time services. Friendly staff!</p>',
                'image' => 'FILES/source/saini.png',
                'pos' => 5,
                'section_id' => 1,
                'type' => NULL,
                'note' => NULL,
                'created_by' => 1,
                'status' => 1,
                'created_at' => '2020-09-11 16:23:21',
                'updated_at' => '2020-09-11 17:40:54',
            ),
            5 =>
            array (
                'id' => 7,
                'name' => 'Kim Seo Yeon',
                'link' => NULL,
                'des_s' => '<p>Korea</p>',
                'des_f' => '<p>Very good service, nice staff. Very conviniece for me!</p>',
                'image' => 'FILES/source/kim.png',
                'pos' => 7,
                'section_id' => 1,
                'type' => NULL,
                'note' => NULL,
                'created_by' => 1,
                'status' => 1,
                'created_at' => '2020-09-11 17:53:06',
                'updated_at' => '2020-09-17 13:59:22',
            ),
        ));


    }
}
