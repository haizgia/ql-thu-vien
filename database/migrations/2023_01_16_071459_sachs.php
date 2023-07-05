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
        Schema::create('saches', function (Blueprint $table) {
            $table->increments('masach');
            $table->integer('manganh')->unsigned();
            $table->integer('maloai')->unsigned();
            $table->integer('mavt')->unsigned();
            $table->string('tinhtrang');
            $table->integer('soluong');
            $table->integer('damuon')->default(0);
            $table->integer('damat')->default(0);
            $table->timestamps();
            $table->softDeletes();

            // $table->primary(['manganh', 'maloai', 'mavt']);
            // $table->foreign('manganh')->references('manganh')->on('nganhs');`
            $table->foreign('maloai')->references('maloai')->on('loais');
            $table->foreign('mavt')->references('mavt')->on('vitris');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sachs');
        //
    }
};
