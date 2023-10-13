<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class likeBaiViet extends Model
{
    use HasFactory;

    protected $table = 'like_bai_viets';

    protected $fillable = [
        'id_bai_viet',
        'id_user_like',
        'tinh_trang',
    ];
}
