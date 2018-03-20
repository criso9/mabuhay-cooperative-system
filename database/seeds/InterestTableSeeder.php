<?php

use Illuminate\Database\Seeder;

class InterestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('interest')->insert([
            ['type' => 'Member', 'rate' => '2'],
            ['type' => 'Non-member', 'rate' => '10'],
        ]);
    }
}
