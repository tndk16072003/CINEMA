@extends('client.share.master')

@section('content')
    <section class="movie-details-area" data-background="/assets_client/img/bg/movie_details_bg.jpg">
        <div class="container" id="app">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-primary text-center"><b>MÀN HÌNH</b></div>
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered table-bg-white">
                        <tr v-for="i in hang_ngang">
                            {{-- 1: còn trống, 2: giữ chỗ, 0: đã thanh toán --}}
                            <template v-if="i != hang_ngang">
                                <template v-for="j in hang_doc">
                                    {{-- <td>@{{ list_ghe[(i - 1) * hang_doc + (j - 1)].ten_ghe }}</td> --}}
                                    <td v-on:click="giuCho(list_ghe[(i - 1) * hang_doc + (j - 1)])" v-if="list_ghe[(i - 1) * hang_doc + (j - 1)].trang_thai == 1" style="background-color: white; color: black; text-align: center"><b>@{{ list_ghe[(i - 1) * hang_doc + (j - 1)].ten_ghe }}</b></td>
                                    <template v-else-if="list_ghe[(i - 1) * hang_doc + (j - 1)].trang_thai == 2">
                                        <td v-if="user_login == list_ghe[(i - 1) * hang_doc + (j - 1)].id_khach_hang" v-on:click="huyGhe(list_ghe[(i - 1) * hang_doc + (j - 1)])" style="background-color: rgb(16, 165, 206); color: black; text-align: center"><b>@{{ list_ghe[(i - 1) * hang_doc + (j - 1)].ten_ghe }}</b></td>
                                        <td v-else v-on:click="giuCho(list_ghe[(i - 1) * hang_doc + (j - 1)])" style="background-color: white; color: black; text-align: center"><b>@{{ list_ghe[(i - 1) * hang_doc + (j - 1)].ten_ghe }}</b></td>
                                    </template>
                                    <td v-else style="background-color: red; color: black; text-align: center"><b>@{{ list_ghe[(i - 1) * hang_doc + (j - 1)].ten_ghe }}</b></td>
                                </template>
                            </template>
                            <template v-else>
                                <template v-for="j in (hang_doc/2)">
                                    {{-- <td>@{{ list_ghe[(i - 1) * hang_doc + (j - 1)].ten_ghe }}</td> --}}
                                    <td colspan="2" v-on:click="giuCho(list_ghe[(i - 1) * hang_doc + (j - 1)])" v-if="list_ghe[(i - 1) * hang_doc + (j - 1)].trang_thai == 1" style="background-color: white; color: black; text-align: center"><b>@{{ list_ghe[(i - 1) * hang_doc + (j - 1)].ten_ghe }}</b></td>
                                    <template v-else-if="list_ghe[(i - 1) * hang_doc + (j - 1)].trang_thai == 2">
                                        <td colspan="2" v-if="user_login == list_ghe[(i - 1) * hang_doc + (j - 1)].id_khach_hang" v-on:click="huyGhe(list_ghe[(i - 1) * hang_doc + (j - 1)])" style="background-color: rgb(16, 165, 206); color: black; text-align: center"><b>@{{ list_ghe[(i - 1) * hang_doc + (j - 1)].ten_ghe }}</b></td>
                                        <td colspan="2" v-else v-on:click="giuCho(list_ghe[(i - 1) * hang_doc + (j - 1)])" style="background-color: white; color: black; text-align: center"><b>@{{ list_ghe[(i - 1) * hang_doc + (j - 1)].ten_ghe }}</b></td>
                                    </template>
                                    <td colspan="2" v-else style="background-color: red; color: black; text-align: center"><b>@{{ list_ghe[(i - 1) * hang_doc + (j - 1)].ten_ghe }}</b></td>
                                </template>
                            </template>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12 text-right">
                    <a href="/client/thanh-toan" class="m-1 banner-btn btn wow">Thanh Toán</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
<script>
    new Vue({
        el : '#app',

        data: {
            hang_ngang  : 0,
            hang_doc    : 0,
            list_ghe    : [],
            id_lich     : {{ $id_lich }},
            user_login  : {{ $user_login }},
        },

        created() {
            this.loadData();
        },

        methods: {
            giuCho(value) {
                axios
                    .get('/client/dat-ve/giu-cho/' + value.id)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success(res.data.messages);
                            this.loadData();
                        } else {
                            toastr.error(res.data.messages);
                        }
                    });
            },

            huyGhe(value) {
                axios
                    .get('/client/dat-ve/huy-ghe/' + value.id)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success(res.data.messages);
                            this.loadData();
                        } else {
                            toastr.error(res.data.messages);
                        }
                    });
            },

            loadData() {
                axios
                    .get('/client/ghe-phong-hien-thi/' + this.id_lich)
                    .then((res) => {
                        this.hang_doc = res.data.hang_doc;
                        this.hang_ngang = res.data.hang_ngang;
                        this.list_ghe = res.data.data;
                        console.log(this.list_ghe);
                        console.log(this.hang_doc);
                        console.log(this.hang_ngang);
                    });
            },
        },
    });
</script>
@endsection
