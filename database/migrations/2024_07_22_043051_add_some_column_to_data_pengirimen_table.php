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
            $table->string('metode_pembayaran_2')->nullable()->after('bukti_pembayaran');
            $table->string('bank_2')->nullable()->after('metode_pembayaran_2');
            $table->string('bukti_pembayaran_2')->nullable()->after('bank_2');
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
            $table->dropColumn('metode_pembayaran_2');
            $table->dropColumn('bank_2');
            $table->dropColumn('bukti_pembayaran_2');
        });
    }
};
