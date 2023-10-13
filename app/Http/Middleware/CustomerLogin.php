<?php

namespace App\Http\Middleware;

use Brian2694\Toastr\Facades\Toastr;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerLogin
{
    public function handle(Request $request, Closure $next)
    {
        $check = Auth::guard('customer')->check();
        if($check) {
            $user_login = Auth::guard('customer')->user();
            if($user_login->loai_tai_khoan <= 0) {
                Toastr::error('Tài khoản của bạn đã bị khoá!');
                return redirect('/login');
            }
            return $next($request);
        } else {
            Toastr::error('Chức năng này yêu cầu phải đăng nhập');
            return redirect('/login');
        }
    }
}
