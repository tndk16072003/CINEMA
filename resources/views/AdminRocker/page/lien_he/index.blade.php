@extends('AdminRocker.master_rocker')

@section('noi_dung')
    <div class="container" id="app">
        <h4 class="text-center">Quản Lý Liên Hệ</h4>
        <div class="card">
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th class="text-center text-nowrap align-middle">#</th>
                            <th class="text-center text-nowrap align-middle">Họ và tên</th>
                            <th class="text-center text-nowrap align-middle">Email</th>
                            <th class="text-center text-nowrap align-middle">Tiêu đề</th>
                            <th class="text-center text-nowrap align-middle">Nội dung</th>
                            <th class="text-center text-nowrap align-middle">Tình trạng</th>
                            <th class="text-center text-nowrap align-middle">Action</th>
                        </thead>
                        <tbody>
                            <tr v-for="(value, key) in list_contact">
                                <th class="text-center text-nowrap align-middle">@{{ key + 1 }}</th>
                                <td class="text-center text-nowrap align-middle">@{{ value.ho_va_ten }}</td>
                                <td class="text-center text-nowrap align-middle">@{{ value.email }}</td>
                                <td class="text-center text-nowrap align-middle">@{{ value.tieu_de }}</td>
                                <td class="text-center text-nowrap align-middle">
                                    <button class="btn btn-primary" v-on:click="noi_dung = value.noi_dung"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">Nội
                                        dung</button>
                                </td>
                                <td class="text-center text-nowrap align-middle">
                                    <button v-on:click="changeStatus(value)" class="btn btn-success"
                                        v-if="value.is_xu_ly == 1">Đã xử lý</button>
                                    <button v-on:click="changeStatus(value)" class="btn btn-warning" v-else>Chờ xử lý</button>
                                </td>
                                <td class="text-center text-nowrap align-middle">
                                    <button class="btn btn-info">Trả Lời</button>
                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" v-on:click="xoa_bo = value">Xoá</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Nội Dung</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <textarea disabled cols="30" rows="10" style="width: 100%">@{{ noi_dung }}</textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Thông Báo</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Bạn chắc chắn muốn xoá liên hệ này?</p>
                            <p><b><u>Lưu ý</u>: </b>Thao tác này sẽ không thể hoàn tác!</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-primary" v-on:click="deleteContact()" data-bs-dismiss="modal">Xác nhận</button>
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
                list_contact: [],
                noi_dung: '',
                xoa_bo : {},
            },

            created() {
                this.loadData();
            },

            methods: {
                loadData() {
                    axios
                        .get('/admin/lien-he/data')
                        .then((res) => {
                            this.list_contact = res.data.data;
                            console.log(this.list_contact);
                        });
                },

                changeStatus(value) {
                    axios
                        .get('/admin/lien-he/change-status/' + value.id)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.messages);
                                this.loadData();
                            }
                        });
                },

                deleteContact() {
                    axios
                        .post('/admin/lien-he/delete', this.xoa_bo)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success (res.data.messages);
                                this.loadData();
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
            },
        });
    </script>
@endsection
