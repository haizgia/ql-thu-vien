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
        Schema::create('dangkymuons', function (Blueprint $table) {
            $table->increments('madk');
            $table->integer('mssv')->unsigned();
            $table->integer('masach')->unsigned();
            $table->date('ngayhen');
            $table->integer('trangthai')->default(3);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('mssv')->references('mssv')->on('sinhviens');
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
        Schema::dropIfExists('dangkymuons');
        //
    }
};
