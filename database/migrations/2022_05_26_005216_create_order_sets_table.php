<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_sets', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->dateTime('order_datetime');
            $table->foreignId('state_id')->references('id')->on('states');
            $table->string('payment_type', 50);
            $table->text('delivery_address');
            $table->integer('order_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_sets');
    }
};
