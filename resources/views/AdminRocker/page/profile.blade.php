@extends('AdminRocker.master_rocker')

@section('noi_dung')
    <div class="row" id="app">
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <div class="card">
                <div class="text-center">
                    <img src="{{ $admin->avatar }}" class="user-img" alt="user avatar"
                        style="width: 350px; height: 350px; border: 3px solid #2962ff">
                    <div class="user-info ps-3 mt-3">
                        {{-- <p class="designattion mb-0">{{ $admin->email }}</p> --}}
                        <p class="user-name mb-0" style="color: #2962ff; font-size: 22px; font-weight: 550">
                            {{ $admin->ho_va_ten }}</p>
                        <div class="text-center">
                            <p>
                                <hr style="color: #2962ff; width: 70%; margin-left: 75px">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <form action="/admin/admin/update-profile" method="POST">
                                @csrf
                                <div class="col-md-12 mb-2">
                                    <input name="id" type="hidden" class="form-control" value="{{ $admin->id }}">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="form-label">Họ và tên</label>
                                    <input name="ho_va_ten" type="text" class="form-control" value="{{ $admin->ho_va_ten }}">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control" value="{{ $admin->email }}">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="form-label">Avatar</label>
                                    <div class="input-group">
                                        <input value="{{ $admin->avatar }}" id="hinh_anh" class="form-control" type="text"
                                            name="avatar">
                                        <span class="input-group-prepend">
                                            <a id="lfm" data-input="hinh_anh" data-preview="holder"
                                                class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>
                                    </div>
                                    <img style="width: 100px; margin: 5px" src="{{ $admin->avatar }}">
                                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="form-label">Số điện thoại</label>
                                    <input name="so_dien_thoai" type="text" class="form-control"
                                        value="{{ $admin->so_dien_thoai }}">
                                </div>
                                <div class="col-md-12 mb-2 text-end">
                                    <button class="btn btn-primary">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <form action="/admin/admin/doi-mat-khau" method="POST">
                                @csrf
                                <div class="col-md-12 mb-2">
                                    <input name="id" type="hidden" class="form-control" value="{{ $admin->id }}">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="form-label">Mật Khẩu</label>
                                    <input id="password" name="password" type="password" class="form-control" value="{{ $admin->password }}">
                                </div>
                                <div class="col-md-12 mb-2" id="re_password">
                                    <label class="form-label">Mật Khẩu Xác Nhận</label>
                                    <input name="re_password" type="password" class="form-control" placeholder="Enter your password again *" >
                                </div>
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-success">Đổi mật khẩu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
    <script>
        $(document).ready(function() {
            $('#re_password').hide();
            $('#password').keyup(function() {
                $('#re_password').show();
            });
        });
    </script>
    <script>
        var route_prefix = "/laravel-filemanager";
    </script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $("#lfm").filemanager('image', {
            prefix: route_prefix
        });
        // $("#lfm_update").filemanager('image', {prefix : route_prefix});
    </script>
@endsection
