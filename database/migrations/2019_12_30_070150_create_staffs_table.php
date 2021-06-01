<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('full_name');
            $table->string('email');
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('area_id');
            $table->string('phone_number')->nullable();
            $table->string('emergency_phone_number')->nullable();
            $table->boolean('is_available')->default(0);
            $table->integer('total_orders')->nullable();
            $table->integer('order_completed')->nullable();
            $table->integer('order_canceled')->nullable();
            $table->integer('average_rating')->nullable();
            $table->enum('shifts', ['morning', 'evening', 'night'])->default('morning');
            $table->unsignedInteger('driver_id')->nullable();
            $table->enum('driver_status', ['assigned', 'unassigned'])->default('unassigned');
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
        Schema::dropIfExists('staffs');
    }
}
