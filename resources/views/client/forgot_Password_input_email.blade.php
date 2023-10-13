@extends('client.share.master')

@section('content')
<section class="contact-area contact-bg" data-background="/assets_client/img/bg/contact_bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="contact-form-wrap">
                    <div class="widget-title mb-50">
                        <h5 class="title">Đổi Mật Khẩu</h5>
                    </div>
                    <div class="contact-form">
                        <form action="/forgot-password/input-email" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <input id="value" type="text" name="email" placeholder="Enter your email or phone number *">
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn">Tiếp theo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="widget-title mb-50">
                    <h5 class="title">Information</h5>
                </div>
                <div class="contact-info-wrap">
                    <p><span>Find solutions :</span> to common problems, or get help from a support agent industry's standard .</p>
                    <div class="contact-info-list">
                        <ul>
                            <li>
                                <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                                <p><span>Address :</span> W38 Park Road New York</p>
                            </li>
                            <li>
                                <div class="icon"><i class="fas fa-phone-alt"></i></div>
                                <p><span>Phone :</span> (09) 123 854 365</p>
                            </li>
                            <li>
                                <div class="icon"><i class="fas fa-envelope"></i></div>
                                <p><span>Email :</span> support@movflx.com</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('button').on('click', function() {
            if($('#value').val() == '') {
                $('button').attr('disabled', 'disabled');
            }
        });
        $('input').on('keyup', function() {
            $('button').attr('disabled', false);
        });
    });
</script>
@endsection
