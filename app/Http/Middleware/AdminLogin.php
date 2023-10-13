<?php

namespace App\Http\Middleware;

use Brian2694\Toastr\Facades\Toastr;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLogin
{
    public function handle(Request $request, Closure $next)
    {
        $check = Auth::guard('admin')->check();

        if($check) {
            $user = Auth::guard('admin')->user();
            if($user->trang_thai == 0) {
                Toastr::error('Tài khoản của bạn đã bị vô hiệu hoá');
                return redirect('/admin/login');
            }
            return $next($request);
        } else {
            Toastr::error('Chức năng này cần phải đăng nhập');
            return redirect('/admin/login');
        }
    }
}
