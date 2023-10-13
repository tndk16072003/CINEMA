<?php

namespace App\Http\Controllers;

use App\Models\GheBan;
use App\Models\GiaGhe;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GheBanController extends Controller
{
    public function huyVeAuto()
    {
        $now = Carbon::now()->subSeconds(180)->toDateTimeString();
        // $now = Carbon::now()->toDateTimeString();
        $ghe = GheBan::where('trang_thai', 0)
              ->where('id_bill_ngan_hang', 0)
              ->where('updated_at', '<=', $now)
              ->update([
                        'id_khach_hang' => 0,
                        'trang_thai' => 1,
                        'ma_giao_dich' => null
              ]);
    }

    public function thanhToan()
    {
        // 1. Lấy thông tin khách hàng đang đăng nhập
        // 2, Lấy danh sách ghế mà nó đã đặt
        // 2.1. Nếu như nó không có đặt ghế nào => chửi cái
        // 2.2. Nếu có thì mình tạo ra cái mã giao dịch => hiển thị ra view
        $user_login = Auth::guard('customer')->user();
        // dd($user_login->id);
        $list_ghe = GheBan::join('gia_ghes', 'ghe_bans.is_ghe_doi', 'gia_ghes.loai_ghe')
                          ->where('trang_thai', 2)
                          ->where('id_khach_hang', $user_login->id)
                          ->select('gia_ghes.gia_ghe', 'ghe_bans.*')
                          ->get();
                        //   dd($list_ghe->toArray());
        // where gia ve
        if(count($list_ghe) != 0) {
            $soVe = 0;
            $tongTien = 0;
            foreach($list_ghe as $key => $value) {
                $soVe = $soVe + 1;
                $tongTien = $tongTien + $value->gia_ghe;
                $value->trang_thai = 0;
                $value->ma_giao_dich = 'HD' . rand(100000, 999999) . $list_ghe[0]->id_lich;
                $value->save();
            }
            $thongTin = GheBan::join('lich_chieus', 'lich_chieus.id', 'ghe_bans.id_lich')
                              ->join('phongs', 'phongs.id', 'lich_chieus.id_phong')
                              ->join('phims', 'phims.id', 'lich_chieus.id_phim')
                              ->where('lich_chieus.id', $list_ghe[0]->id_lich)
                              ->select('phims.ten_phim', 'phongs.ten_phong', DB::raw('date_format(lich_chieus.thoi_gian_bat_dau, "%H:%m %d/%m/%Y") as thoi_gian_bat_dau'))
                              ->first();
                            //   dd($thongTin->toArray(), $tongTien);
            return view('client.thanh_toan', compact('list_ghe', 'thongTin', 'soVe', 'tongTien'));
        } else {
            Toastr::error('Bạn phải đặt ghế trước khi thanh toán');
            return redirect()->back();
        }
    }

    public function getData($id_lich)
    {
        $data = GheBan::where('id_lich', $id_lich)->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function actionGiuCho($id_ghe)
    {

        $ghe = GheBan::where('id', $id_ghe)
                     ->where('trang_thai', '!=', 0)
                     ->first();
        $user_login = Auth::guard('customer')->user();
        if($ghe) {
            $ghe->trang_thai = 2;
            $ghe->id_khach_hang = $user_login->id;
            $ghe->save();

            GheBan::where('trang_thai', 2)
                  ->where('id_lich', '!=', $ghe->id_lich)
                  ->update(['id_khach_hang' => 0, 'trang_thai' => 1]);
        } else {
            return response()->json([
                'status' => false,
                'messages' => 'Không thể giữ ghế!'
            ]);
        }

        return response()->json([
            'status' => true,
            'messages' => 'Đã giữ ghế thành công!'
        ]);
    }

    public function actionHuyGhe($id_ghe)
    {
        $ghe = GheBan::where('id', $id_ghe)
                     ->where('trang_thai', '!=', 0)
                     ->first();
        if($ghe) {
            $ghe->trang_thai = 1;
            $ghe->save();
        } else {
            return response()->json([
                'status' => false,
                'messages' => 'Không thể huỷ ghế!'
            ]);
        }

        return response()->json([
            'status' => true,
            'messages' => 'Đã huỷ ghế thành công!'
        ]);
    }
}
