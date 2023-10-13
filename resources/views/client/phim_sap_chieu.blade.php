<!doctype html>
<html class="no-js" lang="">
    <head>
        @include('client.share.css')
    </head>
    <body>

        <!-- preloader -->
        <div id="preloader">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <img src="/assets_client/img/preloader.svg" alt="">
                </div>
            </div>
        </div>
        <!-- preloader-end -->

		<!-- Scroll-top -->
        <button class="scroll-top scroll-to-target" data-target="html">
            <i class="fas fa-angle-up"></i>
        </button>
        <!-- Scroll-top-end-->

        <!-- header-area -->
        <header>
            @include('client.share.header')
        </header>
        <!-- header-area-end -->


        <!-- main-area -->
        <main>

            @include('client.share.slider')

            <!-- movie-area -->
            <section class="movie-area movie-bg" data-background="/assets_client/img/bg/movie_bg.jpg">
                <div class="container">
                    <div class="row align-items-end mb-60">
                        <div class="col-lg-6">
                            <div class="section-title text-center text-lg-left">
                                <span class="sub-title">ONLINE STREAMING</span>
                                <h2 class="title">New Release Movies</h2>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="movie-page-meta">
                                <div class="tr-movie-menu-active text-center">
                                    <button class="active" data-filter="*">Animation</button>
                                    <button class="" data-filter=".cat-one">Movies</button>
                                    <button class="" data-filter=".cat-two">Romantic</button>
                                </div>
                                <form action="#" class="movie-filter-form">
                                    <select class="custom-select">
                                        <option selected>English</option>
                                        <option value="1">Blueray</option>
                                        <option value="2">4k Movie</option>
                                        <option value="3">Hd Movie</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row tr-movie">
                        @if (isset($phim))
                        @foreach ($phim as $key => $value)
                        <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-two">
                            <div class="movie-item movie-item-three mb-50">
                                <div class="movie-poster">
                                    <img width="303px" height="430px" src="{{ $value->avatar }}" alt="">
                                    <ul class="overlay-btn">
                                        <li class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </li>
                                        <li><a href="{{ $value->trailer }}" class="popup-video btn">Watch Now</a></li>
                                        <li><a href="/chi-tiet-phim/{{ $value->slug_ten_phim }}-{{ $value->id }}" class="btn">Details</a></li>
                                    </ul>
                                </div>
                                <div class="movie-content">
                                    <div class="top">
                                        <h5 class="title"><a href="/chi-tiet-phim/{{ $value->slug_ten_phim }}-{{ $value->id }}">{{ $value->ten_phim }}</a></h5>
                                        <span class="date">{{$value->ngay_khoi_chieu }}</span>
                                    </div>
                                    <div class="bottom">
                                        <ul>
                                            <li>
                                                @if ($value->chat_luong == 0)
                                                <span class="quality">2D</span>
                                                @elseif ($value->chat_luong == 1)
                                                <span class="quality">3D</span>
                                                @else
                                                <span class="quality">4K</span>
                                                @endif
                                                @if ($value->lua_tuoi == 0)
                                                <span class="quality">5+</span>
                                                @elseif ($value->lua_tuoi == 1)
                                                <span class="quality">12+</span>
                                                @elseif ($value->lua_tuoi == 2)
                                                <span class="quality">16+</span>
                                                @else
                                                <span class="quality">18+</span>
                                                @endif
                                            </li>
                                            <li>
                                                <span class="duration"><i class="far fa-clock"></i> {{ $value->thoi_luong }} min</span>
                                                <span class="rating"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    {{ $phim->links() }}
                </div>
            </section>
            <!-- movie-area-end -->



        </main>
        <!-- main-area-end -->


        <!-- footer-area -->
        @include('client.share.footer')
        <!-- footer-area-end -->
        @include('client.share.js')
    </body>
</html>
