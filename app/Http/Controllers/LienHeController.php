<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLienHeRequest;
use App\Http\Requests\XoaLienHeRequest;
use App\Models\LienHe;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LienHeController extends Controller
{
    public function index()
    {
        return view('AdminRocker.page.lien_he.index');
    }

    public function getData()
    {
        $data = LienHe::get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function changeStatus($id)
    {
        $data = LienHe::where('id', $id)->first();
        $data->is_xu_ly = !$data->is_xu_ly;
        $data->save();

        return response()->json([
            'status'    => true,
            'messages'  => 'Đã thay đổi trạng thái thành công!'
        ]);
    }

    public function drop(XoaLienHeRequest $request)
    {
        LienHe::where('id', $request->id)->delete();

        return response()->json([
            'status'    => true,
            'messages'  => 'Đã xoá bỏ liên hệ thành công!'
        ]);
    }

    public function viewContact()
    {
        return view('client.contact');
    }

    public function actionContact(CreateLienHeRequest $request)
    {
        $data = $request->all();
        $user = Auth::guard('customer')->user();
        $data['email'] = $user->email;
        $data['ho_va_ten'] = $user->ho_va_ten;
        LienHe::create($data);
        Toastr::success('Đã gửi liên hệ thành công!');

        return redirect('/');
    }
}
