<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteLichChieuRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'    =>  'required|exists:lich_chieus,id'
        ];
    }

    public function messages()
    {
        return [
            'id.*'  =>  'Lịch chiếu này không tồn tại'
        ];
    }
}
