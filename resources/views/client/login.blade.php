@extends('client.share.outside')
@section('content')
<div class="contact-form-wrap">
    <div class="widget-title mb-50">
        <h5 class="title">Đăng Nhập</h5>
    </div>
    <div class="contact-form">
        <form action="/login" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <input id="email" type="email" name="email" placeholder="Enter your email *">
                </div>
                <div class="col-md-12">
                    <input id="password" type="password" name="password" placeholder="Enter your password *">
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                    </div>
                    <div class="col-md-6 text-right" >
                        <span><a class="mr-3" href="/register" style="color: #e4d804; font-family: Arial, Helvetica, sans-serif; font-size: 16px">Chưa có tài khoản</a></span>
                        <span><a href="/forgot-password" style="color: #e4d804; font-family: Arial, Helvetica, sans-serif; font-size: 16px">Quên mật khẩu</a></span>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-right">
                <button type="submit" class="btn">Đăng Nhập</button>
            </div>
        </form>
    </div>
</div>
@endsection

