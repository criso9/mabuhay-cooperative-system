<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unsigned();
            $table->String('transaction_no')->unique();
            $table->String('status');
            $table->dateTime('date_applied');
            $table->float('amount_loan');
            $table->float('amount_paid')->nullable();
            $table->float('remaining_balance')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->bigInteger('reviewed_by')->unsigned()->nullable();
            $table->bigInteger('reviewed_at')->unsigned()->nullable();
            $table->String('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
