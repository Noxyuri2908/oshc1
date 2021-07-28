<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 37,
                'name' => 'Agent2',
                'email' => 'agent2@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$T9L3Py7opyRSdW7Y1fcnzuF7.13ZfWgUQncEfcEZ8BTW7Mpxv2VA6',
                'created_by' => 8,
                'status' => 3,
                'staff_id' => 8,
                'shares' => NULL,
                'remember_token' => NULL,
                'created_at' => '2020-02-19 04:03:27',
                'updated_at' => '2020-12-30 19:58:42',
                'is_default' => 1,
                'had_case' => 260,
                'first_case_date' => '2020-11-12',
            ),
            1 => 
            array (
                'id' => 38,
                'name' => 'ABC',
                'email' => 'abc@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$M7zp26p3O2xWxTmJfyUhWu2m5NA5y2KtEpShegvz1pItLEUV/56Jq',
                'created_by' => 1,
                'status' => 4,
                'staff_id' => 1,
                'shares' => NULL,
                'remember_token' => NULL,
                'created_at' => '2020-02-19 15:27:44',
                'updated_at' => '2020-02-19 15:27:44',
                'is_default' => NULL,
                'had_case' => NULL,
                'first_case_date' => NULL,
            ),
            2 => 
            array (
                'id' => 39,
                'name' => 'VIP',
                'email' => 'vip@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$4O2zXE4CQFi0gq.6vhBK1eSr/12ug4AQS2L04f1hvSO.Uh.PDVMN.',
                'created_by' => 1,
                'status' => 4,
                'staff_id' => 1,
                'shares' => NULL,
                'remember_token' => NULL,
                'created_at' => '2020-02-20 09:10:15',
                'updated_at' => '2020-02-20 09:10:15',
                'is_default' => NULL,
                'had_case' => NULL,
                'first_case_date' => NULL,
            ),
            3 => 
            array (
                'id' => 42,
                'name' => 'NHAT ANH',
                'email' => 'info@nhatanh.vn',
                'email_verified_at' => NULL,
                'password' => '$2y$10$McXdmVVBOGDZDQCaYkMgUu7Q9Emv1fudvdLamt4vjwXtqzLideuv2',
                'created_by' => 1,
                'status' => 4,
                'staff_id' => 1,
                'shares' => NULL,
                'remember_token' => NULL,
                'created_at' => '2020-02-21 06:19:42',
                'updated_at' => '2020-02-21 06:19:42',
                'is_default' => NULL,
                'had_case' => NULL,
                'first_case_date' => NULL,
            ),
            4 => 
            array (
                'id' => 44,
                'name' => 'TNT-HCM',
                'email' => 'tnt@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$.m6rSvYvPpkCy6Eo734BVuG6rLoH/TCAvaVDRn7cCzQ6jxE1tzTsm',
                'created_by' => 1,
                'status' => 1,
                'staff_id' => 1,
                'shares' => NULL,
                'remember_token' => NULL,
                'created_at' => '2020-02-21 09:11:58',
                'updated_at' => '2020-02-21 09:11:58',
                'is_default' => NULL,
                'had_case' => NULL,
                'first_case_date' => NULL,
            ),
            5 => 
            array (
                'id' => 47,
                'name' => 'study@ko-oz.com',
                'email' => 'study@ko-oz.com.au',
                'email_verified_at' => NULL,
                'password' => '$2y$10$RKrPtOR4NE.MrUZjASflHuUR.zGMmYK5Mh5rEk2xfWH9UlPJPwm1W',
                'created_by' => 1,
                'status' => 4,
                'staff_id' => 1,
                'shares' => NULL,
                'remember_token' => NULL,
                'created_at' => '2020-02-22 03:28:09',
                'updated_at' => '2020-02-22 03:28:09',
                'is_default' => NULL,
                'had_case' => NULL,
                'first_case_date' => NULL,
            ),
            6 => 
            array (
                'id' => 49,
                'name' => 'Edunetwork Sydney',
                'email' => 'abc1@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$cbi8wRSa2AVrKKa8Tt1cU.a6oDxAdguELZ1nQMkOAH09AMEKHOsp2',
                'created_by' => 1,
                'status' => 4,
                'staff_id' => 1,
                'shares' => NULL,
                'remember_token' => NULL,
                'created_at' => '2020-09-19 17:42:04',
                'updated_at' => '2020-09-19 17:42:04',
                'is_default' => NULL,
                'had_case' => NULL,
                'first_case_date' => NULL,
            ),
            7 => 
            array (
                'id' => 50,
                'name' => 'Edunetwork HCM',
                'email' => 'abc2@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$xqTMe3Aozr9OdtuuxSkGO.P/HL5AoPRI2/MzLQuN/ZbSts2HaTGau',
                'created_by' => 1,
                'status' => 4,
                'staff_id' => 1,
                'shares' => NULL,
                'remember_token' => NULL,
                'created_at' => '2020-09-19 17:55:49',
                'updated_at' => '2020-09-19 17:55:49',
                'is_default' => NULL,
                'had_case' => NULL,
                'first_case_date' => NULL,
            ),
            8 => 
            array (
                'id' => 51,
                'name' => 'Just Australia Pty Ltd',
                'email' => 'info@justaustralia.it',
                'email_verified_at' => NULL,
                'password' => '$2y$10$43cNmBFlj9DJwm6aigMxAOzPg7T5EWanxzOd6JuaRI/CzhoyzkAzq',
                'created_by' => 1,
                'status' => 4,
                'staff_id' => NULL,
                'shares' => NULL,
                'remember_token' => NULL,
                'created_at' => '2020-09-22 15:06:34',
                'updated_at' => '2020-09-22 15:06:34',
                'is_default' => NULL,
                'had_case' => NULL,
                'first_case_date' => NULL,
            ),
            9 => 
            array (
                'id' => 52,
            'name' => 'AGS-HCM(PSC)',
                'email' => 'harry.le@ags-study.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$nYwz3r.usNeR8yHzmm40Zee03l4yA6WnYlX3zRlAKeVjRmPrSHvO2',
                'created_by' => 1,
                'status' => 4,
                'staff_id' => NULL,
                'shares' => NULL,
                'remember_token' => NULL,
                'created_at' => '2020-09-22 15:19:12',
                'updated_at' => '2020-09-22 15:19:12',
                'is_default' => NULL,
                'had_case' => NULL,
                'first_case_date' => NULL,
            ),
        ));
        
        
    }
}