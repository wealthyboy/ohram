<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderedProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordered_product', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned()->nullable();
            $table->integer('quantity')->unsigned()->nullable();
			$table->string('total');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('product_variations')->onDelete('cascade');
            $table->timestamps();
            //ordered_product_product_variation_id_foreign
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordered_product');
    }
}
