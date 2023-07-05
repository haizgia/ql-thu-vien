<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('savebooks', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user')->unsigned();
            $table->integer('masach')->unsigned();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('masach')->references('masach')->on('saches');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('savebooks');
    }
};
