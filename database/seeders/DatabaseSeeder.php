<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->call(PhimSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(BaiVietSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(LichChieuSeeder::class);
        $this->call(PhongSeeder::class);
        $this->call(LienHeSeeder::class);
        $this->call(BinhLuanSeeder::class);
        $this->call(ConfigSeeder::class);
        $this->call(GiaGheSeeder::class);
    }
}
