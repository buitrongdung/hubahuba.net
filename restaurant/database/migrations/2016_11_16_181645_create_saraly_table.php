<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaralyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('saraly', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('id_type_employer');
        //     $table->foreign('id_type_employer')->references('id_employer')->on('type_employer');
        //     $table->integer('ngay_cong');
        //     $table->integer('luong_co_ban');
        //     $table->integer('phu_cap');
        //     $table->integer('khoan_tru');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('saraly');
    }
}
