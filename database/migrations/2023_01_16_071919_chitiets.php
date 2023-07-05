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
        Schema::create('chitietsaches', function (Blueprint $table) {
            $table->integer('masach')->primary()->unsigned();
            $table->string('ten');
            $table->string('tacgia');
            $table->string('nxb');
            $table->string('mota');
            $table->string('hinhanh');
            $table->string('slug');
            $table->integer('index');
            $table->boolean('display');
            $table->string('link-pdf')->default('null');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('masach')->references('masach')->on('saches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chitietsaches');
        //
    }
};
