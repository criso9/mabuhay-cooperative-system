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
            $table->String('type');
            $table->String('loan_type');
            $table->float('amount_loan');
            $table->float('amount_repayable')->default(0);
            $table->float('amount_paid')->default(0);
            $table->float('interest_amount')->default(0);
            $table->float('interest_amount_paid')->default(0);
            $table->float('scapital_amount')->default(0);
            $table->float('scapital_amount_paid')->default(0);
            $table->float('remaining_balance')->default(0);
            $table->dateTime('due_date')->nullable();
            $table->bigInteger('reviewed_by')->unsigned()->nullable();
            $table->dateTime('reviewed_at')->nullable();
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
