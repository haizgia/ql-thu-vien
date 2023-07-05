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
        Schema::create('sinhviens', function (Blueprint $table) {
            $table->increments('mssv');
            $table->integer('malop');
            $table->string('hoten');
            $table->date('ngaysinh');
            $table->integer('gioitinh');
            $table->string('sdt', 13);
            $table->string('diachi');
            $table->integer('trangthai');
            $table->date('ngayhethan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sinhviens');
        //
    }
};
