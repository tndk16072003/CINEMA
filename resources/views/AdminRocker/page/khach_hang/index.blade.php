@extends('AdminRocker.master_rocker')

@section('noi_dung')
    <div class="row text-center">
        <h4>Quản Lý Khách Hàng</h4>
    </div>
    <div class="row" id="app">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm mới khách
                    hàng</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thêm mới khách hàng</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Họ Tên</label>
                                            <input v-model="them_moi.ho_va_ten" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input v-model="them_moi.email" type="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Số Điện Thoại</label>
                                            <input v-model="them_moi.so_dien_thoai" type="tel" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label">Ngày Sinh</label>
                                            <input v-model="them_moi.ngay_sinh" type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label">Giới Tính</label>
                                            <select class="form-control" v-model="them_moi.gioi_tinh">
                                                <option value="0">Nam</option>
                                                <option value="1">Nữ</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Địa Chỉ</label>
                                            <input v-model="them_moi.dia_chi" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Mật Khẩu</label>
                                            <input type="password" class="form-control" v-model="them_moi.password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                    v-on:click="createKH()">Thêm mới</button>
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
                            <th class="text-center text-nowrap align-middle">Số Điện Thoại</th>
                            <th class="text-center text-nowrap align-middle">Địa Chỉ</th>
                            <th class="text-center text-nowrap align-middle">Hash Mail</th>
                            <th class="text-center text-nowrap align-middle">Ngày Sinh</th>
                            <th class="text-center text-nowrap align-middle">Giới tính</th>
                            <th class="text-center text-nowrap align-middle">Loại Tài Khoản</th>
                            <th class="text-center text-nowrap align-middle">Hash Reset</th>
                            <th class="text-center text-nowrap align-middle">Action</th>
                        </thead>
                        <tbody v-for="(value, key) in list">
                            <th class="text-center text-nowrap align-middle">@{{ key + 1 }}</th>
                            <td class="text-center align-middle">@{{ value.ho_va_ten }}</td>
                            <td class="text-center align-middle">@{{ value.email }}</td>
                            <td class="text-center align-middle">@{{ value.so_dien_thoai }}</td>
                            <td class="text-center align-middle">@{{ value.dia_chi }}</td>
                            <td class="text-center align-middle">@{{ value.hash_mail }}</td>
                            <td class="text-center align-middle">@{{ format_day(value.ngay_sinh) }}</td>
                            <td class="text-center align-middle">@{{ value.gioi_tinh == 0 ? 'Nam' : 'Nữ' }}</td>
                            <td class="text-center align-middle text-nowrap">
                                <button v-on:click="changeStatus(value)" class="btn btn-info"
                                    v-if="value.loai_tai_khoan == 1">Kích hoạt</button>
                                <button v-on:click="changeStatus(value)" class="btn btn-warning"
                                    v-else-if="value.loai_tai_khoan == 0">Chờ Kích hoạt</button>
                                <button v-on:click="changeStatus(value)" class="btn btn-danger" v-else>Bị Khoá</button>
                            </td>
                            <td class="text-center align-middle"></td>
                            <td class="text-center align-middle">
                                <button v-on:click="doi_mat_khau = value" class="btn btn-success mr-2"
                                    data-bs-toggle="modal" data-bs-target="#editPasswordModal">Đổi mật khẩu</button>
                                <button v-on:click="cap_nhat = value" class="btn btn-info mr-2" data-bs-toggle="modal" data-bs-target="#editModal">Cập
                                    nhật</button>
                                <button v-on:click="xoa_bo = value" class="btn btn-danger mr-2" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">Xoá</button>
                            </td>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Xoá Khách Hàng</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" v-model="xoa_bo.id" class="form-control mb-2">
                            <p>Bạn chắc chắn muốn xoá <b style="color: blue"> @{{ xoa_bo.ho_va_ten }}</b> ra khỏi danh sách?
                            </p>
                            <p><u><b>Lưu ý:</b></u> Thao tác này sẽ không thể được hoàn tác!</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button v-on:click="deleteKhachHang()" type="button" class="btn btn-primary"
                                data-bs-dismiss="modal">Xác nhận</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Đổi Mật Khẩu Khách Hàng</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control" type="hidden" v-model="doi_mat_khau.id">
                                        <label class="form-label">Mật Khẩu Mới</label>
                                        <input class="form-control" type="password" v-model="doi_mat_khau.password">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Mật Khẩu Xác Nhận</label>
                                        <input class="form-control" type="password" v-model="doi_mat_khau.re_password">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button v-on:click="updatePassword()" type="button" class="btn btn-primary"
                                data-bs-dismiss="modal">Cập Nhật</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Thông Tin Khách Hàng</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" v-model="cap_nhat.id" class="form-control">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Họ Tên</label>
                                        <input v-model="cap_nhat.ho_va_ten" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input v-model="cap_nhat.email" type="email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Số Điện Thoại</label>
                                        <input v-model="cap_nhat.so_dien_thoai" type="tel" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label">Ngày Sinh</label>
                                        <input v-model="cap_nhat.ngay_sinh" type="date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label">Giới Tính</label>
                                        <select class="form-control" v-model="cap_nhat.gioi_tinh">
                                            <option value="0">Nam</option>
                                            <option value="1">Nữ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Địa Chỉ</label>
                                        <input v-model="cap_nhat.dia_chi" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Mật Khẩu</label>
                                        <input v-on:keyup="is_show = true" type="password" class="form-control"
                                            v-model="cap_nhat.password">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <div class="hide" v-show="is_show">
                                        <div class="form-group">
                                            <input class="form-control" type="password"
                                                v-model="cap_nhat.re_password" placeholder="Nhập lại mật khẩu">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                v-on:click="updateKH()">Cập nhật</button>
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
                list: [],
                them_moi: {},
                xoa_bo: {},
                doi_mat_khau: {},
                cap_nhat: {},
            },

            created() {
                this.loadData();
            },

            methods: {
                updateKH() {
                    axios
                        .post('/admin/khach-hang/update', this.cap_nhat)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.messages);
                                this.loadData();
                            } else {
                                toastr.error(res.data.messages);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },

                updatePassword() {
                    axios
                        .post('/admin/khach-hang/doi-mat-khau', this.doi_mat_khau)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.messages);
                                this.loadData();
                            } else {
                                toastr.error(res.data.messages);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },

                deleteKhachHang() {
                    axios
                        .post('/admin/khach-hang/delete', this.xoa_bo)
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

                createKH() {
                    axios
                        .post('/admin/khach-hang/index', this.them_moi)
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
                        .get('/admin/khach-hang/change-status/' + value.id)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.messages);
                                this.loadData();
                            }
                        });
                },

                loadData() {
                    axios
                        .get('/admin/khach-hang/data')
                        .then((res) => {
                            this.list = res.data.data
                        });
                },

                format_day(value) {
                    return moment(String(value)).format('MM/DD/YYYY');
                },
            },
        });
    </script>
@endsection
