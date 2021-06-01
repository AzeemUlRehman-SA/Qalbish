<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('customer_id');
            $table->double('total_price')->nullable();
            $table->double('grand_total')->nullable();
            $table->double('coupon_discount')->nullable();
            $table->dateTime('order_start_time')->nullable();
            $table->dateTime('order_end_time')->nullable();
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('area_id');
            $table->text('address')->nullable();
            $table->longText('extra_services')->nullable();
            $table->string('phone_number')->nullable();
            $table->integer('total_persons')->nullable();
            $table->text('special_instruction')->nullable();
            $table->text('requested_date_time')->nullable();
            $table->string('suggested_staff')->nullable();
            $table->unsignedInteger('driver_id')->nullable();
            $table->unsignedInteger('staff_id')->nullable();
            $table->double('referral_discount')->nullable();
            $table->double('first_order_discount')->nullable();
            $table->double('membership_discount')->nullable();
            $table->double('admin_discount')->nullable();
            $table->double('delivery_charges')->nullable();
            $table->string('time_zone')->nullable();
            $table->enum('order_status', ['pending', 'confirmed', 'completed']);
            $table->enum('staff_status', ['pending', 'accepted', 'rejected', 'completed']);
            $table->enum('order_progress_status', ['on-my-way', 'start', 'end','collect-cash']);
            $table->softDeletes();
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
        Schema::dropIfExists('order');
    }
}
