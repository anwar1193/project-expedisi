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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('no_wa_2')->nullable()->unique()->after('no_wa');
            $table->string('no_wa_3')->nullable()->unique()->after('no_wa_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropUnique('no_wa_2');
            $table->dropUnique('no_wa_3');
        });
    }
};
