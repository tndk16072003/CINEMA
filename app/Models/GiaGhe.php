<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiaGhe extends Model
{
    use HasFactory;

    protected $table = 'gia_ghes';

    protected $fillable = [
        'gia_ghe',
        'loai_ghe',
    ];
}
