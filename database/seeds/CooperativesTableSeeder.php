<?php

use Illuminate\Database\Seeder;

class CooperativesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cooperatives')->insert([
            'coop_name' => '',
            'logo' => 'na.png',
            'icon' => '',
            'mission' => '',
            'vision' => '',
            'date_founded' => '',
            'mem_int' => 0.00,
            'nonmem_int' => 0.00,
        ]);
    }
}
