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
            $table->string('no_resi_pengiriman', 100)->after('tgl_pemasukkan');
            $table->string('metode_pembayaran2', 255)->after('bukti_pembayaran')->nullable(true);
            $table->text('bukti_pembayaran2')->after('metode_pembayaran2')->nullable(true);
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
            $table->dropColumn('no_resi_pengiriman');
            $table->dropColumn('metode_pembayaran2');
            $table->dropColumn('bukti_pembayaran2');
        });
    }
};
