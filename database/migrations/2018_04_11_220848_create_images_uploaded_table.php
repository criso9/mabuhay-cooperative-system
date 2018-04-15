<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesUploadedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images_uploaded', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('type_id')->unsigned();
            $table->String('status');
            $table->String('path');
            $table->String('url');
            $table->bigInteger('added_by')->unsigned();
            $table->dateTime('added_at');
            $table->bigInteger('removed_by')->unsigned()->nullable();
            $table->dateTime('removed_at')->nullable();
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
        Schema::dropIfExists('images_uploaded');
    }
}
