<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id')->unsigned()->nullable();
			$table->integer('product_variation_id')->nullable();
			$table->decimal('price',12,2)->nullable();
			$table->string('total')->nullable();
			$table->integer('quantity')->length(11);            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->rememberToken(255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
