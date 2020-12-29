<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->increments('id');
			$table->string('store_name');
			$table->string('address');
			$table->string('store_email');
			$table->string('store_phone')->nullable();
			$table->string('image')->nullable();
			$table->string('opening_times')->nullable();
			$table->string('meta_title')->nullable();
			$table->text('meta_description')->nullable();
			$table->text('meta_tag_keywords')->nullable();
			$table->integer('products_items_per_page')->length(11);
			$table->string('alert_email');
			$table->string('order_status')->nullable();
			$table->string('invoice_prefix')->nullable();
            $table->string('s_h_o_l')->nullable();
            $table->string('s_h_w_l')->nullable();

            $table->string('facebook_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('youtube_link')->nullable();


			$table->string('store_logo',100);
			$table->string('store_icon',100)->nullable();
			$table->integer('products_items_size_h')->length(11)->nullable();
			$table->integer('products_items_size_w')->length(11)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_settings');
    }
}
