<?php

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
            $table->string('name');
            $table->string('username', 60);
            $table->string('password', 60);
            $table->tinyInteger('level');
            $table->string('email')->unique();
            $table->string('phone',100);
            $table->string('gender', 11);   
            $table->string('address',255);
            $table->rememberToken();
            $table->timestamps('password_updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
