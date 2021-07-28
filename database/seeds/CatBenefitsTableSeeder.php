<?php

use Illuminate\Database\Seeder;

class CatBenefitsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cat_benefits')->delete();
        
        \DB::table('cat_benefits')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'IN HOSPITAL TREATMENT',
                'name_cn' => 'IN HOSPITAL TREATMENT',
                'name_vi' => 'IN HOSPITAL TREATMENT',
                'des_s' => NULL,
                'created_by' => 1,
                'pos' => 3,
                'status' => 1,
                'created_at' => '2019-07-31 02:50:51',
                'updated_at' => '2020-09-18 19:41:26',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'OTHER COVERAGE',
                'name_cn' => '其他覆盖范围',
                'name_vi' => 'BẢO HIỂM KHÁC',
                'des_s' => NULL,
                'created_by' => 1,
                'pos' => 4,
                'status' => 1,
                'created_at' => '2019-08-19 08:11:08',
                'updated_at' => '2019-08-29 09:36:07',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'VISA COMPLIANCE',
                'name_cn' => 'VISA COMPLIANCE',
                'name_vi' => 'VISA COMPLIANCE',
                'des_s' => NULL,
                'created_by' => 1,
                'pos' => 1,
                'status' => 1,
                'created_at' => '2019-08-29 09:32:02',
                'updated_at' => '2019-08-29 09:36:23',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'OUT OF MEDICAL HOSPITAL SERVICES',
                'name_cn' => 'OUT OF MEDICAL HOSPITAL SERVICES',
                'name_vi' => 'OUT OF MEDICAL HOSPITAL SERVICES',
                'des_s' => NULL,
                'created_by' => 1,
                'pos' => 2,
                'status' => 1,
                'created_at' => '2019-08-29 09:34:26',
                'updated_at' => '2020-09-18 19:41:39',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'WAITING PERIOD',
                'name_cn' => 'WAITING PERIOD',
                'name_vi' => 'WAITING PERIOD',
                'des_s' => NULL,
                'created_by' => 1,
                'pos' => 5,
                'status' => 1,
                'created_at' => '2019-08-29 09:34:52',
                'updated_at' => '2019-08-29 09:34:52',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'EXTRA FEATURES',
                'name_cn' => 'EXTRA FEATURES',
                'name_vi' => 'EXTRA FEATURES',
                'des_s' => NULL,
                'created_by' => 1,
                'pos' => 6,
                'status' => 1,
                'created_at' => '2019-08-29 09:35:18',
                'updated_at' => '2019-08-29 09:35:18',
            ),
        ));
        
        
    }
}