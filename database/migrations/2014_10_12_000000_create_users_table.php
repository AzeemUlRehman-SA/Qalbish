<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable(); //required
            $table->string('last_name')->nullable();  //required
            $table->string('email')->unique()->nullable();  //required
            $table->string('password')->nullable();  //required
            $table->integer('city_id')->nullable();  //required
            $table->integer('area_id')->nullable(); //required
            $table->integer('role_id')->nullable(); //required
            $table->unsignedInteger('membership_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();  //required
            $table->date('dob')->nullable();
            $table->string('age')->nullable();  //required
            $table->string('phone_number')->nullable();  //required
            $table->string('emergency_number')->nullable();
            $table->string('cnic')->nullable();  //required
            $table->text('address')->nullable();  //required
            $table->string('referral_code')->nullable();
            $table->string('otp_code')->nullable();
            $table->enum('user_type', ['admin', 'staff', 'customer', 'driver'])->nullable();
            $table->enum('status', ['pending', 'suspended', 'verified'])->default('pending');
            $table->enum('otp_status', ['sent','verified'])->default('sent');
            $table->timestamp('email_verified_at')->nullable();
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
