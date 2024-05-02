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
        Schema::create('daftar_pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_pengeluaran');
            $table->string('keterangan');
            $table->integer('jumlah_pembayaran');
            $table->string('pengguna_terkait');
            $table->string('metode_pembayaran');
            $table->text('bukti_pembayaran');
            $table->integer('status_pengeluaran')->comment('1 = Disetujui, 2 = Pending');
            $table->string('jenis_pengeluaran')->comment('operasional, pengeluaran lain');
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
        Schema::dropIfExists('daftar_pengeluarans');
    }
};
