<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaMatakuliahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa_matakuliah', function (Blueprint $table) {
            $table->id();
            $table->string('mahasiswa_id', 20)->nullable();
            //menjadikan mahasiswa_id sebagai foreign key
            $table->foreign('mahasiswa_id')->references('Nim')->on('mahasiswa');
            $table->unsignedBigInteger('matakuliah_id')->nullable();
            //menjadikan matakuliah_id sebagai foreign key
            $table->foreign('matakuliah_id')->references('id')->on('matakuliah');
            $table->string('nilai', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa_matakuliah');
    }
}