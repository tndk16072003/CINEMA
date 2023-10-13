<?php

namespace App\Http\Controllers;

use App\Models\baiViet;
use App\Models\Config;
use App\Models\LichChieu;
use App\Models\Phim;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomePageController extends Controller
{
    public function dataBlog()
    {
        $data = baiViet::orderByDESC('id')
                        ->where('trang_thai', 1)
                        ->paginate(3);

        return response()->json([
            'data' => $data
        ]);
    }

    public function dataBaiViet()
    {
        $blog = baiViet::select('*')
                       ->where('trang_thai', 1)
                       ->orderByDESC('id')
                       ->paginate(3);
        return response()->json([
            'data' => $blog
        ]);
    }

    public function viewForgotPassword()
    {
        return view('client.forgot_Password_input_email');
    }

    public function actionTimKiemBaiViet(Request $request)
    {
        // dd($request->all());
        $value = $request->value_search_blog;
        $blog = baiViet::where('tieu_de', 'LIKE', '%' . $value . '%')->first();
        if($blog) {
            return redirect('/blog-detail/blog-detail-post-' . $blog->id);
        } else {
            Toastr::warning('Không có bài viết nào cho ' . $value);
            return redirect()->back();
        }
    }

    public function actionTimKiemPhimPost(Request $request)
    {
        $value = $request->value_search;
        $phim = Phim::where('ten_phim', 'LIKE', '%' . $value . '%')
                         ->orWhere('dao_dien', 'LIKE', '%' . $value . '%')
                         ->orWhere('dien_vien', 'LIKE', '%' . $value . '%')
                         ->orWhere('the_loai', 'LIKE', '%' . $value . '%')
                         ->paginate(3);
        return view('client.phim_dang_chieu', compact('phim'));
    }

    public function viewBlog()
    {
        return view('client.blog_vue');
    }

    public function actionTimKiemPhimGet($value)
    {
        $phim = Phim::where('ten_phim', 'LIKE', '%' . $value . '%')
                         ->orWhere('dao_dien', 'LIKE', '%' . $value . '%')
                         ->orWhere('dien_vien', 'LIKE', '%' . $value . '%')
                         ->orWhere('the_loai', 'LIKE', '%' . $value . '%')
                         ->paginate(3);
        return view('client.phim_dang_chieu', compact('phim'));
    }

    public function index()
    {
        $config = Config::orderByDESC('id')->first();
        $list_phim = Phim::where('tinh_trang', '!=', 0)->get();
        $list_banner_phim = Phim::where('tinh_trang', '<>', 0)
                                ->orderByDESC('id')
                                ->get();
        // dd($list_banner_phim->toArray());
        if($config) {
            $phim1 = Phim::where('id', $config->phim1)->first();
            $phim2 = Phim::where('id', $config->phim2)->first();
            $phim3 = Phim::where('id', $config->phim3)->first();
            return view('client.homepage', compact('config', 'phim1', 'phim2', 'phim3','list_phim', 'list_banner_phim'));
        } else {
            return view('client.homepage', compact('list_phim', 'list_banner_phim'));
        }
    }

    public function viewPhimDangChieu()
    {
        $phim = Phim::where('tinh_trang', 1)
                    ->select('phims.*' , DB::raw('date_format(phims.ngay_khoi_chieu , "%d/%m/%Y") as ngay_chieu'))
                    ->paginate(4);
        $user = Auth::guard('customer')->user();
        foreach($phim as $key => $value) {
            if($value->like != null) {
                $list_like = explode($value->like, ',');
                $value->so_luot_like = count($list_like);
                if($user) {
                    // dd($user->id . ',');
                    foreach($list_like as $k => $v) {

                    }
                    // dd($value->user_like);
                } else {
                    $value->user_like = false;
                }
            } else {
                $value->so_luot_like = 0;
                $value->user_like = false;
            }
        }

        return view('client.phim_dang_chieu', compact('phim'));
    }

    public function viewPhimSapChieu()
    {
        $phim = Phim::where('tinh_trang', '=', 2)
                    ->select('phims.*' , DB::raw('date_format(phims.ngay_khoi_chieu , "%d/%m/%Y") as ngay_khoi_chieu'))
                    ->paginate(4);

        $user = Auth::guard('customer')->user();
        foreach($phim as $key => $value) {
            if($value->like != null) {
                $list_like = explode($value->like, ',');
                $value->so_luot_like = count($list_like);
                if($user) {
                    $value->user_like = str_contains($value->like, $user->id . ',');
                } else {
                    $value->user_like = false;
                }
            } else {
                $value->so_luot_like = 0;
                $value->user_like = false;
            }
        }
        return view('client.phim_sap_chieu' , compact('phim'));
    }

    public function viewChiTietPhim($slug)
    {
        $slug_parts = explode("-", $slug);
        $id = last($slug_parts);
        $phim = Phim::where('id', $id)
                    ->select('phims.*' , DB::raw('date_format(phims.ngay_khoi_chieu , "%d/%m/%Y") as ngay_khoi_chieu'))
                    ->first();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        // dd($now);
        $lich_chieu = LichChieu::where('id_phim', $id)
                               ->where('thoi_gian_ket_thuc', '>', $now)
                               ->select('lich_chieus.*', DB::raw('date_format(lich_chieus.thoi_gian_bat_dau, "%H:%m:%s %d/%m/%Y") as thoi_gian_bat_dau'))
                               ->get();
                            //    dd($lich_chieu->thoi_gian_kethuc);
        if($phim->lua_tuoi == 0) {
            $lua_tuoi = '5+';
        } else if($phim->lua_tuoi == 1) {
            $lua_tuoi = '12+';
        } else if($phim->lua_tuoi == 2) {
            $lua_tuoi = '16+';
        } else {
            $lua_tuoi = '18+';
        }
        Toastr::info('Phim có nội dung dành cho độ tuổi <i>' . $lua_tuoi . '</i>. Hãy lưu ý khi đặt phim nhé!', 'Thông báo');
        return view('client.chi_tiet_phim', compact('phim', 'lich_chieu'));
    }
}
