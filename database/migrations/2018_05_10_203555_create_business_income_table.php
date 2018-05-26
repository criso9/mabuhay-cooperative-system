<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessIncomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_incomes', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('business_id')->unsigned();
            $table->float('amount');
            $table->dateTime('date_paid');
            $table->string('updated_by', 100);
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
        Schema::dropIfExists('business_incomes');
    }
}
