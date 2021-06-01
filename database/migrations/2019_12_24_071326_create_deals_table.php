<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('category_id');
            $table->string('name');
            $table->string('slug');
            $table->float('net_price')->default(0);
            $table->float('total_price')->default(0);
            $table->boolean('is_available')->default(1);
            $table->string('image')->default('default.png');
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
        Schema::dropIfExists('deals');
    }
}
