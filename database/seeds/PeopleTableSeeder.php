<?php

use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('people')->delete();
        
        \DB::table('people')->insert(array (
            0 => 
            array (
                'id' => 15,
                'name' => 'Nguyễn Minh Dũng',
                'user_id' => 35,
                'facebook' => NULL,
                'note' => NULL,
                'position' => NULL,
                'phone' => '0981304093',
                'birthday' => NULL,
                'email' => 'nm.dung.1991@gmail.com',
                'skype' => NULL,
                'status' => 1,
                'created_at' => '2020-02-18 04:17:02',
                'updated_at' => '2020-02-18 04:17:02',
            ),
            1 => 
            array (
                'id' => 16,
                'name' => 'Nguyen Long',
                'user_id' => 37,
                'facebook' => 'dragon',
                'note' => 'abc',
                'position' => 'director',
                'phone' => '1122344',
                'birthday' => '10/10/1984',
                'email' => 'long.nguyen@gmail.com',
                'skype' => 'dragon',
                'status' => 1,
                'created_at' => '2020-02-19 04:03:27',
                'updated_at' => '2020-02-19 04:03:27',
            ),
            2 => 
            array (
                'id' => 17,
                'name' => 'Hoa Phung',
                'user_id' => 42,
                'facebook' => 'hoa phung',
                'note' => NULL,
                'position' => 'PGĐ',
                'phone' => '0976177801',
                'birthday' => NULL,
                'email' => 'info@nhatanh.vn',
                'skype' => 'hoaphung',
                'status' => 1,
                'created_at' => '2020-02-21 06:19:42',
                'updated_at' => '2020-02-21 06:19:42',
            ),
            3 => 
            array (
                'id' => 18,
                'name' => 'Ms Hanh',
                'user_id' => 43,
                'facebook' => 'maihuuhanh',
                'note' => NULL,
                'position' => 'Giám đốc',
                'phone' => '0999999999',
                'birthday' => '1976/01/20',
                'email' => 'info@efa.vn',
                'skype' => 'maihuuhanh',
                'status' => 1,
                'created_at' => '2020-02-21 06:37:27',
                'updated_at' => '2020-02-21 06:37:27',
            ),
            4 => 
            array (
                'id' => 19,
                'name' => 'Nhiem',
                'user_id' => 44,
                'facebook' => NULL,
                'note' => NULL,
                'position' => 'director',
                'phone' => '112233',
                'birthday' => '10/10/1990',
                'email' => 'nhiemtnt',
                'skype' => 'abc',
                'status' => 1,
                'created_at' => '2020-02-21 09:11:58',
                'updated_at' => '2020-02-21 09:11:58',
            ),
            5 => 
            array (
                'id' => 20,
                'name' => 'Mr A',
                'user_id' => 45,
                'facebook' => NULL,
                'note' => NULL,
                'position' => 'director',
                'phone' => '989',
                'birthday' => '01/01/2020',
                'email' => 'abc@gmail.com',
                'skype' => 'abcsye',
                'status' => 1,
                'created_at' => '2020-02-21 18:25:02',
                'updated_at' => '2020-02-21 18:25:02',
            ),
            6 => 
            array (
                'id' => 21,
                'name' => 'Ms B',
                'user_id' => 45,
                'facebook' => NULL,
                'note' => NULL,
                'position' => 'admin',
                'phone' => '83023',
                'birthday' => 'fsafafsd',
                'email' => 'fsafdaf',
                'skype' => 'fafdasf',
                'status' => 1,
                'created_at' => '2020-02-21 18:25:02',
                'updated_at' => '2020-02-21 18:25:02',
            ),
            7 => 
            array (
                'id' => 22,
                'name' => 'Anvil',
                'user_id' => 46,
                'facebook' => NULL,
                'note' => NULL,
                'position' => 'Director',
                'phone' => '958472757',
                'birthday' => NULL,
                'email' => 'email@gmail.com',
                'skype' => NULL,
                'status' => 1,
                'created_at' => '2020-02-22 03:20:13',
                'updated_at' => '2020-02-22 03:20:13',
            ),
            8 => 
            array (
                'id' => 23,
                'name' => 'Catherina',
                'user_id' => 47,
                'facebook' => NULL,
                'note' => NULL,
                'position' => 'Director',
                'phone' => '049485947592340',
                'birthday' => NULL,
                'email' => 'catherina@gmail.com',
                'skype' => NULL,
                'status' => 1,
                'created_at' => '2020-02-22 03:28:09',
                'updated_at' => '2020-02-22 03:28:09',
            ),
            9 => 
            array (
                'id' => 24,
                'name' => 'Emily',
                'user_id' => 47,
                'facebook' => NULL,
                'note' => NULL,
                'position' => 'Manager',
                'phone' => '04759406',
                'birthday' => NULL,
                'email' => 'emily@gmail.com',
                'skype' => NULL,
                'status' => 1,
                'created_at' => '2020-02-22 03:28:09',
                'updated_at' => '2020-02-22 03:28:09',
            ),
            10 => 
            array (
                'id' => 25,
                'name' => 'Catherina',
                'user_id' => 47,
                'facebook' => NULL,
                'note' => NULL,
                'position' => 'Director',
                'phone' => '04759358',
                'birthday' => NULL,
                'email' => 'catherina@gmail.com',
                'skype' => NULL,
                'status' => 1,
                'created_at' => '2020-02-22 03:28:09',
                'updated_at' => '2020-02-22 03:28:09',
            ),
            11 => 
            array (
                'id' => 26,
                'name' => 'Anh Huy',
                'user_id' => 52,
                'facebook' => NULL,
                'note' => NULL,
                'position' => 'DIRECTOR',
                'phone' => '09555555',
                'birthday' => NULL,
                'email' => 'harry.le@ags-study.com',
                'skype' => NULL,
                'status' => 1,
                'created_at' => '2020-09-22 15:19:13',
                'updated_at' => '2020-09-22 15:19:13',
            ),
        ));
        
        
    }
}