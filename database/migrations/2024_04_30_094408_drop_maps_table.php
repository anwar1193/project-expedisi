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
        Schema::dropIfExists('maps');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('maps', function (Blueprint $table) {
            $table->id();
            $table->string('lat');
            $table->string('lang');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }
};
