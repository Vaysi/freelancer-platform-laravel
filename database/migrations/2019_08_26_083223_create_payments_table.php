<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('method')->default('balance');
            $table->string('bank')->nullable()->nullable();
            $table->string('price');
            $table->string('refId')->nullable();
            $table->string('callback')->nullable();
            $table->boolean('status')->default(false);
            $table->string('model')->nullable();
            $table->string('model_id')->nullable();
            $table->text('message')->nullable();
            $table->integer('percent')->nullable();
            $table->string('type')->default('payment');
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
        Schema::dropIfExists('payments');
    }
}
