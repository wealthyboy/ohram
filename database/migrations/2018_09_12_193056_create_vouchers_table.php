<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned();;
                $table->string('code')->unique();
                $table->string('amount');
                $table->integer('from_value')->length(11)->nullable();
                $table->boolean('status')->default(false);
                $table->boolean('valid')->default(true);
                $table->integer('category_id')->unsigned()->nullable();
                $table->integer('product_id')->unsigned()->nullable();
                $table->integer('product_variation_id')->unsigned()->nullable();
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
                $table->string('type')->nullable();
                $table->timestamp('expires')->nullable(); 
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
        Schema::dropIfExists('vouchers');
    }
}
