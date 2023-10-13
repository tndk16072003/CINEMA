@extends('client.share.outside')
@section('content')
<div class="contact-form-wrap">
    <div class="widget-title mb-50">
        <h5 class="title">Đăng Ký</h5>
    </div>
    <div class="contact-form">
        <form action="/register" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    @error('ho_va_ten')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="text" name="ho_va_ten" placeholder="Enter Your Name *">
                </div>
                <div class="col-md-12">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="email" name="email" placeholder="Enter Your Email *">
                </div>
                <div class="col-md-12">
                    @error('so_dien_thoai')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="tel" name="so_dien_thoai"
                        placeholder="Enter Your Phone Number *">
                </div>
                <div class="col-md-12">
                    @error('dia_chi')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="text" name="dia_chi" min="5"
                        placeholder="Enter Your Address *">
                </div>
                <div class="col-md-12">
                    @error('ngay_sinh')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="date" name="ngay_sinh">
                </div>
                <div class="col-md-12">
                    @error('gioi_tinh')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
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
                        <option value="0">Giới Tính Nam</option>
                        <option value="1">Giới Tính Nữ</option>
                    </select>
                </div>
                <div class="col-md-12">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="password" name="password" placeholder="Enter your password *">
                </div>
                <div class="col-md-12">
                    @error('re_password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="password" name="re_password"
                        placeholder="Enter your password Again *">
                </div>
            </div>
            <div class="col-md-12">
                @error('g-recaptcha-response')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <div class="row">
                    <div class="col-md-6">
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-right">
                <button type="submit" class="btn">Đăng Ký</button>
            </div>
        </form>
    </div>
</div>
@endsection
