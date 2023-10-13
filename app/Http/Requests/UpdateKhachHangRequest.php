<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKhachHangRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ho_va_ten'     => 'required|min:5',
            'email'         => 'required|email|unique:customers,email,' . $this->id,
            'so_dien_thoai' => 'required|numeric|digits:10',
            'ngay_sinh'     => 'required|date',
            'gioi_tinh'     => 'required|numeric|between:0,1',
            'dia_chi'       => 'required|min:5',
            'password'      => 'required|min:6',
            're_password'   => 'same:password',
        ];
    }

    public function messages()
    {
        return [
            'ho_va_ten.required'    => 'Họ và tên không được để trống',
            'ho_va_ten.min'         => 'Họ và tên phải nhiều hơn 5 ký tự',
            'email.required'        => 'Email không được để trống',
            'email.email'           => 'Email không đúng định dạng',
            'email.unique'          => 'Email đã được sử dụng',
            'so_dien_thoai.8'       => 'Số điện thoại phải là dãy đúng 10 chữ số',
            'ngay_sinh.*'           => 'Ngày sinh không được để trống',
            'gioi_tinh.*'           => 'Giới tính phải được chọn đúng yêu cầu',
            'dia_chi.required'      => 'Địa chỉ không được để trống',
            'dia_chi.min'           => 'Địa chỉ phải nhiều hơn 5 ký tự',
            'password.required'     => 'Mật khẩu không được để trống',
            'password.min'          => 'Mật khẩu phải nhiều hơn 6 ký tự',
            're_password.*'         => 'Mật khẩu xác nhận không giống'
        ];
    }
}
