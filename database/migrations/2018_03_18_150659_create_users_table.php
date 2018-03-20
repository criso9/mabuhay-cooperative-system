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
            $table->string('f_name');
            $table->string('l_name');
            $table->string('m_name')->nullable();
            $table->string('phone');
            $table->string('address');
            $table->date('b_date');
            $table->string('gender');
            $table->string('civil_status');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('referral')->nullable();
            $table->string('ref_relation')->nullable();
            $table->string('avatar');
            $table->string('status');
            $table->string('role_id');
            $table->bigInteger('reviewed_by')->unsigned()->nullable();
            $table->string('remarks')->nullable();
            $table->dateTime('reviewed_at')->nullable();
            $table->dateTime('activated_at')->nullable();
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