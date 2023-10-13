<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoiMatKhauKhachHangRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'            => 'required|exists:customers,id',
            'password'      => 'required|min:6',
            're_password'   => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'id.*'                  => 'Khách hàng không tồn tại',
            'password.min'          => 'Mật khẩu phải nhiều hơn 6 ký tự',
            'password.required'     => 'Mật khẩu không được bỏ trống',
            're_password.*'         => 'Mật khẩu xác nhận không giống'
        ];
    }
}
