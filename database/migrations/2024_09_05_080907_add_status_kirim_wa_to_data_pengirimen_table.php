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
            $table->boolean('status_kirim_wa')->default(true)->after('input_by');
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
            $table->dropColumn('status_kirim_wa');
        });
    }
};
