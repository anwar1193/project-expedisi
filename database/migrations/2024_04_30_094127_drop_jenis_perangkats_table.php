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
        Schema::dropIfExists('jenis_perangkats');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('jenis_perangkats', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jenis');
            $table->string('jenis');
            $table->timestamps();
        });
    }
};
