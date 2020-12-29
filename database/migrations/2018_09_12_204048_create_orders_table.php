<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('address_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->string('invoice');
			
			$table->string('comment')->nullable();
			$table->string('tracking')->nullable();
			$table->string('payment_type')->nullable();
			$table->string('status')->nullable();
			$table->string('transaction_id')->nullable();
			$table->integer('currency_id')->length(10);
			$table->string('total')->nullable();
			$table->string('coupon')->unique()->nullable();
			$table->string('order_type')->nullable();
			$table->string('order_from')->nullable();
			$table->string('ip')->nullable();
			$table->string('user_agent')->nullable();
			
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
        Schema::dropIfExists('orders');
    }
}
