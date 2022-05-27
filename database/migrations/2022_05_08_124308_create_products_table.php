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
        Schema::create('products', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->foreignId('manufacturer_id')->references('id')->on('manufacturers');
            $table->string('product_title', 50)->unique();
            $table->integer('bonus_pencent');
            $table->text('description')->nullable();
            $table->string('product_image', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
