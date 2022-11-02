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
        Schema::create('blocked_keywords', function (Blueprint $table) {
            $table->id();
            $table->string('value', 64)->unique();
            $table->foreignId('added_by')->references('id')->on('users');
            $table->dateTime('added_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blocked_keywords');
    }
};
