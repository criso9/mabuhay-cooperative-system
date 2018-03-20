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
            'name' => 'Mabuhay BNHS Cooperative',
            'logo' => 'logo/logo-20180222-144417.png',
            'icon' => 'icon/icon.ico',
            'mission' => 'taguig city',
            'vision' => '1995-11-15',
            'date_founded' => '2014-05-01',
        ]);
    }
}
