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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string("phone")->unique()->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->longText('info')->nullable();
            $table->string('balance')->default(0);
            $table->timestamp('last_login')->nullable();
            $table->timestamp('checked_at')->default(null);
            $table->string("points")->default(0);
            $table->string("raw_points")->default(0);
            $table->float("score")->default(0);
            $table->unsignedInteger('package_id')->nullable();
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->boolean('is_online')->default(false);
            $table->boolean('banned')->default(false);
            $table->boolean('admin')->default(false);
            $table->string('avatar')->default("default.jpg");
            $table->timestamp('readRules_at')->default(null)->nullable();
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
