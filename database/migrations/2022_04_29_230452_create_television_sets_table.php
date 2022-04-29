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
        Schema::create('television_sets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->references('id')->on('products');
            $table->decimal('diagonal(inch)');
            $table->string('screen_resolution', 50);
            $table->string('screen_format', 50);
            $table->string('panel_type');
            $table->integer('update_frequency(Hz)');
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
        Schema::dropIfExists('television_sets');
    }
};
