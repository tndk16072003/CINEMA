<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class testController extends Controller
{
    public function index()
    {
        echo 'Năm nay bạn 20 tuổi<br><hr><br>';
        return view('index');
    }

    public function tinhDiem($chuyen_can, $giua_ky, $cuoi_ky)
    {
        $dtb = ($chuyen_can + $giua_ky + $cuoi_ky) / 3;
        echo 'Điểm chuyên cần: ' . $chuyen_can .'<br>';
        echo 'Điểm giữa kỳ: ' . $giua_ky .'<br>';
        echo 'Điểm cuối kỳ: ' . $cuoi_ky .'<br>';
        echo 'Điểm trung bình: ' . $dtb;
        return view('index');
    }
}
