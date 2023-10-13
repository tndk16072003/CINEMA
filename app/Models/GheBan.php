<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GheBan extends Model
{
    use HasFactory;

    protected $table = 'ghe_bans';

    protected $fillable = [
        'ten_ghe',
        'id_lich',
        'co_the_ban',
        'trang_thai',
        'id_khach_hang',
        'ma_giao_dich',
        'id_bill_ngan_hang',
        'is_ghe_doi',
    ];
}
