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
        Schema::create('muontras', function (Blueprint $table) {
            $table->increments('maphieu');
            $table->integer('mssv')->unsigned();
            $table->integer('masach')->unsigned();
            $table->date('ngaymuon');
            $table->date('ngayhentra');
            $table->date('ngaytra')->default(null);
            $table->date('ngaygiahan')->default(null);
            $table->integer('trangthai')->default(6);
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
        Schema::dropIfExists('muontras');
        //
    }
};
