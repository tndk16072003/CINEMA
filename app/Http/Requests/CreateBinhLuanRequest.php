<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBinhLuanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_bai_viet'   => 'required|exists:bai_viets,id',
            'noi_dung'      => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id_bai_viet.*' => 'Bài viết không tồn tại',
            'noi_dung.*'    => 'Nội dung không được bỏ trống',
        ];
    }
}
