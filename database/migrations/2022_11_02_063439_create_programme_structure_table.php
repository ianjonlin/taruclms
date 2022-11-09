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
        Schema::create('programme_structure', function (Blueprint $table) {
            $table->id();
            $table->foreignId('programme_id')->references('id')->on('programme')->onDelete('cascade')->onUpdate('cascade');;
            $table->foreignId('course_id')->references('id')->on('course')->onDelete('cascade')->onUpdate('cascade');;
            $table->integer('year');
            $table->integer('sem');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programme_structure');
    }
};
