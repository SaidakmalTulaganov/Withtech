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
            $table->integer('volume');
            $table->integer('noise_level');
            $table->integer('shelves');
            $table->string('color', 50);
            $table->decimal('weight');
            $table->integer('warranty');
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
