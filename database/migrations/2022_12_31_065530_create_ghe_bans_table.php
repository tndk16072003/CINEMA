<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ghe_bans', function (Blueprint $table) {
            $table->id();
            $table->string('ten_ghe');
            $table->integer('id_lich');
            $table->integer('co_the_ban');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ghe_bans');
    }
};
