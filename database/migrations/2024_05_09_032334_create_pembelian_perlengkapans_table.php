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
        Schema::create('pembelian_perlengkapans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pembelian');
            $table->integer('id_perlengkapan')->foreign('id_perlengkapan')->references('id')->on('perlengkapans');
            $table->integer('id_supplier')->foreign('id_supplier')->references('id')->on('suppliers');
            $table->integer('harga');
            $table->integer('jumlah');
            $table->string('keterangan')->nullable();
            $table->text('nota')->nullable();
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
        Schema::dropIfExists('pembelian_perlengkapans');
    }
};
