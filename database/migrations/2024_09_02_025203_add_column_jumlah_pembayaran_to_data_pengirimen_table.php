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
            $table->integer('jumlah_pembayaran')->after('bank')->nullable();
            $table->integer('jumlah_pembayaran_2')->after('bank_2')->nullable();
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
            $table->dropColumn('jumlah_pembayaran');
            $table->dropColumn('jumlah_pembayaran_2');
        });
    }
};
