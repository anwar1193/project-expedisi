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
        Schema::dropIfExists('surveilance_cars');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('surveilance_cars', function (Blueprint $table) {
            $table->id();
            $table->string('nopol');
            $table->string('warna');
            $table->string('merk');
            $table->string('kapasitas');
            $table->string('transmisi');
            $table->string('bahan_bakar');
            $table->string('status');
            $table->string('kondisi');
            $table->string('foto');
            $table->string('lat');
            $table->string('lang');
            $table->string('device_address');
            $table->boolean('engine_status')->default(0)->comment('0 = OFF, 1 = ON');
            $table->int('idle', 60);
            $table->timestamps();
        });
    }
};
