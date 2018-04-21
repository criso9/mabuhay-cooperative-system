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
            'f_name' => 'Carissa',
            'l_name' => 'Navarroza',
            'phone' => '12345',
            'address' => 'taguig city',
            'b_date' => '1995-11-15',
            'gender' => 'female',
            'civil_status' => 'single',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'avatar' => 'user-female.png',
            'status' => 'active',
            'role_id' => '1',
            'referral' => 'marites',
            'ref_relation' => 'mother',
            'activated_at' => '2018-03-24 01:34:36',
        ]);

        DB::table('users')->insert([
            'f_name' => 'Claudine',
            'l_name' => 'Marfil',
            'phone' => '12345',
            'address' => 'taguig city',
            'b_date' => '1996-04-13',
            'gender' => 'female',
            'civil_status' => 'single',
            'email' => 'claud@gmail.com',
            'password' => bcrypt('12345678'),
            'avatar' => 'user-female.png',
            'status' => 'active',
            'role_id' => '1',
            'activated_at' => '2018-03-24 01:34:36',
        ]);

        DB::table('users')->insert([
            'f_name' => 'Donna',
            'l_name' => 'Vinculado',
            'phone' => '12345',
            'address' => 'taguig city',
            'b_date' => '1990-05-15',
            'gender' => 'female',
            'civil_status' => 'single',
            'email' => 'donna@gmail.com',
            'password' => bcrypt('12345678'),
            'avatar' => 'user-female.png',
            'status' => 'active',
            'role_id' => '3',
            'reviewed_by' => '1',
            'reviewed_at' => '2018-03-24 01:34:36',
            'referral' => 'marites',
            'ref_relation' => 'relative',
            'activated_at' => '2018-03-24 01:34:36',
        ]);

        DB::table('users')->insert([
            'f_name' => 'Mikko',
            'l_name' => 'Piccio',
            'phone' => '12345',
            'address' => 'taguig city',
            'b_date' => '1990-05-15',
            'gender' => 'male',
            'civil_status' => 'single',
            'email' => 'mikko@gmail.com',
            'password' => bcrypt('12345678'),
            'avatar' => 'user-male.png',
            'status' => 'active',
            'role_id' => '3',
            'reviewed_by' => '1',
            'reviewed_at' => '2018-03-24 01:34:36',
            'activated_at' => '2018-03-24 01:34:36',
        ]);

        DB::table('users')->insert([
            'f_name' => 'Reynaldo',
            'l_name' => 'Ranuco Sr.',
            'phone' => '12345',
            'address' => 'taguig city',
            'b_date' => '1990-05-15',
            'gender' => 'male',
            'civil_status' => 'single',
            'email' => 'reynaldo@gmail.com',
            'password' => bcrypt('12345678'),
            'avatar' => 'user-male.png',
            'status' => 'active',
            'role_id' => '3',
            'reviewed_by' => '1',
            'reviewed_at' => '2018-03-24 01:34:36',
            'activated_at' => '2018-03-24 01:34:36',
        ]);

        DB::table('users')->insert([
            'f_name' => 'Lucena',
            'l_name' => 'Piccio',
            'phone' => '12345',
            'address' => 'taguig city',
            'b_date' => '1990-05-15',
            'gender' => 'female',
            'civil_status' => 'single',
            'email' => 'lucena@gmail.com',
            'password' => bcrypt('12345678'),
            'avatar' => 'user-female.png',
            'status' => 'active',
            'role_id' => '3',
            'reviewed_by' => '1',
            'reviewed_at' => '2018-03-24 01:34:36',
            'activated_at' => '2018-03-24 01:34:36',
        ]);

        DB::table('users')->insert([
            'f_name' => 'Maria Teresa',
            'l_name' => 'Navarroza',
            'phone' => '12345',
            'address' => 'taguig city',
            'b_date' => '1990-05-15',
            'gender' => 'female',
            'civil_status' => 'single',
            'email' => 'marites@gmail.com',
            'password' => bcrypt('12345678'),
            'avatar' => 'user-female.png',
            'status' => 'active',
            'role_id' => '3',
            'reviewed_by' => '1',
            'reviewed_at' => '2018-03-24 01:34:36',
            'activated_at' => '2018-03-24 01:34:36',
        ]);

        DB::table('users')->insert([
            'f_name' => 'Melodina',
            'l_name' => 'Vales',
            'phone' => '12345',
            'address' => 'taguig city',
            'b_date' => '1990-05-15',
            'gender' => 'female',
            'civil_status' => 'single',
            'email' => 'melodina@gmail.com',
            'password' => bcrypt('12345678'),
            'avatar' => 'user-female.png',
            'status' => 'active',
            'role_id' => '3',
            'reviewed_by' => '1',
            'reviewed_at' => '2018-03-24 01:34:36',
            'activated_at' => '2018-03-24 01:34:36',
        ]);

        DB::table('users')->insert([
            'f_name' => 'Roserea',
            'l_name' => 'Vales',
            'phone' => '12345',
            'address' => 'taguig city',
            'b_date' => '1990-05-15',
            'gender' => 'female',
            'civil_status' => 'single',
            'email' => 'roserea@gmail.com',
            'password' => bcrypt('12345678'),
            'avatar' => 'user-female.png',
            'status' => 'active',
            'role_id' => '3',
            'reviewed_by' => '1',
            'reviewed_at' => '2018-03-24 01:34:36',
            'activated_at' => '2018-03-24 01:34:36',
        ]);

        DB::table('users')->insert([
            'f_name' => 'Virgenia',
            'l_name' => 'Lor',
            'phone' => '12345',
            'address' => 'taguig city',
            'b_date' => '1990-05-15',
            'gender' => 'female',
            'civil_status' => 'single',
            'email' => 'virgenia@gmail.com',
            'password' => bcrypt('12345678'),
            'avatar' => 'user-female.png',
            'status' => 'active',
            'role_id' => '3',
            'reviewed_by' => '1',
            'reviewed_at' => '2018-03-24 01:34:36',
            'activated_at' => '2018-03-24 01:34:36',
        ]);

        DB::table('users')->insert([
            'f_name' => 'Cindy',
            'l_name' => 'Navarroza',
            'phone' => '12345',
            'address' => 'taguig city',
            'b_date' => '1990-05-15',
            'gender' => 'female',
            'civil_status' => 'single',
            'email' => 'cindy@gmail.com',
            'password' => bcrypt('12345678'),
            'avatar' => 'user-female.png',
            'status' => 'active',
            'role_id' => '3',
            'reviewed_by' => '1',
            'reviewed_at' => '2018-03-24 01:34:36',
            'activated_at' => '2018-03-24 01:34:36',
        ]);

        DB::table('users')->insert([
            'f_name' => 'Nilo',
            'l_name' => 'Vales',
            'phone' => '12345',
            'address' => 'taguig city',
            'b_date' => '1990-05-15',
            'gender' => 'male',
            'civil_status' => 'single',
            'email' => 'nilo@gmail.com',
            'password' => bcrypt('12345678'),
            'avatar' => 'user-male.png',
            'status' => 'active',
            'role_id' => '3',
            'reviewed_by' => '1',
            'reviewed_at' => '2018-03-24 01:34:36',
            'activated_at' => '2018-03-24 01:34:36',
        ]);

        DB::table('users')->insert([
            'f_name' => 'Demetria',
            'l_name' => 'Ziganay',
            'phone' => '12345',
            'address' => 'taguig city',
            'b_date' => '1990-05-15',
            'gender' => 'female',
            'civil_status' => 'single',
            'email' => 'demetria@gmail.com',
            'password' => bcrypt('12345678'),
            'avatar' => 'user-female.png',
            'status' => 'active',
            'role_id' => '3',
            'reviewed_by' => '1',
            'reviewed_at' => '2018-03-24 01:34:36',
            'activated_at' => '2018-03-24 01:34:36',
        ]);

        DB::table('users')->insert([
            'f_name' => 'Florenciano',
            'l_name' => 'Zarco',
            'phone' => '12345',
            'address' => 'taguig city',
            'b_date' => '1990-05-15',
            'gender' => 'male',
            'civil_status' => 'single',
            'email' => 'florenciano@gmail.com',
            'password' => bcrypt('12345678'),
            'avatar' => 'user-male.png',
            'status' => 'active',
            'role_id' => '3',
            'reviewed_by' => '1',
            'reviewed_at' => '2018-03-24 01:34:36',
            'activated_at' => '2018-03-24 01:34:36',
        ]);

        DB::table('users')->insert([
            'f_name' => 'Rodolfo',
            'l_name' => 'Lamadora',
            'phone' => '12345',
            'address' => 'taguig city',
            'b_date' => '1990-05-15',
            'gender' => 'male',
            'civil_status' => 'single',
            'email' => 'rodolfo@gmail.com',
            'password' => bcrypt('12345678'),
            'avatar' => 'user-male.png',
            'status' => 'active',
            'role_id' => '3',
            'reviewed_by' => '1',
            'reviewed_at' => '2018-03-24 01:34:36',
            'activated_at' => '2018-03-24 01:34:36',
        ]);

        DB::table('users')->insert([
            'f_name' => 'Miraflor',
            'l_name' => 'Balderama',
            'phone' => '12345',
            'address' => 'taguig city',
            'b_date' => '1990-05-15',
            'gender' => 'female',
            'civil_status' => 'single',
            'email' => 'miraflor@gmail.com',
            'password' => bcrypt('12345678'),
            'avatar' => 'user-female.png',
            'status' => 'Active',
            'role_id' => '3',
            'reviewed_by' => '1',
            'reviewed_at' => '2018-03-24 01:34:36',
            'activated_at' => '2018-03-24 01:34:36',
        ]);

    }
}
