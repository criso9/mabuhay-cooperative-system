<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->increments('id');
            $table->String('name');
            $table->String('description');
            $table->String('status');
            $table->float('capital');
            $table->float('interest')->nullable();
            $table->date('date_started');
            $table->bigInteger('added_by')->unsigned();
            $table->date('date_ended')->nullable();
            $table->bigInteger('removed_by')->unsigned()->nullable();
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
        Schema::dropIfExists('businesses');
    }
}
