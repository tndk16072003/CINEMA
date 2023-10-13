<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKhachHangRequest;
use App\Http\Requests\DeleteKhachhangRequest;
use App\Http\Requests\DoiMatKhauKhachHangRequest;
use App\Http\Requests\EditPasswordRequest;
use App\Http\Requests\RegisterAccountRequest;
use App\Http\Requests\UpdateKhachHangRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UserLoginAccountRequest;
use App\Jobs\SendMailJob;
use App\Jobs\sendMailKichHoat;
use App\Jobs\sendMailUpdatePassword;
use App\Mail\MailKichHoatTaiKhoan;
use App\Models\Customer;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use function Ramsey\Uuid\v1;

class CustomerController extends Controller
{
    public function viewInputPassword($hash)
    {
        return view('client.forgot_password_input_password', compact('hash'));
    }

    public function actionInputPassword(EditPasswordRequest $request)
    {
        $user = Customer::where('hash_reset', $request->hash_reset)->first();
        $pass = bcrypt($request->password);
        $user->password     = $pass;
        $user->hash_reset   = null;
        $user->save();

        Toastr::success('Đã cập nhật mật khẩu thành công!');
        return redirect('/login');
    }

    public function actionInputEmail(Request $request)
    {
        $value = $request->email;

        $user = Customer::where('email', $value)
                        ->orWhere('so_dien_thoai', $value)
                        ->first();
        // dd($user->id);
        if($user) {
            $hash = Str::uuid();
            $user->hash_reset = $hash;
            $user->save();

            $data['ho_va_ten']  = $user->ho_va_ten;
            $data['email']      = $user->email;
            $data['hash_reset'] = $hash;
            // dd($data);
            sendMailUpdatePassword::dispatch($data);

            Toastr::success('Vui lòng kiểm tra email!');
            return redirect('/login');
        } else {
            Toastr::error('Tài khoản không tồn tại!');
        }
        return redirect()->back();
    }

    public function viewChangePassword()
    {
        $id = Auth::guard('customer')->user()->id;
        return view('client.change_password', compact('id'));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $id = Auth::guard('customer')->user()->id;
        $account = Customer::find($id);
        $account->update($data);

        Toastr::success('Đã cập nhật thông tin thành công');

        return redirect()->back();
    }

    public function profile()
    {
        $user = Auth::guard('customer')->user();
        // dd($user->toArray());
        return view('client.profile', compact('user'));
    }

    public function index()
    {
        return view('AdminRocker.page.khach_hang.index');
    }

    public function store(CreateKhachHangRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['hash_mail'] = Str::uuid();
        Customer::create($data);

        return response()->json([
            'status' => true,
            'messages' => 'Đã thêm mới khách hàng thành công!'
        ]);
    }

    public function update(UpdateKhachHangRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        $account = Customer::where('id', $request->id)->first();
        $account->update($data);

        return response()->json([
            'status' => true,
            'messages' => 'Đã cập nhật thông tin thành công!'
        ]);
    }

    public function doiMatKhau(DoiMatKhauKhachHangRequest $request)
    {
        $account = Customer::where('id', $request->id)->first();
        $account['password'] = bcrypt($request->password);
        $account->save();

        return response()->json([
            'status' => true,
            'messages' => 'Đã đổi mật khẩu khách hàng thành công!'
        ]);
    }

    public function actionChangePassword(DoiMatKhauKhachHangRequest $request)
    {
        $account = Customer::where('id', $request->id)->first();
        $account['password'] = bcrypt($request->password);
        $account->save();

        Toastr::success('Đã đổi mật khẩu thành công!');
        return redirect('/');
    }

    public function drop(DeleteKhachhangRequest $request)
    {
        Customer::where('id', $request->id)->delete();

        return response()->json([
            'status' => true,
            'messages' => 'Đã xoá bỏ khách hàng thành công!'
        ]);
    }

    public function getData()
    {
        $data = Customer::get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function changeStatus($id)
    {
        $account = Customer::where('id', $id)->first();
        if($account->loai_tai_khoan == -1) {
            $account->loai_tai_khoan = 1;
        } else {
            $account->loai_tai_khoan = -1;
        }
        $account->save();

        return response()->json([
            'status' => true,
            'messages' => 'Đã thay đổi trạng thái thành công!'
        ]);
    }


    public function viewLogin()
    {
        return view('client.login');
    }

    public function actionLogin(UserLoginAccountRequest $request)
    {
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        $check = Auth::guard('customer')->attempt($data);
        if($check) {
            $user = Auth::guard('customer')->user();
            if($user->loai_tai_khoan == 0) {
                Toastr::warning('Tài khoản chưa kích hoạt');

                $dataMail['ho_va_ten'] = $user->ho_va_ten;
                $dataMail['hash_mail'] = $user->hash_mail;
                $dataMail['email'] = $user->email;
                sendMailKichHoat::dispatch($dataMail);

                Auth::guard('customer')->logout();
            } else if($user->loai_tai_khoan == -1) {
                Toastr::error('Tài khoản của bạn đã bị khoá!');
                Auth::guard('customer')->logout();
            } else {
                Toastr::success('Đã đăng nhập thành công!');
            }
        } else {
            Toastr::error('Email hoặc mật khẩu không đúng');
        }
        return redirect('/');
    }

    public function viewRegister()
    {
        return view('client.register');
    }

    public function actionRegister(RegisterAccountRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['hash_mail'] = Str::uuid();
        $account = Customer::create($data);
        // dd($account->password);
        $dataMail['ho_va_ten'] = $account->ho_va_ten;
        $dataMail['hash_mail'] = $account->hash_mail;
        $dataMail['email'] = $account->email;

        sendMailKichHoat::dispatch($dataMail);

        Toastr::success('Đã đăng ký tài khoản thành công!');
        Toastr::info('Vui lòng kiểm tra mail để kích hoạt tài khoản của bạn');

        return redirect('/');
    }

    public function actionActive($hash)
    {
        $check = Customer::where('hash_mail', $hash)->first();

        if($check) {
            $check->hash_mail = null;
            $check->loai_tai_khoan = 1;
            $check->save();
            Toastr::success('Đã kích hoạt tài khoản thành công!');
        } else {
            Toastr::errror('Thông tin không chính xác!');
        }

        return redirect('/login');
    }

    public function logout()
    {
        Auth::guard('customer')->logout();

        return redirect('/');
    }
}
