<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('service_id')->nullable();
            $table->unsignedInteger('menu_item_id')->nullable();
            $table->unsignedInteger('package_id')->nullable();
            $table->text('name')->nullable();
            $table->integer('quantity')->nullable();
            $table->double('amount')->nullable();
            $table->integer('duration')->nullable();
            $table->enum('type', ['Service', 'Package'])->nullable();
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
        Schema::dropIfExists('order_details_tables');
    }
}
