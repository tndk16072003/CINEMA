@extends('client.share.master')



@section('content')
<section class="movie-details-area" data-background="/assets_client/img/bg/movie_details_bg.jpg">
<div class="container" id="app">
    <div class="movie-episode-wrap">
        <div class="episode-watch-wrap">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <button class="btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <span class="season">Phim: {{ $thongTin->ten_phim }}<br>Thời gian: {{ $thongTin->thoi_gian_bat_dau }}<br>Phòng: {{ $thongTin->ten_phong }}</span>
                            <span class="video-count">{{ $soVe }} vé đã đặt</span>
                        </button>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                @foreach ($list_ghe as $key => $value)
                                <li><i class="fas fa-play mr-2" style="color: #e4d804"></i> Ghế {{ $value->ten_ghe }} <span class="duration"> {{number_format($value->gia_ghe, 0, '', '.')}} &#8363</span></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <button class="btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <span class="season">Tổng Tiền Thanh Toán</span>
                            <span class="video-count">{{number_format($tongTien, 0, '', '.')}} &#8363</span>
                        </button>
                        <button class="btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <span class="season">Số Tài Khoản Thụ Hưởng</span>
                            <span class="video-count text-right"><b>1017142420</b><br>Vietcombank</span>
                        </button>
                        <button class="btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <span class="season">Nội Dung</span>
                            <span class="video-count">{{ $list_ghe[0]->ma_giao_dich }}</span>
                        </button>
                        <button class="btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <span class="season">Thời Gian Thanh Toán</span>
                            <span class="video-count"><a style="background-color: #e4d804; color: black" class="btn">@{{ time_load }}s</a></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection

@section('js')
<script>
    new Vue({
        el : '#app',

        data: {
            time_load : 180,
        },

        created() {
            setInterval(() => {
                if(this.time_load == 5 ) {
                    toastr.error('Thời gian thanh toán sắp kết thúc');
                } else if(this.time_load <= 1) {
                    window.location.replace('/');
                }
                this.time_load = this.time_load - 1;
            }, 1000);
        },

        methods: {

        },
    });
</script>
@endsection
