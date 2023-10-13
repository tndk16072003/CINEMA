<!doctype html>
<html class="no-js" lang="">

<head>
    @include('client.share.css')
</head>

<body>

    <!-- preloader -->
    {{-- <div id="preloader">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <img src="/assets_client/img/preloader.svg" alt="">
            </div>
        </div>
    </div> --}}
    <!-- preloader-end -->

    <!-- Scroll-top -->
    <button class="scroll-top scroll-to-target" data-target="html">
        <i class="fas fa-angle-up"></i>
    </button>
    <!-- Scroll-top-end-->

    <!-- header-area -->
    @include('client.share.header')
    <!-- header-area-end -->


    <!-- main-area -->
    <main>

        <!-- slider-area -->
        <section class="slider-area slider-bg"
            style="background-image: url('{{ isset($config->banner) ? $config->banner : '/assets_client/img/banner/s_slider_bg.jpg' }}')">
            <div class="slider-active">
                @if (isset($phim1))
                    <div class="slider-item">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6 order-0 order-lg-2">
                                    <div class="slider-img text-center text-lg-right" data-animation="fadeInRight"
                                        data-delay="1s">
                                        <img src="{{ $phim1->avatar }}" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="banner-content">
                                        <h2 class="title" data-animation="fadeInUp" data-delay=".2s">
                                            {{ $phim1->ten_phim }}</h2>
                                        <h6 class="sub-title" data-animation="fadeInUp" data-delay=".4s">
                                            {{ $phim1->dao_dien }}</h6>
                                        <div class="banner-meta" data-animation="fadeInUp" data-delay=".6s">
                                            <ul>
                                                <li class="quality">
                                                    @if ($phim1->chat_luong == 0)
                                                        <span>2D</span>
                                                    @elseif ($phim1->chat_luong == 1)
                                                        <span>3D</span>
                                                    @elseif ($phim1->chat_luong == 2)
                                                        <span>1080p</span>
                                                    @else
                                                        <span>4K</span>
                                                    @endif
                                                </li>
                                                <li class="category">
                                                    <a href="/search/{{ $phim1->the_loai }}">{{ $phim1->the_loai }}</a>
                                                </li>
                                                <li class="release-time">
                                                    <span><i
                                                            class="far fa-calendar-alt"></i>{{ date('d/m/Y', strtotime($phim1->ngay_khoi_chieu)) }}</span>
                                                    <span><i class="far fa-clock"></i> {{ $phim1->thoi_luong }} phút</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="{{ $phim1->trailer }}" class="banner-btn btn popup-video"
                                            data-animation="fadeInUp" data-delay=".8s"><i class="fas fa-play"></i> Watch
                                            Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($phim2))
                    <div class="slider-item">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6 order-0 order-lg-2">
                                    <div class="slider-img text-center text-lg-right" data-animation="fadeInRight"
                                        data-delay="1s">
                                        <img src="{{ $phim2->avatar }}" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="banner-content">
                                        <h2 class="title" data-animation="fadeInUp" data-delay=".2s">
                                            {{ $phim2->ten_phim }}</h2>
                                        <h6 class="sub-title" data-animation="fadeInUp" data-delay=".4s">
                                            {{ $phim2->dao_dien }}</h6>
                                        <div class="banner-meta" data-animation="fadeInUp" data-delay=".6s">
                                            <ul>
                                                <li class="quality">
                                                    @if ($phim2->chat_luong == 0)
                                                        <span>2D</span>
                                                    @elseif ($phim2->chat_luong == 1)
                                                        <span>3D</span>
                                                    @elseif ($phim2->chat_luong == 2)
                                                        <span>1080p</span>
                                                    @else
                                                        <span>4K</span>
                                                    @endif
                                                </li>
                                                <li class="category">
                                                    <a
                                                        href="/search/{{ $phim2->the_loai }}">{{ $phim2->the_loai }}</a>
                                                </li>
                                                <li class="release-time">
                                                    <span><i class="far fa-calendar-alt"></i>
                                                        {{ $phim2->ngay_khoi_chieu }}</span>
                                                    <span><i class="far fa-clock"></i> {{ $phim2->thoi_luong }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="{{ $phim2->trailer }}" class="banner-btn btn popup-video"
                                            data-animation="fadeInUp" data-delay=".8s"><i class="fas fa-play"></i> Watch
                                            Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($phim3))
                    <div class="slider-item">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6 order-0 order-lg-2">
                                    <div class="slider-img text-center text-lg-right" data-animation="fadeInRight"
                                        data-delay="1s">
                                        <img src="{{ $phim3->avatar }}" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="banner-content">
                                        <h2 class="title" data-animation="fadeInUp" data-delay=".2s">
                                            {{ $phim3->ten_phim }}</h2>
                                        <h6 class="sub-title" data-animation="fadeInUp" data-delay=".4s">
                                            {{ $phim3->dao_dien }}</h6>
                                        <div class="banner-meta" data-animation="fadeInUp" data-delay=".6s">
                                            <ul>
                                                <li class="quality">
                                                    @if ($phim3->chat_luong == 0)
                                                        <span>2D</span>
                                                    @elseif ($phim3->chat_luong == 1)
                                                        <span>3D</span>
                                                    @elseif ($phim3->chat_luong == 2)
                                                        <span>1080p</span>
                                                    @else
                                                        <span>4K</span>
                                                    @endif
                                                </li>
                                                <li class="category">
                                                    <a
                                                        href="/search/{{ $phim3->the_loai }}">{{ $phim3->the_loai }}</a>
                                                </li>
                                                <li class="release-time">
                                                    <span><i class="far fa-calendar-alt"></i>
                                                        {{ $phim3->ngay_khoi_chieu }}</span>
                                                    <span><i class="far fa-clock"></i> {{ $phim3->thoi_luong }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="{{ $phim3->trailer }}" class="banner-btn btn popup-video"
                                            data-animation="fadeInUp" data-delay=".8s"><i class="fas fa-play"></i>
                                            Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
        <!-- slider-area-end -->

        <!-- up-coming-movie-area -->
        <section class="ucm-area ucm-bg2" data-background="/assets_client/img/bg/ucm_bg02.jpg">
            <div class="container">
                <div class="row align-items-end mb-55">
                    <div class="col-lg-6">
                        <div class="section-title title-style-three text-center text-lg-left">
                            {{-- <span class="sub-title">ONLINE STREAMING</span> --}}
                            <h2 class="title">Phim Mới Phát Hành</h2>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ucm-nav-wrap">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="dangChieu-tab" data-toggle="tab"
                                        href="#dangChieu" role="tab" aria-controls="dangChieu"
                                        aria-selected="true">Phim Đang Chiếu</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="sapChieu-tab" data-toggle="tab" href="#sapChieu"
                                        role="tab" aria-controls="sapChieu" aria-selected="false">Phim Sắp Khởi
                                        Chiếu</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="dangChieu" role="tabpanel"
                        aria-labelledby="dangChieu-tab">
                        <div class="ucm-active-two owl-carousel">
                            @foreach ($list_phim as $key => $value)
                                @if ($value->tinh_trang == 1)
                                    <div class="movie-item movie-item-two mb-30">
                                        <div class="movie-poster">
                                            <a href="/chi-tiet-phim/{{ $value->slug_ten_phim }}-{{ $value->id }}"><img
                                                    height="285px" width="195px" src="{{ $value->avatar }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="movie-content">
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <h5 class="title"><a
                                                    href="/chi-tiet-phim/{{ $value->slug_ten_phim }}-{{ $value->id }}">{{ $value->ten_phim }}</a>
                                            </h5>
                                            <span class="rel">{{ $value->dao_dien }}</span>
                                            <div class="movie-content-bottom">
                                                <ul>
                                                    <li class="tag">
                                                        <a href="#">HD</a>
                                                        <a href="#">English</a>
                                                    </li>
                                                    <li>
                                                        <span class="like"><i class="fas fa-thumbs-up"></i>
                                                            3.5</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="sapChieu" role="tabpanel" aria-labelledby="sapChieu-tab">
                        <div class="ucm-active-two owl-carousel">
                            @foreach ($list_phim as $key => $value)
                                @if ($value->tinh_trang == 2)
                                    <div class="movie-item movie-item-two mb-30">
                                        <div class="movie-poster">
                                            <a href="/chi-tiet-phim/{{ $value->slug_ten_phim }}-{{ $value->id }}"><img
                                                    src="{{ $value->avatar }}" width="195px" height="285px"
                                                    alt=""></a>
                                        </div>
                                        <div class="movie-content">
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <h5 class="title"><a
                                                    href="/chi-tiet-phim/{{ $value->slug_ten_phim }}-{{ $value->id }}">{{ $value->ten_phim }}</a>
                                            </h5>
                                            <span class="rel">{{ $value->dao_dien }}</span>
                                            <div class="movie-content-bottom">
                                                <ul>
                                                    <li class="tag">
                                                        <a href="#">HD</a>
                                                        <a href="#">English</a>
                                                    </li>
                                                    <li>
                                                        <span class="like"><i
                                                                class="fas fa-thumbs-up"></i>3.5</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- up-coming-movie-area-end -->

        <!-- gallery-area -->
        <div class="gallery-area position-relative">
            <div class="gallery-bg"></div>
            <div class="container-fluid p-0 fix">
                <div class="row gallery-active">
                    @foreach ($list_banner_phim as $k => $v)
                        <div class="col-12">
                            <div class="gallery-item">
                                <img width="1070px" height="530px" src="{{ $v->banner_phim }}" alt="">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="slider-nav"></div>
        </div>
        <!-- gallery-area-end -->

        <!-- services-area -->
        <section class="services-area services-bg-two" data-background="/assets_client/img/bg/services_bg02.jpg">
            {{-- <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-6 order-0 order-lg-2">
                        <div class="services-img-wrap">
                            <img src="/assets_client/img/images/services_img02.jpg" alt="">
                            <a href="/assets_client/img/images/services_img02.jpg" class="download-btn"
                                download>Download <img src="/assets_client/fonts/download.svg" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        <div class="services-content-wrap">
                            <div class="section-title mb-40">
                                <span class="sub-title">ONLINE STREAMING</span>
                                <h2 class="title">Download Your Shows Watch Offline.</h2>
                            </div>
                            <div class="services-list">
                                <ul>
                                    <li>
                                        <div class="icon">
                                            <i class="flaticon-television"></i>
                                        </div>
                                        <div class="content">
                                            <h5>Enjoy on Your TV.</h5>
                                            <p>Lorem ipsum dolor sit amet, consecetur adipiscing elit, sed do eiusmod
                                                tempor.</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <i class="flaticon-video-camera"></i>
                                        </div>
                                        <div class="content">
                                            <h5>Watch Everywhere.</h5>
                                            <p>Lorem ipsum dolor sit amet, consecetur adipiscing elit, sed do eiusmod
                                                tempor.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </section>
        <!-- services-area-end -->

        <!-- top-rated-movie -->
        <section class="top-rated-movie tr-movie-bg2" data-background="/assets_client/img/bg/tr_movies_bg.jpg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title title-style-three text-center mb-70">
                            {{-- <span class="sub-title">top rated movies</span> --}}
                            <h2 class="title">Top Phim Nổi Bật</h2>
                        </div>
                    </div>
                </div>
                <div class="row movie-item-row">
                    @foreach ($list_phim as $key => $value)
                        @if ($value->tinh_trang == 1)
                            <div class="custom-col-">
                                <div class="movie-item movie-item-two">
                                    <div class="movie-poster">
                                        <img width="195px" height="285px" src="{{ $value->avatar }}"
                                            alt="">
                                        <ul class="overlay-btn">
                                            <li><a href="{{ $value->trailer }}" class="popup-video btn">Xem Ngay</a>
                                            </li>
                                            <li><a href="/chi-tiet-phim/{{ $value->slug_ten_phim }}-{{ $value->id }}"
                                                    class="btn">Chi Tiết</a></li>
                                        </ul>
                                    </div>
                                    <div class="movie-content">
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <h5 class="title"><a
                                                href="/chi-tiet-phim/{{ $value->slug_ten_phim }}-{{ $value->id }}">{{ $value->ten_phim }}</a>
                                        </h5>
                                        <span class="rel">{{ $value->dao_dien }}</span>
                                        <div class="movie-content-bottom">
                                            <ul>
                                                <li class="tag">
                                                    <a href="#">HD</a>
                                                    <a href="#">English</a>
                                                </li>
                                                <li>
                                                    <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
        <!-- top-rated-movie-end -->

        <!-- pricing-area -->
        {{-- <section class="pricing-area pricing-bg" data-background="/assets_client/img/bg/pricing_bg.jpg">
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
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="pricing-box-item mb-30">
                        <div class="pricing-top">
                            <h6>premium</h6>
                            <div class="price">
                                <h3>$7.99</h3>
                                <span>Monthly</span>
                            </div>
                        </div>
                        <div class="pricing-list">
                            <ul>
                                <li class="quality"><i class="fas fa-check"></i> Video quality <span>Good</span></li>
                                <li><i class="fas fa-check"></i> Resolution <span>480p</span></li>
                                <li><i class="fas fa-check"></i> Screens you can watch <span>1</span></li>
                                <li><i class="fas fa-check"></i> Cancel anytime</li>
                            </ul>
                        </div>
                        <div class="pricing-btn">
                            <a href="#" class="btn">Buy Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="pricing-box-item active mb-30">
                        <div class="pricing-top">
                            <h6>standard</h6>
                            <div class="price">
                                <h3>$9.99</h3>
                                <span>Monthly</span>
                            </div>
                        </div>
                        <div class="pricing-list">
                            <ul>
                                <li class="quality"><i class="fas fa-check"></i> Video quality <span>Better</span></li>
                                <li><i class="fas fa-check"></i> Resolution <span>1080p</span></li>
                                <li><i class="fas fa-check"></i> Screens you can watch <span>2</span></li>
                                <li><i class="fas fa-check"></i> Cancel anytime</li>
                            </ul>
                        </div>
                        <div class="pricing-btn">
                            <a href="#" class="btn">Buy Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="pricing-box-item mb-30">
                        <div class="pricing-top">
                            <h6>premium</h6>
                            <div class="price">
                                <h3>$11.99</h3>
                                <span>Monthly</span>
                            </div>
                        </div>
                        <div class="pricing-list">
                            <ul>
                                <li class="quality"><i class="fas fa-check"></i> Video quality <span>Best</span></li>
                                <li><i class="fas fa-check"></i> Resolution <span>4K+HDR</span></li>
                                <li><i class="fas fa-check"></i> Screens you can watch <span>4</span></li>
                                <li><i class="fas fa-check"></i> Cancel anytime</li>
                            </ul>
                        </div>
                        <div class="pricing-btn">
                            <a href="#" class="btn">Buy Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
        <!-- pricing-area-end -->

        @yield('content')

    </main>
    <!-- main-area-end -->


    <!-- footer-area -->
    @include('client.share.footer')
    <!-- footer-area-end -->
    <!-- JS here -->
    @include('client.share.js')
    @yield('js')
</body>

</html>
