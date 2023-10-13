<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class XoaBinhLuanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'    => 'required|exists:comments,id'
        ];
    }

    public function messages()
    {
        return [
            'id.*'  => 'Bình luận không tồn tại',
        ];
    }
}
