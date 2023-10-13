<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteKhachhangRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'    =>  'required|exists:customers,id'
        ];
    }

    public function messages()
    {
        return [
            'id.*'  =>  'Khách hàng không tồn tại'
        ];
    }
}
