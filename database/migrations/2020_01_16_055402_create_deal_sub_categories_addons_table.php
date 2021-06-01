<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealSubCategoriesAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_sub_categories_addons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('deals_sub_category_id')->unsigned();
            $table->integer('addon_id')->unsigned();
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
        Schema::dropIfExists('deal_sub_categories_addons');
    }
}
