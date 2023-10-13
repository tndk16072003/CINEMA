@extends('client.share.master')
@section('content')
    <!-- pricing-area -->
    <section class="pricing-area pricing-bg" data-background="/assets_client/img/bg/pricing_bg.jpg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title title-style-three text-center mb-70">
                        <span class="sub-title">our pricing plans</span>
                        <h2 class="title">Our Pricing Strategy</h2>
                    </div>
                </div>
            </div>
            <div class="pricing-box-wrap">
                <div class="row justify-content-center">
                    @for ($i = 0; $i < 3; $i++)
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="pricing-box-item mb-30">
                            <div class="pricing-top">
                                <h6>ghế đơn</h6>
                                <div class="price">
                                    @if ($i == 0)
                                    <h5 style="color: black">{{number_format($gia_ghe_don, 0, '', '.')}} &#8363;</h5>
                                    @elseif ($i == 1)
                                    <h5 style="color: black">{{number_format($gia_ghe_don + 15000, 0, '', '.')}} &#8363;</h5>
                                    @else
                                    <h5 style="color: black">{{number_format($gia_ghe_don + 10000, 0, '', '.')}} &#8363;</h5>
                                    @endif
                                    <span>Vé</span>
                                </div>
                            </div>
                            <div class="pricing-list">
                                <ul>
                                    <li class="quality"><i class="fas fa-check"></i> Màn hình chiếu <span>Good</span></li>
                                    <li><i class="fas fa-check"></i> Chất lượng hình ảnh
                                        @if ($i == 0)
                                        <span>2D</span>
                                        @elseif ($i == 1)
                                        <span>3D</span>
                                        @else
                                        <span>4K</span>
                                        @endif
                                    </li>
                                    <li><i class="fas fa-check"></i> Số màn hình chiếu <span>1</span></li>
                                    <li><i class="fas fa-check"></i> Thời gian trì hoãn</li>
                                </ul>
                            </div>
                            <div class="pricing-btn">
                                <a href="/phim-dang-chieu" class="btn">Buy Now</a>
                            </div>
                        </div>
                    </div>
                    @endfor
                    @for ($i = 0; $i < 3; $i++)
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="pricing-box-item mb-30">
                            <div class="pricing-top">
                                <h6>ghế đôi</h6>
                                <div class="price">
                                    @if ($i == 0)
                                    <h5 style="color: black">{{number_format($gia_ghe_doi, 0, '', '.')}} &#8363;</h5>
                                    @elseif ($i == 1)
                                    <h5 style="color: black">{{number_format($gia_ghe_doi + 15000, 0, '', '.')}} &#8363;</h5>
                                    @else
                                    <h5 style="color: black">{{number_format($gia_ghe_doi + 10000, 0, '', '.')}} &#8363;</h5>
                                    @endif
                                    <span>Vé</span>
                                </div>
                            </div>
                            <div class="pricing-list">
                                <ul>
                                    <li class="quality"><i class="fas fa-check"></i> Màn hình chiếu <span>Good</span></li>
                                    <li><i class="fas fa-check"></i> Chất lượng hình ảnh
                                        @if ($i == 0)
                                        <span>2D</span>
                                        @elseif ($i == 1)
                                        <span>3D</span>
                                        @else
                                        <span>4K</span>
                                        @endif
                                    </li>
                                    <li><i class="fas fa-check"></i> Số màn hình chiếu <span>1</span></li>
                                    <li><i class="fas fa-check"></i> Thời gian trì hoãn</li>
                                </ul>
                            </div>
                            <div class="pricing-btn">
                                <a href="/phim-dang-chieu" class="btn">Buy Now</a>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </section>
    <!-- pricing-area-end -->

    <!-- newsletter-area -->
    <section class="newsletter-area newsletter-bg" data-background="/assets_client/img/bg/newsletter_bg.jpg">
        <div class="container">
            <div class="newsletter-inner-wrap">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="newsletter-content">
                            <h4>Trial Start First 30 Days.</h4>
                            <p>Enter your email to create or restart your membership.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <form action="#" class="newsletter-form">
                            <input type="email" required placeholder="Enter your email">
                            <button class="btn">get started</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- newsletter-area-end -->
@endsection
@section('js')

@endsection
