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
        Schema::table('rental_offers', function (Blueprint $table) {
            $table->string('title');
            $table->dateTime('moving_date')->nullable();
            $table->double('rent_amount',9,2)->nullable();
            $table->string('address')->nullable();
            $table->dateTime('availability_date')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rental_offers', function (Blueprint $table) {
            $table->dropForeign('rental_offers_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropColumn('title');
            $table->dropColumn('moving_date');
            $table->dropColumn('rent_amount');
            $table->dropColumn('address');
            $table->dropColumn('availability_date');
        });
    }
};
