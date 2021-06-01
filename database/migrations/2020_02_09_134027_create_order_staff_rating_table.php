<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStaffRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_staff_rating', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('order_id')->nullable();
            $table->unsignedInteger('staff_id')->nullable();
            $table->unsignedInteger('customer_id')->nullable();
            $table->integer('rate_star_1')->nullable();
            $table->integer('rate_star_2')->nullable();
            $table->integer('rate_star_3')->nullable();
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
        Schema::dropIfExists('order_staff_rating');
    }
}
