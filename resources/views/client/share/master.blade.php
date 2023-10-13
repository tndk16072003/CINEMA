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
            @yield('content')
        </main>
        <!-- main-area-end -->
        <!-- footer-area -->
        @include('client.share.footer')
        <!-- footer-area-end -->
        @include('client.share.js')
        @yield('js')
    </body>
</html>
