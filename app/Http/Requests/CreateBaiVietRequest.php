<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBaiVietRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'tieu_de'       => 'required|min:10',
            'mo_ta_ngan'    => 'required|min:30',
            'noi_dung'      => 'required|min:100',
            'hinh_anh'      => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tieu_de.*'         => 'Tiêu đề có ít nhất 10 ký tự và nhiều nhất 50 ký tự',
            'mo_ta_ngan.*'      => 'Mô tả ngắn phải có ít nhất 30 ký tự',
            'noi_dung.*'        => 'Nội dung bài viết có ít nhất 100 ký tự',
            'hinh_anh.*'        => 'Hình ảnh không được bỏ trống'
        ];
    }
}
