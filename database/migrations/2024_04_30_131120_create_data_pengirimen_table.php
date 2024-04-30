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
        Schema::create('data_pengirimen', function (Blueprint $table) {
            $table->id();
            $table->string("no_resi");
            $table->date('tgl_transaksi');
            $table->string('nama_pengirim');
            $table->string('kota_tujuan');
            $table->string('no_hp_pengirim');
            $table->string('no_hp_penerima');
            $table->decimal('berat_barang');
            $table->integer('ongkir');
            $table->integer('komisi');
            $table->integer('status_pembayaran')->comment('1 = Lunas, 2 = Pending');
            $table->string('metode_pembayaran');
            $table->string('bukti_pembayaran');
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
        Schema::dropIfExists('data_pengirimen');
    }
};
