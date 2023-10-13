@extends('AdminRocker.master_rocker')

@section('noi_dung')
    <div class="row" id="app">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm mới phòng
                    chiếu</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group mb-2">
                                    <label class="form-label">Tên Phòng</label>
                                    <input v-model="phong_create.ten_phong" type="text" placeholder="Nhập vào tên phòng"
                                        class="form-control">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="form-label">Tình Trạng</label>
                                    <select v-model="phong_create.tinh_trang" class="form-control">
                                        <option value="1">Đang kinh doanh</option>
                                        <option value="0">Dừng kinh doanh</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="form-label">Ghế Hàng Dọc</label>
                                    <input v-model="phong_create.hang_doc" type="number"
                                        placeholder="Nhập vào số ghế hàng dọc" class="form-control">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="form-label">Ghế Hàng Ngang</label>
                                    <input v-model="phong_create.hang_ngang" type="number"
                                        placeholder="Nhập vào số ghế hàng ngang" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button v-on:click="createPhong()" type="button" class="btn btn-primary"
                                    data-bs-dismiss="modal">Thêm mới</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <th class="text-center text-nowrap align-middle">#</th>
                        <th class="text-center text-nowrap align-middle">Tên Phòng</th>
                        <th class="text-center text-nowrap align-middle">Tình Trạng</th>
                        <th class="text-center text-nowrap align-middle">Số Hàng</th>
                        <th class="text-center text-nowrap align-middle">Số Cột</th>
                        <th class="text-center text-nowrap align-middle">Action</th>
                    </thead>
                    <tbody>
                        <tr v-for="(value, key) in list_phong">
                            <th class="text-center text-nowrap align-middle">@{{ key + 1 }}</th>
                            <td class="text-center text-nowrap align-middle">@{{ value.ten_phong }}</td>
                            <td class="text-center text-nowrap align-middle">
                                <button v-on:click="changeStatus(value.id)" v-if="value.tinh_trang == 1"
                                    class="btn btn-success">Đang Kinh Doanh</button>
                                <button v-on:click="changeStatus(value.id)" v-else class="btn btn-warning">Dừng Kinh
                                    Doanh</button>
                            </td>
                            <td class="text-center text-nowrap align-middle">@{{ value.hang_ngang }}</td>
                            <td class="text-center text-nowrap align-middle">@{{ value.hang_doc }}</td>
                            <td class="text-center text-nowrap align-middle">
                                <button v-on:click="phong_update = value" class="btn btn-info" data-bs-toggle="modal"
                                    data-bs-target="#updateModal">Cập nhật</button>
                                <button v-on:click="phong_delete = value" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">Xoá bỏ</button>
                                <button v-on:click="loadGhe(value.id)" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#gheModal">Xem Ghế</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Phòng Chiếu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group mb-2">
                                    <input type="hidden" v-model="phong_update.id" class="form-control">
                                    <label class="form-label">Tên Phòng</label>
                                    <input v-model="phong_update.ten_phong" type="text"
                                        placeholder="Nhập vào tên phim" class="form-control">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="form-label">Tình Trạng</label>
                                    <select v-model="phong_update.tinh_trang" class="form-control">
                                        <option value="1">Đang kinh doanh</option>
                                        <option value="0">Dừng kinh doanh</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="form-label">Ghế Hàng Dọc</label>
                                    <input v-model="phong_update.hang_doc" type="number"
                                        placeholder="Nhập vào số ghế hàng dọc" class="form-control">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="form-label">Ghế Hàng Ngang</label>
                                    <input v-model="phong_update.hang_ngang" type="number"
                                        placeholder="Nhập vào số ghế hàng ngang" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button v-on:click="updatePhong()" type="button" class="btn btn-primary"
                                    data-bs-dismiss="modal">Cập nhật</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="gheModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Danh Sách Ghế</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-primary text-center" style="font-size: 20px"><b>MÀN
                                                HÌNH</b></div>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <tr v-for="i in (0, tt_phong.hang_ngang)">
                                                <template v-if="i == (tt_phong.hang_ngang)">
                                                    <template v-for="j in (0, tt_phong.hang_doc/2)">
                                                        {{-- <td colspan="2" class="text-center text-middle"> @{{ list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)].ten_ghe }}</td> --}}
                                                        <td colspan="2"
                                                            v-on:click="changeStatusGhe(list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)])"
                                                            class="text-center text-middle"
                                                            v-if="list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)].tinh_trang == 1">
                                                            <b style="font-size: 15px">@{{ list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)].ten_ghe }}</b>
                                                        </td>
                                                        <td colspan="2"
                                                            v-on:click="changeStatusGhe(list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)])"
                                                            v-else class="text-center text-middle bg-danger">
                                                            <b style="font-size: 15px">@{{ list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)].ten_ghe }}</b>
                                                        </td>
                                                    </template>
                                                </template>
                                                <template v-else>
                                                    <template v-for="j in (0, tt_phong.hang_doc)">
                                                        {{-- <td> @{{ list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)].ten_ghe }}</td> --}}
                                                        <td v-on:click="changeStatusGhe(list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)])"
                                                            class="text-center text-middle"
                                                            v-if="list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)].tinh_trang == 1">
                                                            <b style="font-size: 15px">@{{ list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)].ten_ghe }}</b>
                                                        </td>
                                                        <td v-on:click="changeStatusGhe(list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)])"
                                                            v-else class="text-center text-middle bg-danger">
                                                            <b style="font-size: 15px">@{{ list_ghe[(i - 1) * tt_phong.hang_doc + (j - 1)].ten_ghe }}</b>
                                                        </td>
                                                    </template>
                                                </template>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Xoá Phòng Chiếu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input class="form-control mb-2" type="hidden" v-model="phong_delete.id">
                                <p>Bạn chắc chắn muốn xoá phòng chiếu <b class="text-danger">@{{ phong_delete.ten_phong }}</b>!
                                </p>
                                <p><b>Lưu ý:</b> Thao tác này sẽ không thể được hoàn tác!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button v-on:click="deletePhong()" type="button" class="btn btn-primary"
                                    data-bs-dismiss="modal">Xác nhận</button>
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
        $(document).ready(function() {
            new Vue({
                el: '#app',
                data: {
                    phong_create: {},
                    list_phong: [],
                    phong_delete: {},
                    phong_update: {},
                    list_ghe: [],
                    tt_phong: {},
                },
                created() {
                    this.loadData();
                },
                methods: {
                    changeStatusGhe(value) {
                        axios
                            .post('/admin/phong/change-status-ghe', value)
                            .then((res) => {
                                toastr.success('Đã đổi trạng thái ghế thành công!');
                            });

                        axios
                            .get('/admin/phong/ghe-phong/' + value.id_phong)
                            .then((res) => {
                                this.list_ghe = res.data.data;
                            });
                    },

                    updatePhong() {
                        axios
                            .post('/admin/phong/update', this.phong_update)
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

                    deletePhong() {
                        axios
                            .post('/admin/phong/delete', this.phong_delete)
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

                    createPhong() {
                        axios
                            .post('/admin/phong/index', this.phong_create)
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

                    changeStatus($id) {
                        axios
                            .get('/admin/phong/change-status/' + $id)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.messages);
                                    this.loadData();
                                }
                            });
                    },

                    loadData() {
                        axios
                            .get('/admin/phong/data')
                            .then((res) => {
                                this.list_phong = res.data.data
                            });
                    },

                    loadGhe(id) {
                        // console.log('/admin/phong/ghe-phong/' + id);
                        axios
                            .get('/admin/phong/ghe-phong/' + id)
                            .then((res) => {
                                this.list_ghe = res.data.data;
                                this.tt_phong = res.data.phong;
                                console.log(this.list_ghe);
                                console.log(this.tt_phong);
                            });
                    },
                },
            });
        });
    </script>
@endsection
