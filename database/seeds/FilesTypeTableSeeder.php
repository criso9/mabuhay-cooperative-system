<?php

use Illuminate\Database\Seeder;

class FilesTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('files_type')->insert([
            ['type' => 'policies'],
            ['type' => 'minutes'],
            ['type' => 'others'],
        ]);
    }
}
