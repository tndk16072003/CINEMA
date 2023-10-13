@extends('AdminRocker.master_rocker')

@section('noi_dung')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="font-size: 22px">Cấu Hình Trang Chủ</div>
                <form action="/admin/cau-hinh/index" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Phim 1</label>
                                <select name="phim1" class="form-control">
                                    @foreach ($list_phim as $key => $value)
                                        <option
                                            {{ isset($config->phim1) && $value->id == $config->phim1 ? 'selected' : '' }}
                                            value="{{ $value->id }}">{{ $value->ten_phim }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Phim 2</label>
                                <select name="phim2" class="form-control">
                                    @foreach ($list_phim as $key => $value)
                                        <option
                                            {{ isset($config->phim2) && $value->id == $config->phim2 ? 'selected' : '' }}
                                            value="{{ $value->id }}">{{ $value->ten_phim }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Phim 3</label>
                                <select name="phim3" class="form-control">
                                    @foreach ($list_phim as $key => $value)
                                        <option
                                            {{ isset($config->phim3) && $value->id == $config->phim3 ? 'selected' : '' }}
                                            value="{{ $value->id }}">{{ $value->ten_phim }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Banner Home Page</label>
                                    <div class="input-group">
                                        <input id="hinh_anh" class="form-control" type="text" name="banner"
                                            value="{{ isset($config->banner) ? $config->banner : '/assets_client/img/banner/s_slider_bg.jpg' }}">
                                        <span class="input-group-prepend">
                                            <a id="lfm" data-input="hinh_anh" data-preview="holder"
                                                class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>
                                    </div>
                                    <div id="holder" style="margin-top:15px;max-height:200px;">
                                        <img width="100%" height="200px"
                                            src="{{ isset($config->banner) ? $config->banner : '/assets_client/img/banner/s_slider_bg.jpg' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Banner Header</label>
                                    <div class="input-group">
                                        <input id="hinh_anh_header" class="form-control" type="text" name="banner_header"
                                            value="{{ isset($config->banner_header) ? $config->banner_header : '/assets_client/img/bg/breadcrumb_bg.jpg' }}">
                                        <span class="input-group-prepend">
                                            <a id="lfm_header" data-input="hinh_anh_header" data-preview="holder_header"
                                                class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>
                                    </div>
                                    <div id="holder_header" style="margin-top:15px;max-height:200px;">
                                        <img width="100%" height="200px"
                                            src="{{ isset($config->banner_header) ? $config->banner_header : '/assets_client/img/bg/breadcrumb_bg.jpg' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <form action="/admin/cap-nhat-gia" method="post">
                @csrf
                <div class="card">
                    <div class="card-header" style="font-size: 22px">Cập Nhật Giá Ghế</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Giá Ghế Đơn</label>
                                <input name="gia_ghe_don" type="number" class="form-control" placeholder="100000">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Giá Ghế Đôi</label>
                                <input name="gia_ghe_doi" type="number" class="form-control" placeholder="100000">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var route_prefix = "/laravel-filemanager";
    </script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $("#lfm").filemanager('image', {
            prefix: route_prefix
        });
        $("#lfm_header").filemanager('image', {
            prefix: route_prefix
        });
    </script>
@endsection
