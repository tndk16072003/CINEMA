@extends('client.share.outside')
@section('content')
<div class="contact-form-wrap">
    <div class="widget-title mb-50">
        <h5 class="title">Thông Tin Cá Nhân</h5>
    </div>
    <div class="contact-form">
        <form action="/client/profile" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <input value="{{ $user->id }}" type="hidden" name="id">
                </div>
                <div class="col-md-12">
                    <input value="{{ $user->ho_va_ten }}" type="text" name="ho_va_ten"
                        placeholder="Enter Your Name *">
                </div>
                <div class="col-md-12">
                    <input value="{{ $user->email }}" type="email" name="email"
                        placeholder="Enter Your Email *">
                </div>
                <div class="col-md-12">
                    <input value="{{ $user->so_dien_thoai }}" type="tel"
                        name="so_dien_thoai" placeholder="Enter Your Phone Number *">
                </div>
                <div class="col-md-12">
                    <input value="{{ $user->dia_chi }}" type="text" name="dia_chi"
                        min="5" placeholder="Enter Your Address *">
                </div>
                <div class="col-md-12">
                    <input value="{{ $user->ngay_sinh }}" type="date" name="ngay_sinh">
                </div>
                <div class="col-md-12">
                    <select name="gioi_tinh"
                        style="width: 100%;
                        border: 1px solid #1f1e24;
                        background: #1f1e24;
                        border-radius: 4px;
                        color: #bcbcbc;
                        box-shadow: 0px 1px 7px 0px rgba(0, 0, 0, 0.46);
                        font-weight: 500;
                        padding: 14px 25px;
                        margin-bottom: 30px;
                        transition: .3s linear;">
                        <option value="0" {{ $user->gioi_tinh == 0 ? 'selected' : '' }}>
                            Giới Tính Nam</option>
                        <option value="1" {{ $user->gioi_tinh == 1 ? 'selected' : '' }}>
                            Giới Tính Nữ</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12 text-right">
                <button type="submit" class="btn">Cập nhật</button>
            </div>
        </form>
    </div>
</div>
@endsection
