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
        Schema::create('vacuum_cleaners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->references('id')->on('products');
            $table->string('cleaning_type');
            $table->decimal('container_volume');
            $table->integer('power');
            $table->integer('cord_length');
            $table->string('nozzles_included');
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
        Schema::dropIfExists('vacuum_cleaners');
    }
};
