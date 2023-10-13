@extends('client.share.outside')
@section('content')
    <div class="contact-form-wrap">
        <div class="widget-title mb-50">
            <h5 class="title">Đổi Mật Khẩu</h5>
        </div>
        <div class="contact-form">
            <form action="/client/change-password" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="id" value="{{ $id }}">
                    </div>
                    <div class="col-md-12">
                        <input type="password" name="password" placeholder="Enter your old password *">
                    </div>
                    <div class="col-md-12">
                        <input type="password" name="password" placeholder="Enter your new password *">
                    </div>
                    <div class="col-md-12">
                        <input type="password" name="re_password" placeholder="Enter your new password again *">
                    </div>
                </div>
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
@endsection
