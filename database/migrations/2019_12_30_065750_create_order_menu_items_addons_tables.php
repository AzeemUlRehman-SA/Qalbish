<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderMenuItemsAddonsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordered_menu_items_addons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('order_details_id');
            $table->unsignedInteger('menu_item_id')->nullable();
            $table->unsignedInteger('add_on_id')->nullable();
            $table->text('name')->nullable();
            $table->integer('quantity')->nullable();
            $table->double('amount')->nullable();
            $table->integer('duration')->nullable();
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
        Schema::dropIfExists('ordered_menu_items_addons');
    }
}
