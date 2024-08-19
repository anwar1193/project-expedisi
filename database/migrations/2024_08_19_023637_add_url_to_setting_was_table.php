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
        Schema::table('setting_was', function (Blueprint $table) {
            $table->string('url_message')->after('sender');
            $table->string('url_media')->after('url_message');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setting_was', function (Blueprint $table) {
            $table->dropColumn('url_message');
            $table->dropColumn('url_media');
        });
    }
};
