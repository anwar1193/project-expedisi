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
        Schema::table('data_pengirimen', function (Blueprint $table) {
            $table->string('jenis_pengiriman', 100)->after('bukti_pembayaran');
            $table->string('bawa_sendiri', 50)->after('jenis_pengiriman');
            $table->string('status_pengiriman', 50)->after('bawa_sendiri');
            $table->text('keterangan')->after('status_pengiriman');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_pengirimen', function (Blueprint $table) {
            $table->dropColumn('jenis_pengiriman');
            $table->dropColumn('bawa_sendiri');
            $table->dropColumn('status_pengiriman');
            $table->dropColumn('keterangan')->nullable();
        });
    }
};
