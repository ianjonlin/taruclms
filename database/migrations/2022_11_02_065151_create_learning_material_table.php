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
        Schema::create('learning_material', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->foreignId('category_id')->references('id')->on('lm_category');
            $table->enum('type', ['file', 'url']);
            $table->string('path', 256);
            $table->string('ext', 5)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('learning_material');
    }
};
