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
        Schema::table('daftar_pengeluarans', function (Blueprint $table) {
            $table->renameColumn('pengguna_terkait', 'yang_membayar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daftar_pengeluarans', function (Blueprint $table) {
            $table->renameColumn('yang_membayar', 'pengguna_terkait');
        });
    }
};
