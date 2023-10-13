<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class baiViet extends Model
{
    use HasFactory;

    protected $table = 'bai_viets';

    protected $fillable = [
        'noi_dung',
        'mo_ta_ngan',
        'tieu_de',
        'hinh_anh',
        'trang_thai',
    ];
}
