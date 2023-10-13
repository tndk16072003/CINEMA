@extends('AdminRocker.master_rocker')

@section('noi_dung')
    <div class="row" id="app">
        <h4 class="text-center">Quản Lý Admin</h4>
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm mới admin</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thêm Mới Admin</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="form-label">Họ Và Tên</label>
                                            <input v-model="them_moi.ho_va_ten" type="text" class="form-control"
                                                placeholder="Nhập vào họ và tên">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input v-model="them_moi.email" type="text" class="form-control"
                                                placeholder="Nhập vào email">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="form-label">Avatar</label>
                                            <div class="input-group">
                                                <input id="hinh_anh" class="form-control" type="text" name="filepath">
                                                <span class="input-group-prepend">
                                                    <a id="lfm" data-input="hinh_anh" data-preview="holder"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                            </div>
                                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="form-label">Mật Khẩu</label>
                                            <input v-model="them_moi.password" type="password" class="form-control"
                                                placeholder="Nhập vào mật khẩu">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="form-label">Mật Khẩu Xác Nhận</label>
                                            <input v-model="them_moi.re_password" type="password" class="form-control"
                                                placeholder="Nhập lại mật khẩu">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button v-on:click="themMoiAdmin()" type="button" class="btn btn-primary"
                                    data-bs-dismiss="modal">Thêm mới</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th class="text-center text-nowrap align-middle">#</th>
                            <th class="text-center text-nowrap align-middle">Họ Và Tên</th>
                            <th class="text-center text-nowrap align-middle">Email</th>
                            <th class="text-center text-nowrap align-middle">Avatar</th>
                            <th class="text-center text-nowrap align-middle">Trạng Thái</th>
                            <th class="text-center text-nowrap align-middle">Action</th>
                        </thead>
                        <tbody>
                            <tr v-for="(value, key) in list">
                                <th class="text-center align-middle">@{{ key + 1 }}</th>
                                <td class="text-center align-middle">@{{ value.ho_va_ten }}</td>
                                <td class="text-center align-middle">@{{ value.email }}</td>
                                <td class="text-center align-middle">
                                    <button class="btn btn-light" v-on:click="avatar = value.avatar"  data-bs-toggle="modal" data-bs-target="#avatarModal"><i class="fa-solid fa-image text-success"></i></button>
                                </td>
                                <td class="text-center align-middle">
                                    <button v-on:click="changeStatus(value.id)" v-if="value.trang_thai == 0"
                                        class="btn btn-warning">Bị khoá</button>
                                    <button v-on:click="changeStatus(value.id)" v-else class="btn btn-success">Đang hoạt
                                        động</button>
                                </td>
                                <td class="text-center align-middle">
                                    <button v-on:click="edit_pass = value" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editPasswordModal">Đổi mật khẩu</button>
                                    <button v-on:click="data_edit(value)" class="btn btn-info" data-bs-toggle="modal"
                                    data-bs-target="#updateModal">Cập nhật</button>
                                    <button v-on:click="xoa_bo = value" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">Xoá</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Xoá Admin</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Bạn chắc chắn muốn xoá <b class="text-primary">@{{ xoa_bo.ho_va_ten }}</b> khỏi danh sách?</p>
                                    <p><b><u>Lưu ý</u>:</b> Thao tác này không thể được hoàn tác!</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button v-on:click="xoaAdmin()" type="button" class="btn btn-primary" data-bs-dismiss="modal">Xác nhận</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="avatarModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Avatar</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img height="500px" width="100%" v-bind:src="avatar" alt="">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Đổi Mật Khẩu</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <label class="form-label">Mật khẩu mới</label>
                                            <input type="password" class="form-control" v-model="edit_pass.password">
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="form-label">Mật khẩu xác nhận</label>
                                            <input type="password" class="form-control" v-model="edit_pass.re_password">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button v-on:click="doimatKhauAdmin()" type="button" class="btn btn-primary" data-bs-dismiss="modal">Xác nhận</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Thông Tin Admin</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="form-label">Họ Và Tên</label>
                                            <input v-model="cap_nhat.ho_va_ten" type="text" class="form-control"
                                                placeholder="Nhập vào họ và tên">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input v-model="cap_nhat.email" type="text" class="form-control"
                                                placeholder="Nhập vào email">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="form-label">Avatar</label>
                                            <div class="input-group">
                                                <input id="hinh_anh_update" class="form-control" type="text" name="filepath">
                                                <span class="input-group-prepend">
                                                    <a id="lfm_update" data-input="hinh_anh_update" data-preview="holder_update"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                            </div>
                                            <div id="holder_update" style="margin-top:15px;max-height:100px;"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="form-label">Mật Khẩu</label>
                                            <input v-on:keyup="hide = true" v-model="cap_nhat.password" type="password" class="form-control"
                                                placeholder="Nhập vào mật khẩu">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group" v-show="hide">
                                            <label class="form-label">Mật Khẩu Xác Nhận</label>
                                            <input v-model="cap_nhat.re_password" type="password" class="form-control"
                                                placeholder="Nhập lại mật khẩu">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button v-on:click="capNhatAdmin()" type="button" class="btn btn-primary"
                                    data-bs-dismiss="modal">Cập nhật</button>
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
                avatar: '',
                edit_pass: {},
                hide : false,
            },

            created() {
                this.loadData();
            },

            methods: {
                capNhatAdmin() {
                    this.cap_nhat.avatar = $('#hinh_anh_update').val();
                    axios
                        .post('/admin/admin/update', this.cap_nhat)
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

                data_edit(value) {
                    this.cap_nhat = value;
                    $('#hinh_anh_update').val(this.cap_nhat.avatar);
                    var text = '';
                    text += '<img style="margin-bottom:15px;max-height:100px;" src="'+ this.cap_nhat.avatar +'">'
                    $('#holder_update').html(text);
                },

                doimatKhauAdmin() {
                    axios
                        .post('/admin/admin/edit-password', this.edit_pass)
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

                xoaAdmin() {
                    axios
                        .post('/admin/admin/delete', this.xoa_bo)
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

                changeStatus($id) {
                    axios
                        .get('/admin/admin/change-status/' + $id)
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

                themMoiAdmin() {
                    this.them_moi.avatar = $('#hinh_anh').val();
                    axios
                        .post('/admin/admin/index', this.them_moi)
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
                        .get('/admin/admin/data')
                        .then((res) => {
                            this.list = res.data.data;
                        });
                },
            },
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
        $("#lfm_update").filemanager('image', {
            prefix: route_prefix
        });
    </script>
@endsection
