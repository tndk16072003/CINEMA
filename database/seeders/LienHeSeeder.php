<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LienHeSeeder extends Seeder
{
    public function run()
    {
        DB::table('lien_hes')->delete();

        DB::table('lien_hes')->truncate();

        DB::table('lien_hes')->insert([
            [
                'ho_va_ten' => 'Trần Nguyễn Duy Khánh',
                'email'     => 'duykhanhtran17062003@gmail.com',
                'tieu_de'   => 'Góp ý dịch vụ',
                'noi_dung'  => 'Nội dung là ...............................................',
            ]
        ]);
    }
}
