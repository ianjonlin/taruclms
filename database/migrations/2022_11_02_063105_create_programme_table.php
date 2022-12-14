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
        Schema::create('programme', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Foundation Programme', 'Diploma', 'Bachelor Degree', 'Master', 'Doctor of Philosophy']);
            $table->string("code")->unique();
            $table->string("title");
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('programme')->nullable()->references('id')->on('programme');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programme');
    }
};
