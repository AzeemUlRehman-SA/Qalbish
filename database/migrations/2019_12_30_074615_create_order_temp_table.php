<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_temp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('customer_id');
            $table->double('total_price');
            $table->double('discount')->nullable();
            $table->dateTime('order_start_time')->nullable();
            $table->dateTime('order_end_time')->nullable();
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('area_id');
            $table->text('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->integer('total_persons')->nullable();
            $table->text('special_instruction')->nullable();
            $table->unsignedInteger('suggested_staff');
            $table->unsignedInteger('coupon_id');
            $table->text('order_details')->nullable();
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
        Schema::dropIfExists('order_temp');
    }
}
