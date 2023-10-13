@extends('AdminRocker.master_rocker')

@section('noi_dung')
    <div class="row" id="app">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm mới lịch
                    chiếu</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thêm Mới Lịch Chiếu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Chọn Phim Chiếu</label>
                                        <select v-on:click="updateThoiLuong()" v-model="lich_create.id_phim_xxx"
                                            class="form-control">
                                            <template v-for="(value, key) in list_phim" v-if="value.trang_thai != 0">
                                                <option v-bind:value="{id_phim : value.id, thoi_luong : value.thoi_luong}">
                                                    @{{ value.ten_phim }}</option>
                                            </template>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Thời Lượng Chiếu Chính</label>
                                        <input v-model="lich_create.thoi_gian_chieu_chinh" type="number"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Thời Lượng Quảng Cáo</label>
                                        <input v-model="lich_create.thoi_gian_quang_cao" type="number"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Ngày Chiếu Phim</label>
                                        <input v-model="lich_create.ngay_chieu" type="date" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Giờ Bắt Đầu</label>
                                        <input v-model="lich_create.gio_bat_dau" type="time" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Giờ Kết Thúc</label>
                                        <input v-model="lich_create.gio_ket_thuc" type="time" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Chọn Phòng Chiếu</label>
                                        <select v-model="lich_create.id_phong" class="form-control">
                                            <template v-for="(value, key) in list_phong" v-if="value.tinh_trang == 1">
                                                <option v-bind:value="value.id">@{{ value.ten_phong }}</option>
                                            </template>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button v-on:click="createLichChieu()" type="button" class="btn btn-primary"
                                    data-bs-dismiss="modal">Thêm Mới</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <th class="text-center align-middle">#</th>
                        <th class="text-center align-middle">Tên Phòng</th>
                        <th class="text-center align-middle">Tên Phim</th>
                        <th class="text-center align-middle">Thời Lượng Chiếu Chính</th>
                        <th class="text-center align-middle">Thời Lượng Quảng Cáo</th>
                        <th class="text-center align-middle">Thời Gian Bắt Đầu</th>
                        <th class="text-center align-middle">Thời Gian Kết Thúc</th>
                        <th class="text-center align-middle">Action</th>
                    </thead>
                    <tbody>
                        <tr v-for="(value, key) in list_lich">
                            <th class="text-center align-middle">@{{ key + 1 }}</th>
                            <td class="text-center align-middle">@{{ value.ten_phong }}</td>
                            <td class="text-center align-middle">@{{ value.ten_phim }}</td>
                            <td class="text-center align-middle">@{{ value.thoi_gian_chieu_chinh }}</td>
                            <td class="text-center align-middle">@{{ value.thoi_gian_quang_cao }}</td>
                            <td class="text-center align-middle">@{{ format_time(value.thoi_gian_bat_dau) }}</td>
                            <td class="text-center align-middle">@{{ format_time(value.thoi_gian_ket_thuc) }}</td>
                            <td class="text-center align-middle text-nowrap">
                                <button v-on:click="editTime(value)" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#updateModal">Cập nhật</button>
                                <button v-on:click="getDataGhePhong(value)" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#gheModal">Xem ghế</button>
                                <button v-on:click="lich_delete = value" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">Xoá bỏ</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Lịch Chiếu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Chọn Phim Chiếu</label>
                                        <select v-model="lich_update.id_phim"
                                            class="form-control">
                                            <template v-for="(value, key) in list_phim" v-if="value.trang_thai != 0">
                                                <option v-bind:value="value.id">
                                                    @{{ value.ten_phim }}</option>
                                            </template>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Thời Lượng Chiếu Chính</label>
                                        <input v-model="lich_update.thoi_gian_chieu_chinh" type="number"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Thời Lượng Quảng Cáo</label>
                                        <input v-model="lich_update.thoi_gian_quang_cao" type="number"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Ngày Chiếu Phim</label>
                                        <input v-model="lich_update.ngay_chieu" type="date" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Giờ Bắt Đầu</label>
                                        <input v-model="lich_update.gio_bat_dau" type="time" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Giờ Kết Thúc</label>
                                        <input v-model="lich_update.gio_ket_thuc" type="time" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Chọn Phòng Chiếu</label>
                                        <select v-model="lich_update.id_phong" class="form-control">
                                            <template v-for="(value, key) in list_phong" v-if="value.tinh_trang == 1">
                                                <option v-bind:value="value.id">@{{ value.ten_phong }}</option>
                                            </template>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button v-on:click="updateLichChieu()" type="button" class="btn btn-primary"
                                    data-bs-dismiss="modal">Cập nhật</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Xoá Lịch Chiếu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Bạn chắc chắn muốn xoá lịch chiếu phim <b
                                        class="text-primary">@{{ lich_delete.ten_phim }}</b> tại phòng <b
                                        class="text-primary">@{{ lich_delete.ten_phong }}</b>?</p>
                                <p>Lịch chiếu dự kiến từ <b class="text-primary">@{{ format_time(lich_delete.thoi_gian_bat_dau) }}</b> đến <b
                                        class="text-primary">@{{ format_time(lich_delete.thoi_gian_ket_thuc) }}</b></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button v-on:click="deleteLichChieu()" type="button" class="btn btn-primary"
                                    data-bs-dismiss="modal">Xác nhận</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="gheModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Danh Sách Ghế Bán</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-primary text-center"><b>MÀN HÌNH</b></div>
                                <table class="table table-bordered">
                                    <tr v-for="i in tt_phong.hang_ngang">
                                        <template v-if="i == (tt_phong.hang_ngang)">
                                            <template v-for="j in (0, tt_phong.hang_doc/2)">
                                                {{-- <td colspan="2" class="text-center text-middle"> @{{ list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)].ten_ghe }}</td> --}}
                                                <td colspan="2"
                                                    v-on:click="changeStatusGheBan(list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)])"
                                                    class="text-center text-middle"
                                                    v-if="list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)].trang_thai == 1">
                                                    <b style="font-size: 15px">@{{ list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)].ten_ghe }}</b>
                                                </td>
                                                <td colspan="2"
                                                    v-on:click="changeStatusGheBan(list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)])"
                                                    v-else class="text-center text-middle bg-danger">
                                                    <b style="font-size: 15px">@{{ list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)].ten_ghe }}</b>
                                                </td>
                                            </template>
                                        </template>
                                        <template v-else>
                                            <template v-for="j in (0, tt_phong.hang_doc)">
                                                {{-- <td> @{{ list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)].ten_ghe }}</td> --}}
                                                <td v-on:click="changeStatusGheBan(list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)])"
                                                    class="text-center text-middle"
                                                    v-if="list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)].trang_thai == 1">
                                                    <b style="font-size: 15px">@{{ list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)].ten_ghe }}</b>
                                                </td>
                                                <td v-on:click="changeStatusGheBan(list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)])"
                                                    v-else class="text-center text-middle bg-danger">
                                                    <b style="font-size: 15px">@{{ list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)].ten_ghe }}</b>
                                                </td>
                                            </template>
                                        </template>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
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
                lich_create: {},
                lich_delete: {},
                lich_update: {},
                list_phong: [],
                list_phim: [],
                list_lich: [],
                list_ghe: [],
                tt_phong: {},
            },

            created() {
                this.loadDataPhim();
                this.loadDataPhong();
                this.loadDataLich();
            },

            methods: {
                updateLichChieu() {
                    axios
                        .post('/admin/lich-chieu/update', this.lich_update)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.messages);
                                this.loadDataLich();
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

                editTime(value) {
                    this.lich_update = value;
                    this.lich_update.id_phim_xxx = value.id_phim_xxx;
                    this.lich_update.ngay_chieu = moment(value.thoi_gian_bat_dau).format('YYYY-MM-DD');
                    this.lich_update.gio_bat_dau = moment(value.thoi_gian_bat_dau).format('HH:mm:ss');
                    this.lich_update.gio_ket_thuc = moment(value.thoi_gian_ket_thuc).format('HH:mm:ss');
                },

                changeStatusGheBan(value) {
                    // toastr.success('hello');
                    axios
                        .get('/admin/lich-chieu/change-status-ghe-ban/' + value.id)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.messages)
                            }
                        });

                    axios
                        .get('/admin/lich-chieu/ghe-ban/' + value.id_lich)
                        .then((res) => {
                            this.list_ghe = res.data.data;
                            // console.log(this.list_ghe);
                        });
                },

                getDataGhePhong(value) {
                    // console.log(value.id);
                    axios
                        .get('/admin/phong/ghe-phong/' + value.id_phong)
                        .then((res) => {
                            this.tt_phong = res.data.phong;
                            console.log(this.tt_phong);
                        });

                    axios
                        .get('/admin/lich-chieu/ghe-ban/' + value.id)
                        .then((res) => {
                            this.list_ghe = res.data.data;
                            console.log(this.list_ghe);
                        });
                },

                deleteLichChieu() {
                    axios
                        .post('/admin/lich-chieu/delete', this.lich_delete)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.messages);
                                this.loadDataLich();
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },

                createLichChieu() {
                    axios
                        .post('/admin/lich-chieu/index', this.lich_create)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.messages);
                                this.loadDataLich();
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

                loadDataLich() {
                    axios
                        .get('/admin/lich-chieu/data')
                        .then((res) => {
                            this.list_lich = res.data.data;
                        });
                },

                format_time(value) {
                    return moment(value).format("HH:mm DD-MM-YYYY");
                },

                updateThoiLuong() {
                    this.lich_create.thoi_gian_chieu_chinh = this.lich_create.id_phim_xxx.thoi_luong;
                    this.lich_create.id_phim = this.lich_create.id_phim_xxx.id_phim;
                },

                updateThoiLuongUpdate() {
                    this.lich_update.thoi_gian_chieu_chinh = this.lich_update.id_phim_xxx.thoi_luong;
                    this.lich_update.id_phim = this.lich_update.id_phim_xxx.id_phim;
                },

                loadDataPhong() {
                    axios
                        .get('/admin/phong/data')
                        .then((res) => {
                            this.list_phong = res.data.data;
                            console.log(this.list_phong);
                        });
                },

                loadDataPhim() {
                    axios
                        .get('/admin/phim/data')
                        .then((res) => {
                            this.list_phim = res.data.data;
                        });
                },
            },
        });
    </script>
@endsection
