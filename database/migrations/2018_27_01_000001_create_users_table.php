<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('na');
            // $table->string('email')->unique();
            $table->string('password');
            $table->string('role_id');
            $table->string('f_name');
            $table->string('emailadd')->unique();
            $table->string('cnumber');
            $table->string('bday');
            $table->string('age');
            $table->string('civilstats');
            $table->string('bplace');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
