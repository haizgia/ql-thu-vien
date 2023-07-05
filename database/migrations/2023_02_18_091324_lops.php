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
        //
        Schema::create('lops', function (Blueprint $table) {
            $table->increments('malop');
            $table->integer('manganh')->unsigned();
            $table->string('tenlop');
            $table->timestamps();

            $table->foreign('manganh')->references('manganh')->on('nganhs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lops');
        //
    }
};
