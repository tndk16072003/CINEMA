<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->delete();

        DB::table('admins')->truncate();

        DB::table('admins')->insert([
            [
                'ho_va_ten'     => "Trần Nguyễn Duy Khánh",
                'email'         => "duykhanhtran17062003@gmail.com",
                'password'      => bcrypt("123123"),
                'trang_thai'    => 1,
                'avatar'        => "/image/z3976458057712_c3684ddaf878e95cfa850558ebe85804.jpg",
                'so_dien_thoai' => "0905081330"
            ],
            [
                'ho_va_ten'     => "Hồ Thị Thanh Thanh",
                'email'         => "thanhchuot1806@gmail.com",
                'password'      => bcrypt("123123"),
                'trang_thai'    => 1,
                'avatar'        => "/image/324747105_476302261365063_5226754233536039042_n.jpg",
                'so_dien_thoai' => "0905081331"
            ],
        ]);
    }
}
