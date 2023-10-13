<!-- breadcrumb-area -->
@php
    $data = DB::table('configs')
              ->select('*')
              ->orderByDESC('id')
              ->LIMIT(1)
              ->get();
    $list = json_decode($data);
    $banner = $list[0]->banner_header;
@endphp
<section class="breadcrumb-area breadcrumb-bg" style="background-image: url('{{ isset($banner) ? $banner : '/assets_client/img/bg/breadcrumb_bg.jpg'}}')">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h2 class="title">Our <span>Movie</span></h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Trang Chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="/phim-sap-chieu" style="color: white">Phim Sắp Chiếu</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb-area-end -->
