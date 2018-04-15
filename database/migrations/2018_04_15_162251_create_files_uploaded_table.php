<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesUploadedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files_uploaded', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('type_id')->unsigned();
            $table->String('status');
            $table->String('orig_file_name');
            $table->String('file_name');
            $table->String('path');
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
        Schema::dropIfExists('files_uploaded');
    }
}
