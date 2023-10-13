@extends('AdminRocker.master_rocker')

@section('noi_dung')
    <div class="row" id="app">
        <h4 class="text-center">Quản Lý Bình Luận</h4>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <th class="text-center text-nowrap align-middle">#</th>
                        <th class="text-center text-nowrap align-middle">Họ và tên</th>
                        <th class="text-center text-nowrap align-middle">Email</th>
                        <th class="text-center text-nowrap align-middle">Nội dung</th>
                        <th class="text-center text-nowrap align-middle">Bài viết</th>
                        <th class="text-center text-nowrap align-middle">Trả lời bình luận</th>
                        <th class="text-center text-nowrap align-middle">Action</th>
                    </thead>
                    <tbody>
                        {{-- value - bình luận, v - bài viết, v1 - bình luận, v2 - user --}}
                        <tr v-for="(value, key) in list">
                            <th class="align-middle text-center">@{{ key + 1 }}</th>
                            <td class="align-middle">@{{ value.ho_va_ten }}</td>
                            <td class="align-middle">@{{ value.email }}</td>
                            <td class="align-middle">
                                <button v-on:click="noi_dung = value.noi_dung" class="btn btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#noiDungModal">Nội dung</button>
                            </td>
                            <template v-for="(v, k) in list_bai_viet">
                                <td class="align-middle" v-if="v.id == value.id_bai_viet">@{{ v.tieu_de }}</td>
                            </template>
                            <td v-if="value.id_binh_luan == null"></td>
                            <template v-for="(v1, k1) in list">
                                <template v-if="v1.id == value.id_binh_luan">
                                        <td >@{{ v1.ho_va_ten }}</td>
                                </template>
                            </template>
                            <td class="align-middle text-center text-nowrap">
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    v-on:click="xoa = value">Xoá</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Xoá Bình Luận</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input class="form-control" type="hidden" v-bind:value="xoa.id">
                                <p>Bạn chắc chắn muốn xoá bình luận của <b>@{{ xoa.ho_va_ten }}</b>?</p>
                                <p><b><u>Lưu ý</u>: </b>Thao tác này sẽ không thể hoàn tác</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                    v-on:click="xoaBinhLuan()">Xác nhận</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="noiDungModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nội Dung</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>@{{ noi_dung }}</p>
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
                list: [],
                xoa: {},
                list_bai_viet: [],
                noi_dung: '',
                user: [],
            },

            created() {
                this.loadData();
                this.loadBaiViet();
            },

            methods: {
                loadData() {
                    axios
                        .get('/admin/binh-luan/data')
                        .then((res) => {
                            this.list = res.data.data;
                            console.log(this.list);
                            this.user = res.data.user;
                            console.log(this.user);
                            // console.log(this.list);
                            // console.log(this.user);
                        });
                },

                xoaBinhLuan() {
                    axios
                        .post('/admin/binh-luan/delete', this.xoa)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.messages);
                                this.loadData();
                            }
                        });
                },

                loadBaiViet() {
                    axios
                        .get('/admin/bai-viet/data')
                        .then((res) => {
                            this.list_bai_viet = res.data.data;
                        });
                },

            },
        });
    </script>
@endsection
