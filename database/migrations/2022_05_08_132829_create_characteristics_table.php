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
        Schema::create('characteristics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('set_id')->references('id')->on('feature_sets');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->integer('valueint')->nullable();
            $table->string('valuestr')->nullable();
            $table->decimal('valuedec')->nullable();
            $table->dateTime('valuedate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characteristics');
    }
};
