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
        Schema::create('refrigerators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->references('id')->on('products');
            $table->string('cameras', 50);
            $table->string('freezer_location');
            $table->integer('doors');
            $table->integer('volume(l)');
            $table->integer('noise_level(dB)');
            $table->integer('shelves');
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
        Schema::dropIfExists('refrigerators');
    }
};
