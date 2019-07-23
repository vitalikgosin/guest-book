<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->text('review')->nullable();
            $table->unsignedInteger('review_score');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_request_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('course_author_id');

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
        Schema::dropIfExists('reviews');
    }
}
