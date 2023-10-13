<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAccountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ho_va_ten'             => 'required|min:5',
            'email'                 => 'required|email|unique:customers,email',
            'password'              => 'required|min:6',
            're_password'           => 'required|same:password',
            'so_dien_thoai'         => 'required|numeric|digits:10',
            'dia_chi'               => 'required|min:5',
            'ngay_sinh'             => 'required|date',
            'gioi_tinh'             => 'required|numeric|between:0,1',
        ];
    }

    public function messages()
    {
        return [
            'ho_va_ten.*'               => 'Họ và tên không được để trống',
            'email.email'               => 'Email không đúng định dạng',
            'email.required'            => 'Email không được bỏ trống',
            'email.unique'              => 'Email đã được sử dụng',
            'password.min'              => 'Mật khẩu phải nhiều hơn 6 ký tự',
            'password.required'         => 'Mật khẩu không được bỏ trống',
            're_password.*'             => 'Mật khẩu xác nhận không giống',
            'so_dien_thoai.*'           => 'Số điện thoại phải là một dãy có 10 chữ số',
            'dia_chi.*'                 => 'Địa chỉ phải nhiều hơn 5 ký tự',
            'ngay_sinh.*'               => 'Ngày sinh không được bỏ trống',
            'gioi_tinh.*'               => 'Giới tính phải chọn đúng theo yêu cầu',
        ];
    }
}
