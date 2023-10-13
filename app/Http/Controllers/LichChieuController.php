<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLichChieuRequest;
use App\Http\Requests\DeleteLichChieuRequest;
use App\Http\Requests\UpdateLichChieuRequest;
use App\Models\Ghe;
use App\Models\GheBan;
use App\Models\LichChieu;
use App\Models\Phong;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LichChieuController extends Controller
{
    public function viewDatVePhim($id_lich)
    {
        $now = Carbon::now()->toDateTimeString();
        $lich_chieu = LichChieu::where('id', $id_lich)
                               ->where('thoi_gian_ket_thuc', '>', $now)
                               ->first();
        $user_login = Auth::guard('customer')->user()->id;
        // dd($user_login->toArray());
        if($lich_chieu) {
            return view('client.dat_ve', compact('id_lich', 'user_login'));
        } else {
            Toastr::error('Lịch chiếu không tồn tại!');
            return redirect()->back();
        }
    }

    public function getGhePhong($id_lich)
    {
        $ghe = GheBan::where('id_lich', $id_lich)->get();
        $phong = LichChieu::join('phongs', 'lich_chieus.id_phong', 'phongs.id')
                          ->where('lich_chieus.id', $id_lich)
                          ->first();
        return response()->json([
            'hang_doc'      => $phong->hang_doc,
            'hang_ngang'    => $phong->hang_ngang,
            'data'          => $ghe,
            'ten_phong'     => $phong->ten_phong
        ]);
    }

    public function index()
    {
        return view('AdminRocker.page.lich_chieu.index');
    }

    public function drop(DeleteLichChieuRequest $request)
    {
        LichChieu::where('id', $request->id)->delete();

        return response()->json([
            'status'    => true,
            'messages'  => 'Đã xoá lịch chiếu thành công!'
        ]);
    }

    public function store(CreateLichChieuRequest $request)
    {
        // thoi_gian_bat_dau &  thoi_gian_ket_thuc (y/m/d/h/m/s)
        // tạo ra một ngày theo format(y/m/d)
        $ngay_chieu = Carbon::createFromFormat("Y-m-d", $request->ngay_chieu);
        // tách ngày tháng năm
        $ngay = $ngay_chieu->day;
        // lấy giờ bd kt nhập vào
        $thang = $ngay_chieu->month;
        // truyền vào một biến tổng
        $nam = $ngay_chieu->year;
        $gio_bd = Carbon::parse($request->gio_bat_dau);
        $gio_kt = Carbon::parse($request->gio_ket_thuc);

        $now = Carbon::today();

        $time = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $thoi_gian_bd = Carbon::create($nam, $thang, $ngay, $gio_bd->hour, $gio_bd->minute, 0);
        $thoi_gian_kt = Carbon::create($nam, $thang, $ngay, $gio_kt->hour, $gio_kt->minute, 0);

        // vì dữ liệu ở database là string nên chuyển từ dateTime sang string để so sánh
        $bat_dau = $thoi_gian_bd->toDateString();
        $ket_thuc = $thoi_gian_kt->toDateString();

        if($ngay_chieu < $now) {
            return response()->json([
                'status'    =>  false,
                'messages'  =>  'Ngày Chiếu phải là hôm nay trở đi'
            ]);
        }

        if($bat_dau < $time) {
            return response()->json([
                'status'    =>  false,
                'messages'  =>  'Giờ bắt đầu phải lớn hơn hoặc bằng giờ hiện tại'
            ]);
        }

        if($gio_kt <= $gio_bd) {
            return response()->json([
                'status'    =>  false,
                'messages'  =>  'Giờ kết thúc phải lớn hơn bằng giờ bắt đầu'
            ]);
        }


        // giờ bắt đầu hoặc giờ kết thúc nằm giữa (thoi_gian_bat_dau & thoi_gian_ket_thuc) của lịch chiếu khác
        $check1 = LichChieu::where('id_phong', $request->id_phong)
                            ->where('thoi_gian_bat_dau', '<=', $bat_dau)
                            ->where('thoi_gian_ket_thuc', '>=', $bat_dau)
                            ->first();
        $check2 = LichChieu::where('id_phong', $request->id_phong)
                            ->where('thoi_gian_bat_dau', '<=', $ket_thuc)
                            ->where('thoi_gian_ket_thuc', '>=', $ket_thuc)
                            ->first();
        // giờ bắt đầu và giờ kết thúc nằm lồng (thoi_gian_bat_dau & thoi_gian_ket_thuc) của lịch chiếu khác
        $check3 = LichChieu::where('id_phong', $request->id_phong)
                            ->where('thoi_gian_bat_dau', '>=', $bat_dau)
                            ->where('thoi_gian_ket_thuc', '<=', $ket_thuc)
                            ->first();

        if($check1 || $check2 || $check3) {
            return response()->json([
                'status'    => false,
                'messages'  => 'Lịch chiếu đã bị trùng'
            ]);
        }
        // tạo lịch chiếu
        $lich =  LichChieu::create([
            'id_phim'                   => $request->id_phim,
            'id_phong'                  => $request->id_phong,
            'thoi_gian_chieu_chinh'     => $request->thoi_gian_chieu_chinh,
            'thoi_gian_quang_cao'       => $request->thoi_gian_quang_cao,
            'thoi_gian_bat_dau'         => $thoi_gian_bd,
            'thoi_gian_ket_thuc'        => $thoi_gian_kt,
        ]);

        // Lấy tất cả ghế của phòng đó
        $list_ghe = Ghe::where('id_phong', $lich->id_phong)->get();
        // $list_ghe = Phong::where('phongs.id', $request->id_phong)
        //                    ->join('ghes', 'ghes.id_phong', 'phongs.id')
        //                    ->get();

        // tạo ghế bán
        foreach($list_ghe as $key => $value) {
            GheBan::create([
                'id_lich'       => $lich->id,
                'ten_ghe'       => $value->ten_ghe,
                'co_the_ban'    => 1,
                'is_ghe_doi'    => 0,
            ]);
        }

        return response()->json([
            'status'    => true,
            'messages'  => 'Đã thêm mới lịch chiếu thành công'
        ]);
    }

    public function update(UpdateLichChieuRequest $request)
    {
        // $data = $request->all();
        // thoi_gian_bat_dau &  thoi_gian_ket_thuc (y/m/d/h/m/s)
        // tạo ra một ngày theo format(y/m/d)
        $ngay_chieu = Carbon::createFromFormat("Y-m-d", $request->ngay_chieu);
        // tách ngày tháng năm
        $ngay = $ngay_chieu->day;
        // lấy giờ bd kt nhập vào
        $thang = $ngay_chieu->month;
        // truyền vào một biến tổng
        $nam = $ngay_chieu->year;
        $gio_bd = Carbon::parse($request->gio_bat_dau);
        $gio_kt = Carbon::parse($request->gio_ket_thuc);

        $now = Carbon::today();

        if($ngay_chieu < $now) {
            return response()->json([
                'status'    =>  false,
                'messages'  =>  'Ngày Chiếu phải là hôm nay trở đi'
            ]);
        }
        $time = Carbon::now('Asia/Ho_Chi_Minh');

        $thoi_gian_bd = Carbon::create($nam, $thang, $ngay, $gio_bd->hour, $gio_bd->minute, 0);
        $thoi_gian_kt = Carbon::create($nam, $thang, $ngay, $gio_kt->hour, $gio_kt->minute, 0);

        // vì dữ liệu ở database là string nên chuyển từ dateTime sang string để so sánh
        $bat_dau = $thoi_gian_bd->toDateString();
        $ket_thuc = $thoi_gian_kt->toDateString();

        if($bat_dau < $time) {
            return response()->json([
                'status'    =>  false,
                'messages'  =>  'Giờ bắt đầu phải lớn hơn hoặc bằng giờ hiện tại'
            ]);
        }

        if($gio_kt <= $gio_bd) {
            return response()->json([
                'status'    =>  false,
                'messages'  =>  'Giờ kết thúc phải lớn hơn bằng giờ bắt đầu'
            ]);
        }

        // giờ bắt đầu hoặc giờ kết thúc nằm giữa (thoi_gian_bat_dau & thoi_gian_ket_thuc) của lịch chiếu khác
        $check1 = LichChieu::where('id_phong', $request->id_phong)
                            ->where('thoi_gian_bat_dau', '<=', $bat_dau)
                            ->where('thoi_gian_ket_thuc', '>=', $bat_dau)
                            ->first();
        $check2 = LichChieu::where('id_phong', $request->id_phong)
                            ->where('thoi_gian_bat_dau', '<=', $ket_thuc)
                            ->where('thoi_gian_ket_thuc', '>=', $ket_thuc)
                            ->first();
        // giờ bắt đầu và giờ kết thúc nằm lồng (thoi_gian_bat_dau & thoi_gian_ket_thuc) của lịch chiếu khác
        $check3 = LichChieu::where('id_phong', $request->id_phong)
                            ->where('thoi_gian_bat_dau', '>=', $bat_dau)
                            ->where('thoi_gian_ket_thuc', '<=', $ket_thuc)
                            ->first();

        if($check1 || $check2 || $check3) {
            return response()->json([
                'status'    => false,
                'messages'  => 'Lịch chiếu đã bị trùng'
            ]);
        }
        $lich = LichChieu::where('id', $request->id)->first();
        $lich->update([
            'id_phim'                   => $request->id_phim,
            'id_phong'                  => $request->id_phong,
            'thoi_gian_chieu_chinh'     => $request->thoi_gian_chieu_chinh,
            'thoi_gian_quang_cao'       => $request->thoi_gian_quang_cao,
            'thoi_gian_bat_dau'         => $thoi_gian_bd,
            'thoi_gian_ket_thuc'        => $thoi_gian_kt,
        ]);
        // dd($lich);
        GheBan::where('id_lich', $request->id)->delete();

        // Lấy tất cả ghế của phòng đó
        $list_ghe = Ghe::where('id_phong', $lich->id_phong)->get();
        // $list_ghe = Phong::where('phongs.id', $request->id_phong)
        //                    ->join('ghes', 'ghes.id_phong', 'phongs.id')
        //                    ->get();
        // tạo ghế bán
        foreach($list_ghe as $key => $value) {
            if($value->is_ghe_doi == 1) {
                GheBan::create([
                    'id_lich'   => $value->id,
                    'ten_ghe'   => $value->ten_ghe,
                    'co_the_ban'=> 1,
                    'is_ghe_doi'=> 1,
                ]);
            } else {
                GheBan::create([
                    'id_lich'   => $value->id,
                    'ten_ghe'   => $value->ten_ghe,
                    'co_the_ban'=> 1,
                    'is_ghe_doi'=> 0,
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'messages' => 'Đã cập nhật lịch chiếu thành công!'
        ]);
    }

    public function getData()
    {
        $data = LichChieu::join('phims', 'lich_chieus.id_phim', 'phims.id')
                           ->join('phongs', 'lich_chieus.id_phong', 'phongs.id')
                           ->select('phims.ten_phim', 'phongs.ten_phong', 'lich_chieus.*')
                           ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function changeStatusGheBan($id)
    {
        $ghe = GheBan::where('id', $id)->first();
        $ghe->trang_thai = !$ghe->trang_thai;
        $ghe->save();

        return response()->json([
            'status'    => true,
            'messages'  => 'Đã thay đổi trạng thái ghế bán thành công!'
        ]);
    }


}
