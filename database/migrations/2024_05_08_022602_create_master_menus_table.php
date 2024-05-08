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
        Schema::create('master_menus', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable(false)->default(0);
            $table->string('menu', 200)->nullable(false);
            $table->string('url', 100)->nullable(false);
            $table->string('icon', 50)->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('is_dropdown')->default(0);
            $table->integer('position')->nullable(false);
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
        Schema::dropIfExists('master_menus');
    }
};
