<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variation_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('attribute_parent_id')->nullable();
            $table->integer('attribute_id')->unsigned()->nullable();
            $table->integer('product_variation_id')->unsigned()->nullable();
            $table->integer('name')->unsigned()->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign('product_variation_id')->references('id')->on('product_variations')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variation_values');
    }
}
