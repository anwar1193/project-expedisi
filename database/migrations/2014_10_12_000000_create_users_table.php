<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('kode_satker');
            $table->string('nama_satker');
            $table->string('nama');
            $table->string('nip');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('nomor_telepon');
            $table->string('user_level');
            $table->string('password');
            $table->string('status')->comment('1 = aktif, 2 = tidak aktif');
            $table->date('tgl_kadaluarsa');
            $table->string('foto')->nullable();
            $table->string('tema')->default('dark');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
