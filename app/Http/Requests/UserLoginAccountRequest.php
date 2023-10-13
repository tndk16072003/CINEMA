<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginAccountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'                 => 'required|email',
            'password'              => 'required|min:6',
            // 'g-recaptcha-response'  => 'required|captcha',
        ];
    }

    public function messages()
    {
        return [
            'email.email'               => 'Email không đúng định dạng',
            'email.required'            => 'Email không được bỏ trống',
            'password.*'                => 'Mật khẩu phải nhiều hơn 6 ký tự',
            'g-recaptcha-response.*'    => 'Vui lòng chọn vào recaptcha',
        ];
    }
}
