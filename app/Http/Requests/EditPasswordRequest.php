<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password'      => 'required|min:6',
            're_password'   => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'password.required'     => 'Mật khẩu không được để trống',
            'password.min'          => 'Mật khẩu phải có ít nhất 6 ký tự',
            're_password.required'  => 'Mật khẩu xác nhận không được để trống',
            're_password.same'      => 'Mật khẩu xác nhận không giống',
        ];
    }
}
