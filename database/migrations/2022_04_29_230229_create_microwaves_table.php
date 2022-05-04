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
        Schema::create('microwaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->references('id')->on('products');
            $table->integer('volume');
            $table->integer('power');
            $table->string('control_type', 50);
            $table->string('door_opening', 50);
            $table->string('inner_lining', 50);
            $table->integer('turntable_diameter');
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
        Schema::dropIfExists('microwaves');
    }
};
