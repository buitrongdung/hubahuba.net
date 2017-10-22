<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('order_items', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('order_id');
        //     $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        //     $table->integer('combo_id');
        //     $table->integer('amount');
        //     $table->integer('into_money');
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
        Schema::drop('order_items');
    }
}
