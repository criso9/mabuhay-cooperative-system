<?php

use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            ['payment' => 'Monthly Contribution'],
            ['payment' => 'Damayan'],
            ['payment' => 'Share Capital']
        ]);
    }
}
