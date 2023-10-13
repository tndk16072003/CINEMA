<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class XoaLienHeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'exists:lien_hes,id',
        ];
    }

    public function messages()
    {
        return [
            'id.*' => 'Liên hệ không tồn tại'
        ];
    }
}
