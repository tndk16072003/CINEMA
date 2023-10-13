<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\DeleteAdminRequest;
use App\Http\Requests\EditPasswordRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Requests\UpdateProfileAdminRequest;
use App\Models\Admin;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function doiMatKhau(EditPasswordRequest $request)
    {
        $pass = bcrypt($request->password);
        $admin = Admin::where('id', $request->id)->first();
        $admin->password = $pass;
        $admin->save();

        Toastr::success('Đã đổi mật khẩu thành công!');

        return redirect()->back();
    }

    public function updateProfile(UpdateProfileAdminRequest $request)
    {
        $data = $request->all();
        $admin = Admin::where('id', $request->id)->first();
        $admin->update($data);

        Toastr::success('Đã cập nhật thông tin thành công!');

        return redirect()->back();
    }

    public function profile()
    {
        $admin = Auth::guard('admin')->user();

        return view('AdminRocker.page.profile', compact('admin'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

    public function index()
    {
        return view('AdminRocker.page.Admin.index');
    }

    public function store(CreateAdminRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        Admin::create($data);

        return response()->json([
            'status'    => true,
            'messages'  => 'Đã thêm mới Admin thành công'
        ]);
    }

    public function getData()
    {
        $data = Admin::all();

        return response()->json([
            'data' => $data
        ]);
    }

    public function update(UpdateAdminRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->pasword);

        $admin = Admin::where('id', $request->id)->first();
        $admin->update($data);

        return response()->json([
            'status'    => true,
            'messages'  => 'Đã cập nhật thông tin Admin thành công'
        ]);
    }

    public function changeStatus($id)
    {
        $data = Admin::where('id', $id)->first();

        $data->trang_thai = !$data->trang_thai;
        $data->save();

        return response()->json([
            'status'    => true,
            'messages'  => 'Đã thay đổi trạng thái Admin thành công'
        ]);
    }

    public function drop(DeleteAdminRequest $request)
    {
        Admin::where('id', $request->id)->delete();

        return response()->json([
            'status'    => true,
            'messages'  => 'Đã xoá bỏ Admin thành công'
        ]);
    }

    public function editPassword(EditPasswordRequest $request)
    {
        $admin = Admin::where('id', $request->id)->first();
        $admin->password = bcrypt($request->password);
        $admin->save();

        return response()->json([
            'status'    => true,
            'messages'  => 'Đã thay đổi mật khẩu Admin thành công'
        ]);
    }

    public function viewLogin()
    {
        return view('AdminRocker.login');
    }

    public function actionLogin(Request $request)
    {
        $data = $request->all();
        $checkEmail = Auth::guard('admin')->attempt([
            'email'     => $data['email'],
            'password'  => $data['password']
        ]);

        $checkSDT = Auth::guard('admin')->attempt([
            'so_dien_thoai' => $data['email'],
            'password'      => $data['password']
        ]);

        if($checkEmail || $checkSDT) {
            Toastr::success('Đã đăng nhập thành công');
            return redirect('/admin/phong/index');
        } else {
            Toastr::error('Email hoặc mật khẩu không chính xác');
            return redirect('/admin/login');
        }
    }

}
