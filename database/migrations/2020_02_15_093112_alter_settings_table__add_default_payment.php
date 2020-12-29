<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSettingsTableAddDefaultPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('system_settings', function (Blueprint $table) {
            $table->integer("payment_id")->nullable();
            $table->integer("customer_currency_id")->nullable();
            $table->integer("currency_id")->nullable();
            $table->boolean("location_aware")->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('system_settings', function (Blueprint $table) {
            $table->dropColumn("payment_id");
            $table->dropColumn("customer_currency_id");
            $table->dropColumn("currency_id");
            $table->dropColumn("location_aware");
        });
    }
}
