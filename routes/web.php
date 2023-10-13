<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GheBanController;
use App\Http\Controllers\GheController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\LichChieuController;
use App\Http\Controllers\LienHeController;
use App\Http\Controllers\LikeBaiVietController;
use App\Http\Controllers\PhimController;
use App\Http\Controllers\PhongController;
use App\Http\Controllers\testController;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\GheBan;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/admin', [testController::class, 'index']);
Route::get('/test', [testController::class, 'index1']);

Route::get('/', [HomePageController::class, 'index']);
Route::get('/blog', [HomePageController::class, 'viewBlog']);
Route::get('/blog-detail/{slug}', [BaiVietController::class, 'viewBlogDetail']);
Route::get('/pricing', [BaiVietController::class, 'viewPricing']);
Route::get('/phim-dang-chieu', [HomePageController::class, 'viewPhimDangChieu']);
Route::get('/phim-sap-chieu', [HomePageController::class, 'viewPhimSapChieu']);
Route::get('/chi-tiet-phim/{slug}', [HomePageController::class, 'viewChiTietPhim']);
Route::post('/search', [HomePageController::class, 'actionTimKiemPhimPost']);
Route::get('/search/{value}', [HomePageController::class, 'actionTimKiemPhimGet']);
Route::post('/search-blog', [HomePageController::class, 'actionTimKiemBaiViet']);
Route::get('/search-blog', [HomePageController::class, 'actionTimKiemBaiViet']);
Route::get('/forgot-password', [HomePageController::class, 'viewForgotPassword']);
Route::post('/forgot-password/input-email', [CustomerController::class, 'actionInputEmail']);
Route::get('/forgot-password/input-password/{hash}', [CustomerController::class, 'viewInputPassword']);
Route::post('/forgot-password/input-password', [CustomerController::class, 'actionInputPassword']);
Route::get('/data-home-page', [BaiVietController::class, 'getDataHomePage']);

// Của khách hàng
Route::get('/login', [CustomerController::class, 'viewLogin']);
Route::post('/login', [CustomerController::class, 'actionLogin']);
Route::get('/register', [CustomerController::class, 'viewRegister']);
Route::post('/register', [CustomerController::class, 'actionRegister']);
Route::get('/active/{hash}',[CustomerController::class, 'actionActive']);


// của admin
Route::get('/admin/login', [AdminController::class, 'viewLogin']);
Route::post('/admin/login', [AdminController::class, 'actionLogin']);

Route::get('/alo', [BaiVietController::class, 'alo']);


Route::group(['prefix' => '/admin', 'middleware' => 'loginAdmin'], function() {
    Route::get('/logout', [AdminController::class, 'logout']);

    Route::group(['prefix' => '/phong'], function() {
        Route::get('/index', [PhongController::class, 'index']);
        Route::post('/index', [PhongController::class, 'store']);
        Route::get('/data', [PhongController::class, 'getData']);
        Route::get('/change-status/{id}', [PhongController::class, 'changeStatus']);
        Route::post('/delete', [PhongController::class, 'drop']);
        Route::post('/update', [PhongController::class, 'update']);
        Route::get('/ghe-phong/{id_phong}', [PhongController::class, 'getDataGhe']);
        Route::post('/change-status-ghe', [PhongController::class, 'changeStatusGhe']);
    });

    Route::group(['prefix' => '/phim'], function() {
        Route::get('/index', [PhimController::class, 'index']);
        Route::post('/index', [PhimController::class, 'store']);
        Route::get('/data', [PhimController::class, 'getData']);
        Route::post('/delete', [PhimController::class, 'drop']);
        Route::post('/update', [PhimController::class, 'update']);
        Route::get('/change-status/{id}', [PhimController::class, 'changeStatus']);
    });

    Route::group(['prefix' => '/lich-chieu'], function() {
        Route::get('/index', [LichChieuController::class, 'index']);
        Route::post('/index', [LichChieuController::class, 'store']);
        Route::get('/data', [LichChieuController::class, 'getData']);
        Route::post('/delete', [LichChieuController::class, 'drop']);
        Route::post('/update', [LichChieuController::class, 'update']);
        Route::get('/ghe-ban/{id_lich}', [GheBanController::class, 'getData']);
        Route::get('/change-status-ghe-ban/{id}', [LichChieuController::class, 'changeStatusGheBan']);
    });

    Route::group(['prefix' => '/cau-hinh'], function() {
        Route::get('/index', [ConfigController::class, 'index']);
        Route::post('/index', [ConfigController::class, 'store']);
    });

    Route::group(['prefix' => '/khach-hang'], function() {
        Route::get('/index', [CustomerController::class, 'index']);
        Route::post('/index', [CustomerController::class, 'store']);
        Route::get('/data', [CustomerController::class, 'getData']);
        Route::post('/delete', [CustomerController::class, 'drop']);
        Route::post('/update', [CustomerController::class, 'update']);
        Route::get('/change-status/{id}', [CustomerController::class, 'changeStatus']);
        Route::post('/doi-mat-khau', [CustomerController::class, 'doiMatKhau']);
    });

    Route::group(['prefix' => '/bai-viet'], function() {
        Route::get('/index', [BaiVietController::class, 'index']);
        Route::post('/index', [BaiVietController::class, 'store']);
        Route::get('/data', [BaiVietController::class, 'getData']);
        Route::post('/delete', [BaiVietController::class, 'drop']);
        Route::post('/update', [BaiVietController::class, 'update']);
        Route::get('/change-status/{id}', [BaiVietController::class, 'changeStatus']);
    });

    Route::group(['prefix' => '/admin'], function() {
        Route::get('/index', [AdminController::class, 'index']);
        Route::post('/index', [AdminController::class, 'store']);
        Route::get('/data', [AdminController::class, 'getData']);
        Route::post('/delete', [AdminController::class, 'drop']);
        Route::post('/update', [AdminController::class, 'update']);
        Route::get('/change-status/{id}', [AdminController::class, 'changeStatus']);
        Route::post('/edit-password', [AdminController::class, 'editPassword']);
        Route::post('/doi-mat-khau', [AdminController::class, 'doiMatKhau']);
        Route::post('/update-profile', [AdminController::class, 'updateProfile']);
    });

    Route::group(['prefix' => '/lien-he'], function() {
        Route::get('/index', [LienHeController::class, 'index']);
        Route::get('/data', [LienHeController::class, 'getData']);
        Route::get('/change-status/{id}', [LienHeController::class, 'changeStatus']);
        Route::post('/delete', [LienHeController::class, 'drop']);
    });
    Route::group(['prefix' => '/binh-luan'], function() {
        Route::get('/index', [CommentController::class, 'index']);
        Route::get('/data', [CommentController::class, 'getData']);
        Route::post('/delete', [CommentController::class, 'drop']);
    });

    Route::get('/profile', [AdminController::class, 'profile']);
    Route::post('/cap-nhat-gia', [ConfigController::class, 'editFee']);
});

Route::get('/824b175f-be67-4bb9-a210-9e27129dac76', [GheBanController::class, 'huyVeAuto']);

Route::group(['prefix' => '/client', 'middleware' => 'loginCustomer'], function() {
    Route::get('/dat-ve/{id_lich}', [LichChieuController::class, 'viewDatVePhim']);
    Route::get('/ghe-phong-hien-thi/{id_lich}', [LichChieuController::class, 'getGhePhong']);
    Route::get('/dat-ve/giu-cho/{id_ghe}', [GheBanController::class, 'actionGiuCho']);
    Route::get('/dat-ve/huy-ghe/{id_ghe}', [GheBanController::class, 'actionHuyGhe']);
    Route::get('/logout', [CustomerController::class, 'logout']);
    Route::get('/thanh-toan', [GheBanController::class, 'thanhToan']);
    Route::get('/profile', [CustomerController::class, 'profile']);
    Route::post('/profile', [CustomerController::class, 'updateProfile']);
    Route::get('/change-password', [CustomerController::class, 'viewChangePassword']);
    Route::post('/change-password', [CustomerController::class, 'actionChangePassword']);
    Route::get('/lien-he', [LienHeController::class, 'viewContact']);
    Route::post('/lien-he', [LienHeController::class, 'actionContact']);
    Route::post('/binh-luan', [CommentController::class, 'store']);
    Route::get('/like-bai-viet/{id_bv}/{id_user}', [LikeBaiVietController::class, 'likeBaiViet']);
});

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


Route::get('/khanh', [testController::class, 'index']);
Route::get('/tinh-diem/{cc}/{gk}/{ck}', [testController::class, 'tinhDiem']);
