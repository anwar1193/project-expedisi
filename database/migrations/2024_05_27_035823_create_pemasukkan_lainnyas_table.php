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
        Schema::create('pemasukkan_lainnyas', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_pemasukkan');
            $table->string('keterangan');
            $table->integer('jumlah_pemasukkan');
            $table->string('sumber_pemasukkan');
            $table->string('diterima_oleh');
            $table->string('metode_pembayaran');
            $table->text('bukti_pembayaran');
            $table->string('keterangan_tambahan')->nullable(true);
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
        Schema::dropIfExists('pemasukkan_lainnyas');
    }
};
