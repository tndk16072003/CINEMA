<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GiaGheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gia_ghes')->delete();
        DB::table('gia_ghes')->truncate();
        DB::table('gia_ghes')->insert([
            [
                'gia_ghe'   => 65000,
                'loai_ghe'  => 0
            ],
            [
                'gia_ghe'   => 125000,
                'loai_ghe'  => 1
            ]
        ]);
    }
}
