<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BinhLuanSeeder extends Seeder
{
    public function run()
    {
        DB::table('comments')->delete();

        DB::table('comments')->truncate();

        DB::table('comments')->insert([
            [
                'ho_va_ten' => 'Trần Nguyễn Duy Khánh',
                'email'     => 'duykhanhtran17062003@gmail.com',
                'avatar'    => '/assets_client/img/blog/comment_avatar01.jpg',
                'noi_dung'  => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nihil minus nobis quidem dignissimos aut. Dolorum est illo iusto alias at!',
                'id_nguoi_binh_luan' => 1,
                'id_bai_viet' => 1
            ]
        ]);
    }
}
