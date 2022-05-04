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
        Schema::create('air_conditioners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->references('id')->on('products');
            $table->text('operating_modes');
            $table->string('installation_type', 50);
            $table->decimal('cooling_capacity');
            $table->decimal('heating_capacity');
            $table->integer('served_area');
            $table->integer('pipeline_length');
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
        Schema::dropIfExists('air_conditioners');
    }
};
