@extends('AdminRocker.master_rocker')

@section('noi_dung')
    <div id="app" class="row">
        <h4 class="text-center">Quản Lý Bài Viết</h4>
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm mới bài
                    viết</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thêm Mới Bài Viết</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Tiêu Đề</label>
                                            <input v-model="them_moi.tieu_de" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Hình Ảnh</label>
                                            <div class="input-group">
                                                <input id="hinh_anh" class="form-control" type="text" name="filepath">
                                                <span class="input-group-prepend">
                                                    <a id="lfm" data-input="hinh_anh" data-preview="holder"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                            </div>
                                            <div id="holder" style="margin-top:15px;max-height:100px;">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Mô Tả Ngắn</label>
                                            <textarea class="form-control" name="mo_ta_ngan" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Nội dung</label>
                                            <textarea class="form-control" name="noi_dung" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button v-on:click="themMoiBaiViet()" type="button" class="btn btn-primary">Thêm
                                    mới</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th class="text-center align-middle">#</th>
                            <th class="text-center align-middle">Tiêu Đề</th>
                            <th class="text-center align-middle">Mô Tả Ngắn</th>
                            <th class="text-center align-middle">Nội Dung</th>
                            <th class="text-center align-middle">Hình Ảnh</th>
                            <th class="text-center align-middle">Trạng Thái</th>
                            <th class="text-center text-nowrap align-middle">Action</th>
                        </thead>
                        <tbody>
                            <tr v-for="(value, key) in list">
                                <th class="text-center align-middle">@{{ key + 1 }}</th>
                                <td class="text-center align-middle">
                                    <textarea disabled class="form-control" cols="30" rows="5">@{{ value.tieu_de }}</textarea>
                                </td>
                                <td class="text-center align-middle">
                                    <button class="btn btn-primary" v-on:click="mo_ta_ngan = value.mo_ta_ngan"
                                        data-bs-toggle="modal" data-bs-target="#moTaNganModal">Mô tả ngắn</button>
                                </td>
                                <td class="text-center align-middle">
                                    <button class="btn btn-primary" v-on:click="noi_dung = value.noi_dung"
                                        data-bs-toggle="modal" data-bs-target="#noiDungModal">Nội dung</button>
                                </td>
                                <td class="text-center align-middle">
                                    <template v-for="(v, k) in value.hinh_anh.split(',')">
                                        <img v-bind:src="v" width="80px" height="80px">
                                    </template>
                                </td>
                                <td class="text-center align-middle">
                                    <button v-on:click="changeStatus(value)" v-if="value.trang_thai == 1"
                                        class="btn btn-success">Đang mở</button>
                                    <button v-on:click="changeStatus(value)" v-else class="btn btn-warning">Đã
                                        đóng</button>
                                </td>
                                <td class="text-center align-middle">
                                    <button v-on:click="data_cap_nhat(cap_nhat = value)" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#updateModal">Cập nhật</button>
                                    <button v-on:click="xoa_bo = value" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">Xoá</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Thêm Mới Bài Viết</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Tiêu Đề</label>
                                                <input v-model="cap_nhat.tieu_de" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Hình Ảnh</label>
                                                <div class="input-group">
                                                    <input id="hinh_anh_update" class="form-control" type="text"
                                                        name="filepath">
                                                    <span class="input-group-prepend">
                                                        <a id="lfm_update" data-input="hinh_anh_update" data-preview="holder_update"
                                                            class="btn btn-primary">
                                                            <i class="fa fa-picture-o"></i> Choose
                                                        </a>
                                                    </span>
                                                </div>
                                                <div id="holder_update" style="margin-top:15px;max-height:100px;">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Mô Tả Ngắn</label>
                                                <textarea class="form-control" v-model="cap_nhat.mo_ta_ngan" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Nội dung</label>
                                                <textarea class="form-control" v-model="cap_nhat.noi_dung" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button v-on:click="capNhatBaiViet()" type="button" class="btn btn-primary" data-bs-dismiss="modal">Cập nhật</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" v-model="xoa_bo.id" class="form-control">
                                    <p>Bạn chắc chắn muốn xoá bài viết này?</p>
                                    <p><b><u>Lưu ý</u>:</b> Thao tác này sẽ không thể được hoàn tác!</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button v-on:click="xoaBoBaiViet()" type="button" class="btn btn-primary"
                                        data-bs-dismiss="modal">Xác nhận</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="moTaNganModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Mô Tả Ngắn</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <textarea disabled class="form-control" cols="30" rows="10">@{{ mo_ta_ngan }}</textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="noiDungModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Nội Dung</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <textarea disabled class="form-control" cols="30" rows="10">@{{ noi_dung }}</textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        new Vue({
            el: '#app',

            data: {
                them_moi: {},
                xoa_bo: {},
                cap_nhat: {},
                list: [],
                noi_dung: '',
                mo_ta_ngan: '',
            },

            created() {
                this.loadData();
            },

            methods: {
                data_cap_nhat(cap_nhat) {
                    $("#hinh_anh_update").val(cap_nhat.hinh_anh);
                    var text = '';
                    $.each(cap_nhat.hinh_anh.split(','), function(key, value){
                        text += '<img style="height: 80px; width: 80px; margin-top: 15px" src="' + value + '">'
                    });
                    $("#holder_update").html(text);
                },

                capNhatBaiViet() {
                    this.cap_nhat.hinh_anh = $('#hinh_anh_update').val();
                    axios
                        .post('/admin/bai-viet/update', this.cap_nhat)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.messages);
                                this.loadData();
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },

                xoaBoBaiViet() {
                    axios
                        .post('/admin/bai-viet/delete', this.xoa_bo)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.messages);
                                this.loadData();
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },

                changeStatus(value) {
                    axios
                        .get('/admin/bai-viet/change-status/' + value.id)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.messages);
                                this.loadData();
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },

                themMoiBaiViet() {
                    this.them_moi.noi_dung = CKEDITOR.instances['noi_dung'].getData();
                    this.them_moi.mo_ta_ngan = CKEDITOR.instances['mo_ta_ngan'].getData();
                    this.them_moi.hinh_anh = $('#hinh_anh').val();
                    axios
                        .post('/admin/bai-viet/index', this.them_moi)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.messages);
                                this.loadData();
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },

                loadData() {
                    axios
                        .get('/admin/bai-viet/data')
                        .then((res) => {
                            this.list = res.data.data
                        });
                },
            },
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.19.1/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('mo_ta_ngan'); // replace name mô tả
        CKEDITOR.replace('update_mo_ta_ngan'); // replace name mô tả
        CKEDITOR.replace('noi_dung'); // replace name mô tả
        CKEDITOR.replace('update_noi_dung'); // replace name mô tả
    </script>
    <script>
        var route_prefix = "/laravel-filemanager";
    </script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $("#lfm").filemanager('image', {
            prefix: route_prefix
        });
        $("#lfm_update").filemanager('image', {
            prefix: route_prefix
        });
    </script>
@endsection
