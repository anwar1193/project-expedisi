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
        Schema::dropIfExists('pemasukan_lainnyas');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('pemasukan_lainnyas', function (Blueprint $table) {
            $table->id();
            $table->string('kategori', 100)->nullable(false);
            $table->string('nama_customer', 100)->nullable(false);
            $table->integer('harga')->default(0);
            $table->date('tanggal_transaksi');
            $table->integer('komisi')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }
};
