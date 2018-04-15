<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCooperativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cooperatives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('coop_name', 100);
            $table->string('logo', 50);
            $table->string('icon', 50);
            $table->string('mission', 500)->nullable();
            $table->string('vision', 500)->nullable();
            $table->date('date_founded');
            $table->decimal('mem_int', 5, 2);
            $table->decimal('nonmem_int', 5, 2);
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
        Schema::dropIfExists('cooperatives');
    }
}
