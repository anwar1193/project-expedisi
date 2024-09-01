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
        Schema::table('pemasukkan_lainnyas', function (Blueprint $table) {
            $table->string('bank')->nullable()->after('metode_pembayaran');
            $table->string('bank2')->nullable()->after('metode_pembayaran2');
            $table->integer('jumlah_barang')->default(0)->after('barang_jasa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemasukkan_lainnyas', function (Blueprint $table) {
            $table->dropColumn('bank');
            $table->dropColumn('bank2');
            $table->dropColumn('jumlah_barang');
        });
    }
};
