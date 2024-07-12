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
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropColumn('keterangan_barang');
            $table->dropColumn('harga');
            $table->dropColumn('jumlah_barang');
            $table->text('alamat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->string('keterangan_barang');
            $table->integer('harga');
            $table->integer('jumlah_barang');
            $table->dropColumn('alamat');
        });
    }
};
