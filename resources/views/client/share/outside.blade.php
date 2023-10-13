<!doctype html>
<html class="no-js" lang="">
    <head>
        @include('client.share.css')
        @yield('css')
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
        <header>
            @include('client.share.header')
        </header>
        <!-- header-area-end -->
        <!-- main-area -->
        <main>
            @include('client.share.slider')
            <section class="contact-area contact-bg" data-background="/assets_client/img/bg/contact_bg.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-7">
                            @yield('content')
                        </div>
                        <div class="col-xl-4 col-lg-5">
                            <div class="widget-title mb-50">
                                <h5 class="title">Information</h5>
                            </div>
                            <div class="contact-info-wrap">
                                <p><span>Find solutions :</span> to common problems, or get help from a support agent
                                    industry's standard .</p>
                                <div class="contact-info-list">
                                    <ul>
                                        <li>
                                            <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                                            <p><span>Address :</span> 559 Điện Biên Phủ, Hải Châu, Đà Nẵng</p>
                                        </li>
                                        <li>
                                            <div class="icon"><i class="fas fa-phone-alt"></i></div>
                                            <p><span>Phone :</span> (+84) 905 081 339</p>
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

        </main>
        <!-- main-area-end -->
        <!-- footer-area -->
        @include('client.share.footer')
        <!-- footer-area-end -->
        @include('client.share.js')
        @yield('js')
    </body>
</html>
