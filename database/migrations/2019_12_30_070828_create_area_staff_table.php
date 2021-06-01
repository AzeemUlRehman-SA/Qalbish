<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('staff_id');
            $table->unsignedInteger('area_id');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.You
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_staff');
    }
}
