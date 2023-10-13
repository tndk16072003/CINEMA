<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhimRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'                =>  'required|exists:phims,id',
            'ten_phim'          => 'required',
            'slug_ten_phim'     => 'required|unique:phims,slug_ten_phim,' . $this->id,
            'dao_dien'          => 'required',
            'dien_vien'         => 'required',
            'the_loai'          => 'required',
            'thoi_luong'        => 'required|numeric|min:60',
            'ngay_khoi_chieu'   => 'required|date',
            'avatar'            => 'required',
            'mo_ta'             => 'required|min:20',
            'trailer'           => 'required',
            'tinh_trang'        => 'required|numeric',
            'chat_luong'        => 'required|numeric',
            'lua_tuoi'          => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'ten_phim.*'             => 'Tên phim không được để trống',
            'slug_ten_phim.*'        => 'Phim đã tồn tại',
            'dao_dien.*'             => 'Đạo diễn không được bỏ trống',
            'dien_vien.*'            => 'Diễn viên không được bỏ trống',
            'the_loai.*'             => 'Thể loại không được bỏ trống',
            'thoi_luong.*'           => 'Thời lượng phải là một số lớn hơn 60',
            'ngay_khoi_chieu.*'      => 'Ngày khởi chiếu phải được dịnh dạng ngày/tháng/năm',
            'avatar.*'               => 'Avatar không được để trống',
            'mo_ta.required'         => 'Mô tả phim không được để trống',
            'mo_ta.min'              => 'Mô tả phim phải nhiều hơn 20 kí tự',
            'trailer.*'              => 'Trailer không được bỏ trống',
            'tinh_trang.*'           => 'Tình trạng phim phải chọn đúng yêu cầu',
            'chat_luong.*'           => 'Chất lượng phim phải chọn đúng yêu cầu',
            'lua_tuoi.*'             => 'Lứa tuổi khán giả phải chọn đúng yêu cầu',
        ];
    }
}
