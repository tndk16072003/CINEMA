<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ho_va_ten'     => 'required|min:5',
            'email'         => 'required|email|unique:admins,email',
            'password'      => 'required|min:6',
            're_password'   => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'ho_va_ten.required'    => 'Họ và tên không được để trống',
            'ho_va_ten.min'         => 'Họ và tên có ít nhất 5 ký tự',
            'email.email'           => 'Email không đúng định dạng',
            'email.required'        => 'Email không được để trống',
            'email.unique'          => 'Email đã được sử dụng',
            'password.required'     => 'Mật khẩu không được để trống',
            'password.min'          => 'Mật khẩu phải có ít nhất 6 ký tự',
            're_password.required'  => 'Mật khẩu xác nhận không được để trống',
            're_password.same'      => 'Mật khẩu xác nhận không giống',
        ];
    }
}
