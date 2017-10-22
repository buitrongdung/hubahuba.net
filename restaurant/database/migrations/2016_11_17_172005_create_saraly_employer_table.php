<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaralyEmployerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saraly_employer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employer_id');
            $table->integer('saraly_id');
            $table->integer('ngay_cong');
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
        Schema::drop('saraly_employer');
    }
}
