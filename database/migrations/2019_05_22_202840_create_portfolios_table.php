<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description',2000);
            $table->string('title');
            $table->unsignedBigInteger('user_id');
            $table->string('images',3000);
            $table->integer('default')->default(0);
            $table->string('status')->default('pending');
            $table->text('message')->nullable();
            $table->boolean('draft')->default(true);
            $table->integer('views')->default(0);
            $table->integer('liked')->default(0);
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
        Schema::dropIfExists('portfolios');
    }
}
