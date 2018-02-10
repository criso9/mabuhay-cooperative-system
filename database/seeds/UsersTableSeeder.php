<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'f_name' => 'carissa',
            'l_name' => 'navarroza',
            'phone' => '12345',
            'address' => 'taguig city',
            'b_date' => '11/15/1995',
            'gender' => 'female',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret'),
            'avatar' => 'user-female.png',
            'status' => 'active',
            'role_id' => '1',
            'referral' => 'marites',
            'ref_relation' => 'mother',
        ]);

        DB::table('users')->insert([
            'f_name' => 'donna',
            'l_name' => 'vinculado',
            'phone' => '12345',
            'address' => 'taguig city',
            'b_date' => '05/15/1990',
            'gender' => 'female',
            'email' => 'donna@gmail.com',
            'password' => bcrypt('secret'),
            'avatar' => 'user-female.png',
            'status' => 'active',
            'role_id' => '3',
            'referral' => 'marites',
            'ref_relation' => 'relative',
        ]);

        DB::table('users')->insert([
            'f_name' => 'mikko',
            'l_name' => 'piccio',
            'phone' => '12345',
            'address' => 'taguig city',
            'b_date' => '03/10/1990',
            'gender' => 'male',
            'email' => 'mikko@gmail.com',
            'password' => bcrypt('secret'),
            'avatar' => 'user-male.png',
            'status' => 'active',
            'role_id' => '3',
            'referral' => 'cena',
            'ref_relation' => 'mother',
        ]);
    }
}
