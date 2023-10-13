<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('configs', function (Blueprint $table) {
            $table->integer('phim1')->nullable();
            $table->integer('phim2')->nullable();
            $table->integer('phim3')->nullable();
        });
    }

    public function down()
    {
        Schema::table('configs', function (Blueprint $table) {
            //
        });
    }
};
