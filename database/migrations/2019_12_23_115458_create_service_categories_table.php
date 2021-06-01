<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->boolean('is_available')->default(1);
            $table->integer('service_id');
            $table->string('image')->default('default.png');
            $table->longText('description')->nullable();
            $table->string('discount_type')->nullable();
            $table->integer('discount_price')->default(0);
            $table->text('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('meta_keywords')->nullable();
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
        Schema::dropIfExists('service_categories');
    }
}
