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
            $table->string('kategori')->after('keterangan_tambahan');
            $table->integer('barang_jasa');
            $table->integer('modal');
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
            $table->dropColumn('kategori');
            $table->dropColumn('barang_jasa');
            $table->dropColumn('modal');
        });
    }
};
