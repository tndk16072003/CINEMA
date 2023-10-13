<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PhimController;
use App\Http\Controllers\PhongController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

    Route::get('/danh-sach-phim', [PhimController::class, 'getData']);
    Route::post('/admin/phong/tao-phong', [PhongController::class, 'store']);
