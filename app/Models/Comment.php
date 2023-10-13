<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'ho_va_ten',
        'noi_dung',
        'avatar',
        'id_nguoi_binh_luan',
        'email',
        'id_bai_viet',
        'id_binh_luan',
    ];

}
