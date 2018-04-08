<?php

use Illuminate\Database\Seeder;

class LoansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('loans')->insert([
            'user_id' => '2',
            'transaction_no' => '20170329-11180000-1',
            'status' => 'Pending',
            'date_applied' => '2018-10-13 22:31:52',
            'amount_loan' => '1000',
        ]);

        DB::table('loans')->insert([
            'user_id' => '2',
            'transaction_no' => '20170329-11180001-2',
            'status' => 'Active',
            'date_applied' => '2018-10-13 22:31:52',
            'amount_loan' => '1000',
        ]);
    }
}
