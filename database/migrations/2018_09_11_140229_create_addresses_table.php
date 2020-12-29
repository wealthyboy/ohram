<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->integer('user_id')->unsigned();
			$table->string('last_name');
			$table->string('address');
			$table->string('address_2')->nullable();
			$table->string('city');
			$table->integer('state_id')->nullable();
		    $table->string('postcode')->nullable();
			$table->string('country')->nullable();
			$table->boolean('default_add')->nullable();
			$table->boolean('bill_add')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
