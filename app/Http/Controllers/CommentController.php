<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBinhLuanRequest;
use App\Http\Requests\XoaBinhLuanRequest;
use App\Models\Comment;
use App\Models\Customer;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        return view('AdminRocker.page.binh_luan.index');
    }

    public function store(CreateBinhLuanRequest $request)
    {
        $data = $request->all();
        $user = Auth::guard('customer')->user();
        $data['id_nguoi_binh_luan'] = $user->id;
        $data['ho_va_ten']          = $user->ho_va_ten;
        $data['avatar']             = '/assets_client/img/blog/comment_avatar01.jpg';
        $data['email']              = $user->email;
        if($request->id_binh_luan) {
            $data['id_binh_luan'] = $request->id_binh_luan;
        }
        Comment::create($data);
        Toastr::success('Đã gửi thành công');
        return redirect()->back();
    }

    public function getData()
    {
        $data = Comment::orderBy('id', 'DESC')
                         ->get();
        $user = Customer::get();
        return response()->json([
            'data' => $data,
            'user' => $user
        ]);
    }

    public function drop(XoaBinhLuanRequest $request)
    {
        Comment::where('id', $request->id)->delete();

        return response()->json([
            'status'    => true,
            'messages'  => 'Đã xoá bỏ thành công',
        ]);
    }
}
