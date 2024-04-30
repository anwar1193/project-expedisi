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
        Schema::dropIfExists('perangkats');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('perangkats', function (Blueprint $table) {
            $table->id();
            $table->string('kode_perangkat');
            $table->string('nama_perangkat');
            $table->string('jenis_perangkat');
            $table->string('serial_number');
            $table->string('kondisi_perangkat');
            $table->string('foto');
            $table->timestamps();
        });
    }
};
