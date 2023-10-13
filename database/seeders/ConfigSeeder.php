<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->delete();
        DB::table('configs')->truncate();
        DB::table('configs')->insert([
            [
                'banner'            => '/assets_client/img/banner/s_slider_bg.jpg',
                'phim1'             => rand(1,10),
                'phim2'             => rand(1,10),
                'phim3'             => rand(1,10),
                'banner_header'     => '/assets_client/img/bg/breadcrumb_bg.jpg',
            ],
        ]);
    }
}
