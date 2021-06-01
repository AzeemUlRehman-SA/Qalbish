<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('full_name');
            $table->string('email');
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('area_id');
            $table->string('phone_number')->nullable();
            $table->string('emergency_phone_number')->nullable();
            $table->boolean('is_available')->default(0);
            $table->enum('shifts', ['morning', 'evening', 'night'])->default('morning');
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
        Schema::dropIfExists('drivers');
    }
}
