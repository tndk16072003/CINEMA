<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\GheBan;
use App\Models\GiaGhe;
use App\Models\Phim;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index()
    {
        $config = Config::orderByDESC('id')->first();
        $list_phim = Phim::where('tinh_trang', '!=', 0)->get();
        return view('client.page.cau_hinh.index', compact('config', 'list_phim'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Config::create($data);
        Toastr::success('Đã cập nhật thành công');
        return redirect()->back();
    }

    public function editFee(Request $request)
    {
        if ($request->gia_ghe_don == null) {
            $gia_ban = GiaGhe::where('loai_ghe', 1)->first();
            if ($gia_ban) {
                $data['gia_ghe'] = $request->gia_ghe_doi;
                $gia_ban->update($data);
            } else {
                GiaGhe::create([
                    'gia_ghe'   => $request->gia_ghe_doi,
                    'loai_ghe'      => 1
                ]);
            }
        } else if($request->gia_ghe_doi == null) {
            $gia_ban = GiaGhe::where('loai_ghe', 0)->first();
            if ($gia_ban) {
                $data['gia_ghe'] = $request->gia_ghe_don;
                $gia_ban->update($data);
            } else {
                GiaGhe::create([
                    'gia_ghe'   => $request->gia_ghe_don,
                    'loai_ghe'      => 0
                ]);
            }
        } else {
            $gia_ban_1 = GiaGhe::where('loai_ghe', 1)->first();
            if ($gia_ban_1) {
                $data1['gia_ghe'] = $request->gia_ghe_doi;
                $gia_ban_1->update($data1);
            } else {
                GiaGhe::create([
                    'gia_ghe'   => $request->gia_ghe_doi,
                    'loai_ghe'      => 1
                ]);
            }
            $gia_ban_2 = GiaGhe::where('loai_ghe', 0)->first();
            if ($gia_ban_2) {
                $data2['gia_ghe'] = $request->gia_ghe_don;
                $gia_ban_2->update($data2);
            } else {
                GiaGhe::create([
                    'gia_ghe'   => $request->gia_ghe_don,
                    'loai_ghe'      => 0
                ]);
            }
        }

        Toastr::success('Đã cập nhật giá thành công!');
        return redirect()->back();
    }
}
