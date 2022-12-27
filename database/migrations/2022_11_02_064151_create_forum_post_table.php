<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_post', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->references('id')->on('course');
            $table->dateTime('created_at');
            $table->foreignId('created_by')->references('id')->on('users');
            $table->string('title', 64);
            $table->text('body');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forum_post');
    }
};
