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
        Schema::create('viphams', function (Blueprint $table) {
            $table->increments('mavp');
            // $table->integer('mssv')->unsigned();
            // $table->integer('masach')->unsigned();
            $table->string('ndvipham');
            $table->string('htxuphat');
            // $table->integer('trangthai');
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('mssv')->references('mssv')->on('sinhviens');
            // $table->foreign('masach')->references('masach')->on('saches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('viphams');
        //
    }
};
