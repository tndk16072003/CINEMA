@extends('AdminRocker.master_rocker')

@section('noi_dung')
    <div class="row" id="app">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm mới phim
                    chiếu</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Mới</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Tên Phim</label>
                                            <input v-on:keyup="converseNameToSlug()" v-model="phim_create.ten_phim"
                                                type="text" class="form-control" placeholder="Nhập vào tên phim">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Slug Tên Phim</label>
                                            <input v-model="slug" type="text" class="form-control"
                                                placeholder="Nhập vào slug tên phim">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Đạo Diễn</label>
                                            <input v-model="phim_create.dao_dien" type="text" class="form-control"
                                                placeholder="Nhập vào đạo diễn">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Diễn Viên</label>
                                            <input v-model="phim_create.dien_vien" type="text" class="form-control"
                                                placeholder="Nhập vào tên diễn viên">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Thể Loại</label>
                                            <input v-model="phim_create.the_loai" type="text" class="form-control"
                                                placeholder="Nhập vào thể loại phim">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Thời Lượng</label>
                                            <input v-model="phim_create.thoi_luong" type="number" class="form-control"
                                                placeholder="Nhập vào thời lượng phim">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Ngày Khởi Chiếu</label>
                                            <input v-model="phim_create.ngay_khoi_chieu" type="date"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">trailer</label>
                                            <input v-model="phim_create.trailer" type="text" class="form-control"
                                                placeholder="Nhập vào link trailer phim">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Chất lượng phim</label>
                                        <select v-model="phim_create.chat_luong" class="form-control">
                                            <option value="0">2D</option>
                                            <option value="1">3D</option>
                                            <option value="2">4K</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Lứa Tuổi</label>
                                        <select v-model="phim_create.lua_tuoi" class="form-control">
                                            <option value="0">5+</option>
                                            <option value="1">12+</option>
                                            <option value="2">16+</option>
                                            <option value="3">18+</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
                                        <label class="form-label">Banner</label>
                                        <div class="input-group">
                                            <input id="hinh_anh_banner" class="form-control" type="text" name="filepath">
                                            <span class="input-group-prepend">
                                                <a id="lfm_banner" data-input="hinh_anh_banner" data-preview="holder_banner"
                                                    class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                </a>
                                            </span>
                                        </div>
                                        <div id="holder_banner" style="margin-top:15px;max-height:100px;"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Tình trạng</label>
                                            <select v-model="phim_create.tinh_trang" class="form-control">
                                                <option value="1">Đang chiếu</option>
                                                <option value="2">Sắp chiếu</option>
                                                <option value="0">Dừng chiếu</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Mô Tả Phim</label>
                                        <textarea name="mo_ta" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button v-on:click="createPhim()" type="button" class="btn btn-primary"
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
                            <th class="text-center text-nowrap align-middle">Tên Phim</th>
                            <th class="text-center text-nowrap align-middle">Slug Tên Phim</th>
                            <th class="text-center text-nowrap align-middle">Chất lượng</th>
                            <th class="text-center text-nowrap align-middle">Đạo Diễn</th>
                            <th class="text-center text-nowrap align-middle">Diễn Viên</th>
                            <th class="text-center text-nowrap align-middle">Thể Loại</th>
                            <th class="text-center text-nowrap align-middle">Ngày Khởi Chiếu</th>
                            <th class="text-center text-nowrap align-middle">Thời Lượng</th>
                            <th class="text-center text-nowrap align-middle">Avatar</th>
                            <th class="text-center text-nowrap align-middle">Trailer</th>
                            <th class="text-center text-nowrap align-middle">Mô Tả</th>
                            <th class="text-center text-nowrap align-middle">Banner</th>
                            <th class="text-center text-nowrap align-middle">Tình Trạng</th>
                            <th class="text-center text-nowrap align-middle">Action</th>
                        </thead>
                        <tbody>
                            <tr v-for="(value, key) in list_phim">
                                <th class="text-center align-middle">@{{ key + 1 }}</th>
                                <td class="text-center align-middle">@{{ value.ten_phim }}</td>
                                <td class="text-center align-middle">@{{ value.slug_ten_phim }}</td>
                                <td class="text-center align-middle" v-if="value.chat_luong == 0">2D</td>
                                <td class="text-center align-middle" v-else-if="value.chat_luong == 1">3D</td>
                                <td class="text-center align-middle" v-else-if="value.chat_luong == 2">1080p</td>
                                <td class="text-center align-middle" v-else>4K</td>
                                <td class="text-center align-middle">@{{ value.dao_dien }}</td>
                                <td class="text-center align-middle"><button class="btn btn-success" v-on:click="dien_vien = value.dien_vien" data-bs-toggle="modal" data-bs-target="#dienVienModal">Diễn viên</button></td>
                                <td class="align-middle">@{{ value.the_loai }}</td>
                                <td class="text-center align-middle">@{{ format_day(value.ngay_khoi_chieu) }}</td>
                                <td class="text-center align-middle">@{{ value.thoi_luong }}</td>
                                <td class="text-center align-middle">
                                    <button v-on:click="avatar = value.avatar" class="btn btn-light"
                                        data-bs-toggle="modal" data-bs-target="#avatarModal"><i
                                            class="fa-solid fa-image text-success"></i></button>
                                </td>
                                <td class="text-center align-middle">@{{ value.trailer }}</td>
                                <td class="text-center align-middle" v-html="value.mo_ta.substring(0, 100)+ '...'"></td>
                                <td class="text-center align-middle">
                                    <button class="btn btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#bannerModal" v-on:click="banner = value.banner_phim">Banner</button>
                                </td>
                                <div class="modal fade" id="bannerModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Banner</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img style="width: 100%" v-bind:src="banner" alt="">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="dienVienModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Banner</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>@{{ dien_vien }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <td class="text-center align-middle">
                                    <button v-on:click="changeStatus(value.id)" class="btn btn-success"
                                        v-if="value.tinh_trang == 1">Đang chiếu</button>
                                    <button v-on:click="changeStatus(value.id)" class="btn btn-primary"
                                        v-else-if="value.tinh_trang == 2">Sắp chiếu</button>
                                    <button v-on:click="changeStatus(value.id)" class="btn btn-warning" v-else>Dừng
                                        chiếu</button>
                                </td>
                                <td class="text-center text-nowrap align-middle">
                                    <button v-on:click="data_update(value)" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#updateModal">Cập nhật</button>
                                    <button v-on:click="phim_delete = value" class="btn btn-danger"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal">Xoá bỏ</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">THÔNG BÁO</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Bạn chắc chắn muốn xoá phim <b class="text-danger">@{{ phim_delete.ten_phim }}</b></p>
                                    <p>Ngày khởi chiếu dự kiến <b class="text-danger">@{{ format_day(phim_delete.ngay_khoi_chieu) }}</b></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button v-on:click="deletePhim()" type="button" class="btn btn-primary" data-bs-dismiss="modal">Xác
                                        nhận</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật Phim</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Tên Phim</label>
                                                <input v-model="phim_update.ten_phim" type="text" class="form-control"
                                                    placeholder="Nhập vào tên phim">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Slug Tên Phim</label>
                                                <input v-model="phim_update.slug_ten_phim" type="text"
                                                    class="form-control" placeholder="Nhập vào slug tên phim">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Đạo Diễn</label>
                                                <input v-model="phim_update.dao_dien" type="text" class="form-control"
                                                    placeholder="Nhập vào đạo diễn">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Diễn Viên</label>
                                                <input v-model="phim_update.dien_vien" type="text"
                                                    class="form-control" placeholder="Nhập vào tên diễn viên">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Thể Loại</label>
                                                <input v-model="phim_update.the_loai" type="text" class="form-control"
                                                    placeholder="Nhập vào thể loại phim">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Thời Lượng</label>
                                                <input v-model="phim_update.thoi_luong" type="number"
                                                    class="form-control" placeholder="Nhập vào thời lượng phim">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Ngày Khởi Chiếu</label>
                                                <input v-model="phim_update.ngay_khoi_chieu" type="date"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">trailer</label>
                                                <input v-model="phim_update.trailer" type="text" class="form-control"
                                                    placeholder="Nhập vào link trailer phim">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Chất lượng phim</label>
                                            <select v-model="phim_update.chat_luong" class="form-control">
                                                <option value="0">2D</option>
                                                <option value="1">3D</option>
                                                <option value="2">1080p</option>
                                                <option value="3">4K</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Lứa Tuổi</label>
                                            <select v-model="phim_create.lua_tuoi" class="form-control">
                                                <option value="0">Mọi lứa tuổi</option>
                                                <option value="1">12+</option>
                                                <option value="2">16+</option>
                                                <option value="3">18+</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Avatar</label>
                                            <div class="input-group">
                                                <input id="hinh_anh_update" class="form-control" type="text"
                                                    name="filepath">
                                                <span class="input-group-prepend">
                                                    <a id="lfm_update" data-input="hinh_anh_update"
                                                        data-preview="holder_update" class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                            </div>
                                            <div id="holder_update" style="margin-top:15px;max-height:100px;"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Banner</label>
                                            <div class="input-group">
                                                <input id="banner_update" class="form-control" type="text"
                                                    name="filepath">
                                                <span class="input-group-prepend">
                                                    <a id="lfm_banner_update" data-input="banner_update"
                                                        data-preview="holder_banner_update" class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                            </div>
                                            <div id="holder_banner_update" style="margin-top:15px;max-height:100px;"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Tình trạng</label>
                                                <select v-model="phim_update.tinh_trang" class="form-control">
                                                    <option value="1">Đang chiếu</option>
                                                    <option value="2">Sắp chiếu</option>
                                                    <option value="0">Dừng chiếu</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label class="form-label">Mô Tả Phim</label>
                                            <textarea name="update_mo_ta" id="update_mo_ta" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button v-on:click="updatePhim()" type="button" class="btn btn-primary"
                                        data-bs-dismiss="modal">Cập nhật</button>
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
                                    <img v-bind:src="avatar" width="100%" height="500px" alt="">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Đóng</button>
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
                phim_create: {},
                phim_delete: {},
                phim_update: {},
                list_phim: [],
                slug: '',
                timestamp: '',
                avatar: '',
                banner: '',
                dien_vien: '',
            },

            created() {
                this.getNow();
                this.loadData();
            },

            methods: {
                // tinh_thoi_gian(time) {
                //     var now = new Date();  // Lấy thời gian hiện tại Asia
                //     var d = new Date(time); // định dạng thời gian về Date
                //     var che_bien = now.getMinutes() - d.getMinutes(); // Tính hiệu giữa 2 thời gian, tính theo phút
                //     return che_bien;
                // },

                truThoiGian(time) {
                    var now = new Date();
                    var d = new Date(time);
                    var rs = now.getMinutes() - d.getMinutes();
                    return rs;
                },

                changeStatus($id) {
                    console.log(aloalo);
                    axios
                        .get('/admin/phim/change-status/' + $id)
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

                updatePhim() {
                    this.phim_update.avatar = $("#hinh_anh_update").val();
                    this.phim_update.banner_phim = $("#banner_update").val();
                    this.phim_update.mo_ta = CKEDITOR.instances['update_mo_ta'].getData();
                    axios
                        .post('/admin/phim/update', this.phim_update)
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

                data_update(value) {
                    this.phim_update = value;
                    $('#hinh_anh_update').val(value.avatar);
                    var text = '<img src="' + value.avatar + '" style="margin-top:15px;max-height:100px;">';
                    $('#holder_update').html(text);
                    $('#banner_update').val(value.banner_phim);
                    var text1 = '<img src="' + value.banner_phim + '" style="margin-top:15px;max-height:100px;">';
                    $('#holder_banner_update').html(text1);
                    CKEDITOR.instances['update_mo_ta'].setData(value.mo_ta);
                },

                deletePhim() {
                    axios
                        .post('/admin/phim/delete', this.phim_delete)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.messages);
                                this.loadData();
                            }
                        });
                },

                getNow() {
                    const today = new Date();
                    const date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
                    this.timestamp = date;
                },

                format_day(value) {
                    return moment(String(value)).format('MM/DD/YYYY');
                },

                createPhim() {
                    this.phim_create.avatar = $("#hinh_anh").val();
                    this.phim_create.banner_phim = $("#hinh_anh_banner").val();
                    this.phim_create.mo_ta = CKEDITOR.instances['mo_ta'].getData();
                    this.phim_create.slug_ten_phim = this.slug;
                    axios
                        .post('/admin/phim/index', this.phim_create)
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
                        .get('/admin/phim/data')
                        .then((res) => {
                            this.list_phim = res.data.data;
                            // console.log(this.list_phim);
                        });
                },

                converseNameToSlug() {
                    this.slug = this.toSlug(this.phim_create.ten_phim);
                },

                toSlug(str) {
                    str = str.toLowerCase();
                    str = str.normalize('NFD').replace(/[̀-ͯ]/g, '');
                    str = str.replace(/[đĐ]/g, 'd');
                    str = str.replace(/([^0-9a-z-\s])/g, '');
                    str = str.replace(/(\s+)/g, '-');
                    str = str.replace(/-+/g, '-');
                    str = str.replace(/^-+|-+$/g, '');
                    return str;
                },
            },
        });
    </script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.19.1/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('mo_ta'); // replace name mô tả
        CKEDITOR.replace('update_mo_ta'); // replace name mô tả
    </script> --}}
    <script src='https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.19.1/ckeditor.js'></script>
    <script>
        CKEDITOR.replace('mo_ta');
        CKEDITOR.replace('update_mo_ta');
    </script>
    <script>
        var route_prefix = '/laravel-filemanager';
    </script>
    <script src='/vendor/laravel-filemanager/js/stand-alone-button.js'></script>
    <script>
        $('#lfm').filemanager('image', {
            prefix: route_prefix
        });
        $('#lfm_update').filemanager('image', {
            prefix: route_prefix
        });
        $('#lfm_banner').filemanager('image', {
            prefix: route_prefix
        });
        $('#lfm_banner_update').filemanager('image', {
            prefix: route_prefix
        });
    </script>
@endsection
