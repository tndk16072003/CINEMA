<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePhongRequest;
use App\Http\Requests\DeletePhongChieuRequest;
use App\Http\Requests\UpdatePhongRequest;
use App\Models\Ghe;
use App\Models\Phong;
use Illuminate\Http\Request;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

class PhongController extends Controller
{
    public function index()
    {
        return view('AdminRocker.page.phong_chieu.index');
    }

    public function store(CreatePhongRequest $request)
    {
        if ($request->hang_doc % 2 == 0) {
            $newPhong = Phong::create([
                'ten_phong'     => $request->ten_phong,
                'tinh_trang'    => $request->tinh_trang,
                'hang_ngang'    => $request->hang_ngang,
                'hang_doc'      => $request->hang_doc,
            ]);

            for ($dong = 1; $dong <= $newPhong->hang_ngang; $dong++) {
                if ($dong == $newPhong->hang_ngang) {
                    $chu = chr($dong + 64);
                    for ($cot = 1; $cot <= $newPhong->hang_doc / 2; $cot++) {
                        $ten_ghe = $chu . $cot;
                        Ghe::create([
                            'ten_ghe'       => $ten_ghe,
                            'tinh_trang'    => 1,
                            'id_phong'      => $newPhong->id,
                            'is_ghe_doi'    => 1,
                        ]);
                    }
                } else {
                    $chu = chr($dong + 64);
                    for ($cot = 1; $cot <= $newPhong->hang_doc; $cot++) {
                        $ten_ghe = $chu . $cot;
                        Ghe::create([
                            'ten_ghe'       => $ten_ghe,
                            'tinh_trang'    => 1,
                            'id_phong'      => $newPhong->id,
                            'is_ghe_doi'    => 0,
                        ]);
                    }
                }
            }

            return response()->json([
                'messages' => 'Đã thêm mới phòng chiếu thành công!',
                'status' => true
            ]);
        } else {
            return response()->json([
                'messages' => 'Số dãy ghế phải là số chẵn!',
                'status' => false
            ]);
        }
    }

    public function getData()
    {
        $phong = Phong::get();

        return response()->json([
            'data'  => $phong
        ]);
    }

    public function changeStatus($id)
    {
        $phong = Phong::where('id', $id)->first();
        $phong->tinh_trang = !$phong->tinh_trang;
        $phong->save();

        return response()->json([
            'messages' => 'Đã thay đổi trạng thái thành công!',
            'status' => true
        ]);
    }

    public function drop(DeletePhongChieuRequest $request)
    {
        $phong = Phong::where('id', $request->id)->first();
        Ghe::where('id_phong', $phong->id)->delete();
        $phong->delete();

        return response()->json([
            'messages' => 'Đã xoá phòng chiếu thành công!',
            'status' => true
        ]);
    }

    public function getDataGhe($id_phong)
    {
        $ghe = Ghe::where('id_phong', $id_phong)->get();
        $phong = Phong::where('id', $id_phong)->first();
        // dd($ghe->toArray());

        return response()->json([
            'data'  => $ghe,
            'phong' => $phong,
        ]);
    }

    public function changeStatusGhe(Request $request)
    {
        $ghe = Ghe::where('id', $request->id)->first();
        $ghe->tinh_trang = !$ghe->tinh_trang;
        $ghe->save();
    }

    public function update(UpdatePhongRequest $request)
    {
        $data = $request->all();
        $phong = Phong::where('id', $request->id)->first();
        // dd($phong);

        if ($request->hang_doc % 2 == 0) {
            $phong->update($data);
            Ghe::where('id_phong', $request->id)->delete();
            for ($dong = 1; $dong <= $phong->hang_ngang; $dong++) {
                if ($dong == $phong->hang_ngang) {
                    $chu = chr($dong + 64);
                    for ($cot = 1; $cot <= $phong->hang_doc / 2; $cot++) {
                        $ten_ghe = $chu . $cot;
                        Ghe::create([
                            'ten_ghe'       => $ten_ghe,
                            'tinh_trang'    => 1,
                            'id_phong'      => $phong->id,
                            'is_ghe_doi'    => 1,
                        ]);
                    }
                } else {
                    $chu = chr($dong + 64);
                    for ($cot = 1; $cot <= $phong->hang_doc; $cot++) {
                        $ten_ghe = $chu . $cot;
                        Ghe::create([
                            'ten_ghe'       => $ten_ghe,
                            'tinh_trang'    => 1,
                            'id_phong'      => $phong->id,
                            'is_ghe_doi'    => 0,
                        ]);
                    }
                }
            }

            return response()->json([
                'messages' => 'Đã cập nhật phòng chiếu thành công!',
                'status' => true
            ]);
        } else {
            return response()->json([
                'messages' => 'Số dãy ghế phải là số chẵn!',
                'status' => false
            ]);
        }
    }
}
