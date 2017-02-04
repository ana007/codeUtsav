<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('role')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
         });

        Schema::create('app_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone')->unique()->nullable();
            $table->string('OTP')->nullable();
            $table->bigInteger('coin_silver_base')->default(0);
            $table->bigInteger('coin_silver_promo')->default(0);
            $table->bigInteger('coin_gold_promo')->default(0);
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('device_id')->nullable();
            $table->bigInteger('attempt')->default(0);
            $table->dateTime('last_attempt')->nullable();
            $table->dateTime('last_claimed')->nullable();
            $table->string('role')->nullable();
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
        Schema::dropIfExists('app_users');
    }
}
