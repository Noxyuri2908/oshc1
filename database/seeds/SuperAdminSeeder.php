<?php

use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admins')->where('username','Admin')->delete();
        DB::table('admins')->insert([
            'username' => 'Admin',
            'email' => 'admin@admin.com',
            'role' => '1',
            'status' => 1,
            'password' => bcrypt('oshc@123'),
        ]);

    }
}
