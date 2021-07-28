<?php

use Illuminate\Database\Seeder;

class DocsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('docs')->delete();
        
        \DB::table('docs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'OSHC policy document',
                'name_vi' => 'Chính sách OSHC',
                'name_cn' => 'OSHC政策文件',
                'link' => '#',
                'des_s' => NULL,
                'service_id' => 6,
                'created_by' => 1,
                'pos' => NULL,
                'status' => 1,
                'created_at' => '2019-07-31 02:31:34',
                'updated_at' => '2019-08-19 07:34:34',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Active your OSHC card',
                'name_vi' => 'Kích hoạt thẻ OSHC của bạn',
                'name_cn' => '激活您的OSHC卡',
                'link' => '#',
                'des_s' => NULL,
                'service_id' => 6,
                'created_by' => 1,
                'pos' => 2,
                'status' => 1,
                'created_at' => '2019-08-19 07:35:18',
                'updated_at' => '2019-08-19 07:35:18',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'OSHC Guideline',
                'name_vi' => 'Hướng dẫn OSHC',
                'name_cn' => 'OSHC指南',
                'link' => '#',
                'des_s' => NULL,
                'service_id' => 6,
                'created_by' => 1,
                'pos' => 3,
                'status' => 1,
                'created_at' => '2019-08-19 07:35:58',
                'updated_at' => '2019-08-19 07:35:58',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'OSHC policy document',
                'name_vi' => 'OSHC policy document',
                'name_cn' => 'OSHC policy document',
                'link' => '#',
                'des_s' => NULL,
                'service_id' => 4,
                'created_by' => 1,
                'pos' => NULL,
                'status' => 1,
                'created_at' => '2019-08-29 03:23:08',
                'updated_at' => '2019-08-29 03:23:08',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Active your OSHC card',
                'name_vi' => 'Active your OSHC card',
                'name_cn' => 'Active your OSHC card',
                'link' => '#',
                'des_s' => NULL,
                'service_id' => 4,
                'created_by' => 1,
                'pos' => 2,
                'status' => 1,
                'created_at' => '2019-08-29 03:23:46',
                'updated_at' => '2019-08-29 03:23:46',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'OSHC Guideline',
                'name_vi' => 'OSHC Guideline',
                'name_cn' => 'OSHC Guideline',
                'link' => '#',
                'des_s' => NULL,
                'service_id' => 4,
                'created_by' => 1,
                'pos' => 3,
                'status' => 1,
                'created_at' => '2019-08-29 03:24:05',
                'updated_at' => '2019-08-29 03:24:05',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'OSHC policy document',
                'name_vi' => 'OSHC policy document',
                'name_cn' => 'OSHC policy document',
                'link' => '#',
                'des_s' => NULL,
                'service_id' => 5,
                'created_by' => 1,
                'pos' => NULL,
                'status' => 1,
                'created_at' => '2019-08-29 03:24:27',
                'updated_at' => '2019-08-29 03:24:27',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Active your OSHC card',
                'name_vi' => 'Active your OSHC card',
                'name_cn' => 'Active your OSHC card',
                'link' => '#',
                'des_s' => NULL,
                'service_id' => 5,
                'created_by' => 1,
                'pos' => 2,
                'status' => 1,
                'created_at' => '2019-08-29 03:24:44',
                'updated_at' => '2019-08-29 03:24:44',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'OSHC Guideline',
                'name_vi' => 'OSHC Guideline',
                'name_cn' => 'OSHC Guideline',
                'link' => '#',
                'des_s' => NULL,
                'service_id' => 5,
                'created_by' => 1,
                'pos' => 3,
                'status' => 1,
                'created_at' => '2019-08-29 03:25:10',
                'updated_at' => '2019-08-29 03:25:10',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'OSHC policy document',
                'name_vi' => 'OSHC policy document',
                'name_cn' => 'OSHC policy document',
                'link' => '#',
                'des_s' => NULL,
                'service_id' => 7,
                'created_by' => 1,
                'pos' => NULL,
                'status' => 1,
                'created_at' => '2019-08-29 03:25:31',
                'updated_at' => '2019-08-29 03:25:31',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Active your OSHC card',
                'name_vi' => 'Active your OSHC card',
                'name_cn' => 'Active your OSHC card',
                'link' => '#',
                'des_s' => NULL,
                'service_id' => 7,
                'created_by' => 1,
                'pos' => 2,
                'status' => 1,
                'created_at' => '2019-08-29 03:25:47',
                'updated_at' => '2019-08-29 03:25:47',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'OSHC Guideline',
                'name_vi' => 'OSHC Guideline',
                'name_cn' => 'OSHC Guideline',
                'link' => '#',
                'des_s' => NULL,
                'service_id' => 7,
                'created_by' => 1,
                'pos' => 2,
                'status' => 1,
                'created_at' => '2019-08-29 03:26:01',
                'updated_at' => '2019-08-29 03:26:01',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'OSHC policy document',
                'name_vi' => 'OSHC policy document',
                'name_cn' => 'OSHC policy document',
                'link' => '#',
                'des_s' => NULL,
                'service_id' => 8,
                'created_by' => 1,
                'pos' => NULL,
                'status' => 1,
                'created_at' => '2019-08-29 03:26:21',
                'updated_at' => '2019-08-29 03:26:21',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Active your OSHC card',
                'name_vi' => 'Active your OSHC card',
                'name_cn' => 'Active your OSHC card',
                'link' => '#',
                'des_s' => NULL,
                'service_id' => 8,
                'created_by' => 1,
                'pos' => 2,
                'status' => 1,
                'created_at' => '2019-08-29 03:26:34',
                'updated_at' => '2019-08-29 03:26:34',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'OSHC Guideline',
                'name_vi' => 'OSHC Guideline',
                'name_cn' => 'OSHC Guideline',
                'link' => '#',
                'des_s' => NULL,
                'service_id' => 8,
                'created_by' => 1,
                'pos' => 3,
                'status' => 1,
                'created_at' => '2019-08-29 03:26:54',
                'updated_at' => '2019-08-29 03:26:54',
            ),
        ));
        
        
    }
}