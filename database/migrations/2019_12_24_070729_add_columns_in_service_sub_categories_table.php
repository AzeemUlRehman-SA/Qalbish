<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInServiceSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_sub_categories', function (Blueprint $table) {
            $table->boolean('is_available')->default(1);
            $table->float('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_sub_categories', function (Blueprint $table) {
            $table->dropColumn('is_available');
            $table->dropColumn('price');
        });
    }
}
