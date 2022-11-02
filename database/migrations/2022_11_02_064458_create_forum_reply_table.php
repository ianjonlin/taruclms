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
        Schema::create('forum_reply', function (Blueprint $table) {
            $table->id();
            $table->foreignId('forum_id')->references('id')->on('forum_post');
            $table->dateTime('created_at');
            $table->foreignId('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('forum_reply');
    }
};
