<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',300);
            $table->string('type')->default('project');
            $table->integer('price_range');
            $table->dateTime('ends_at')->nullable();
            $table->dateTime('expires_at');
            $table->dateTime('confirmed_at')->nullable();
            $table->dateTime('starts_at')->nullable();
            $table->integer('deadline');
            $table->integer('min_guarantee')->default(0);
            $table->integer('deposit')->default(0);
            $table->integer('released')->default(0);
            $table->bigInteger('views')->default(0);
            $table->string('status')->default('open');
            $table->string('publish_status')->default('pending');
            $table->text('content');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('freelancer_id')->nullable();
            $table->unsignedBigInteger('offer_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->integer('employer_score')->default(0);
            $table->integer('freelancer_score')->default(0);
            $table->text('employer_comment')->nullable()->default(null);
            $table->text('freelancer_comment')->nullable()->default(null);
            $table->boolean('is_paid')->default(false);
            $table->boolean('private')->default(false);
            $table->boolean('hidden')->default(false);
            $table->boolean('special')->default(false);
            $table->boolean('urgent')->default(false);
            $table->boolean('hire')->default(false);
            $table->boolean('sticky')->default(false);
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
        Schema::dropIfExists('projects');
    }
}
