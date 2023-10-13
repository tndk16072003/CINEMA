@extends('client.share.master')

@section('content')
<section class="blog-area blog-bg" data-background="/assets_client/img/bg/contact_bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="contact-form-wrap">
                    <div class="widget-title mb-50">
                        <h5 class="title">Liên Hệ</h5>
                    </div>
                    <div class="contact-form">
                        <form action="/client/lien-he" method="POST">
                            @csrf
                            {{-- <div class="row">
                                <div class="col-md-6">
                                    <input name="ho_va_ten" type="text" placeholder="You Name *">
                                </div>
                                <div class="col-md-6">
                                    <input name="email" type="email" placeholder="You  Email *">
                                </div>
                            </div> --}}
                            <input name="tieu_de" type="text" placeholder="Subject *">
                            <textarea name="noi_dung" placeholder="Type Your Message..."></textarea>
                            <div class="text-right">
                                <button type="submit" class="btn">Gửi Tin</button>
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
