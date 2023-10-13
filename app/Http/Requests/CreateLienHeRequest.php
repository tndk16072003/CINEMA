<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLienHeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // 'ho_va_ten' => 'required|min:5',
            // 'email'     => 'required|exists:customers,email',
            'tieu_de'   => 'required|between:10,60',
            'noi_dung'  => 'required|min:20'
        ];
    }

    public function messages()
    {
        return [
            'ho_va_ten.*'       => 'Họ và tên phải nhiều hơn 5 ký tự',
            'email.required'    => 'Email không được để trống',
            'email.exists'      => 'Email không tồn tại',
            'tieu_de.*'         => 'Tiêu đề phải từ 10 đến 60 ký tự',
            'noi_dung.*'        => 'Nội dung phải trên 20 ký tự'
        ];
    }
}
