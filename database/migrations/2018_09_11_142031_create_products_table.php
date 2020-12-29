<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        if(!Schema::hasTable('products'))
        {
            
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name')->nullable();
            $table->string('slug')->nullable();
            $table->decimal('price');
            $table->integer('brand_id')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('height')->nullable();
            $table->integer('width')->nullable();
            $table->integer('length')->nullable();
            $table->text('description')->nullable();
            $table->decimal('total');
            $table->integer('sale_price')->nullable();
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->integer('quantity');
            $table->boolean('allow')->default(true);
            $table->boolean('featured')->default(false);
            $table->boolean('has_variants')->default(false);

            $table->timestamps();
            $table->softDeletes();
        });


        }
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
}
