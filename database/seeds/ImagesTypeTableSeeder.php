<?php

use Illuminate\Database\Seeder;

class ImagesTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images_type')->insert([
            ['type' => 'carousel'],
            ['type' => 'about_us'],
            ['type' => 'services'],
        ]);
    }
}
