<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('positions')->insert([
            ['position' => 'President', 'type' => 'individual'],
            ['position' => 'Vice President', 'type' => 'individual'],
            ['position' => 'Secretary', 'type' => 'individual'],
            ['position' => 'Treasurer', 'type' => 'individual'],
            ['position' => 'Asst. Treasurer', 'type' => 'individual'],
            ['position' => 'Auditor', 'type' => 'individual'],
            ['position' => 'PIO', 'type' => 'individual'],
            ['position' => 'Sgt./Arms', 'type' => 'individual'],
            ['position' => 'Chairman of the Board', 'type' => 'individual'],
            ['position' => 'Board Members', 'type' => 'group'],
        ]);
    }
}
