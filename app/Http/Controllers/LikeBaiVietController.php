<?php

namespace App\Http\Controllers;

use App\Models\baiViet;
use App\Models\likeBaiViet;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikeBaiVietController extends Controller
{
    public function likeBaiViet($id_bv, $id_user)
    {
        // dd($id_bv, $id_user);
        $check = likeBaiViet::where('id_user_like', $id_user)
                            ->where('id_bai_viet', $id_bv)
                            ->first();
                            // dd($check->toArray());
        if($check) {
            if($check->tinh_trang == 1) {
                $check->tinh_trang = 0;
                $check->save();
            } else {
                $check->tinh_trang = 1;
                $check->save();
            }
        } else {
            likeBaiViet::create([
                'id_bai_viet' => $id_bv,
                'id_user_like' => $id_user,
                'tinh_trang' => 1
            ]);
        }

        return response()->json([
            'status' => true,
        ]);
    }
}
