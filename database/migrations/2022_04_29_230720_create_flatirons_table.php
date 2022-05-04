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
        Schema::create('flatirons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->references('id')->on('products');
            $table->integer('power(Wt)');
            $table->string('steam_function', 50);
            $table->integer('water_tank(ml)');
            $table->string('iron_soleplate');
            $table->string('color', 50);
            $table->decimal('weight(kg)');
            $table->integer('warranty(m)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flatirons');
    }
};