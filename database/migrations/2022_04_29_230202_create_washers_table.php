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
        Schema::create('washers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->references('id')->on('products');
            $table->char('wash_class');
            $table->char('spin_class');
            $table->string('drum_material', 50);
            $table->decimal('maximum_load(kg)');
            $table->integer('spin_speed(rpm)');
            $table->integer('water_consumption(l)');
            $table->integer('drum_volume(l)');
            $table->integer('number_programs');
            $table->text('programs');
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
        Schema::dropIfExists('washers');
    }
};
