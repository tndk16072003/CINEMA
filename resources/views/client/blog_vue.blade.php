@extends('client.share.master')

@section('content')
    <section class="blog-area blog-bg" data-background="/assets_client/img/bg/contact_bg.jpg">
        <div class="container" id="app">
            <div class="row">
                <div class="col-lg-8">
                    <template v-for="(v, k) in list">
                        {{-- @{{ k }} --}}
                        <div class="blog-post-item">
                            <div class="blog-post-thumb">
                                <a v-bind:href="'/blog-detail/blog-detail-post-' + v.id"><img
                                        v-bind:src="v.hinh_anh.split(',')[0]" alt=""></a>
                            </div>
                            <div class="blog-post-content">
                                <span class="date"><i class="far fa-clock"></i> @{{ format_day(v.created_at) }}</span>
                                <h2 class="title"><a
                                        v-bind:href="'/blog-detail/blog-detail-post-' + v.id">@{{ v.tieu_de }}</a>
                                </h2>
                                <p>@{{ v.mo_ta_ngan }}</p>
                                <div class="blog-post-meta">
                                    <ul>
                                        <template v-if="user_login == null">
                                            <li><a v-bind:href="'/client/like-bai-viet/' + v.id + '/1'"><i
                                                        class="far fa-thumbs-up"></i> @{{ v.so_luong_like }}</a></li>
                                        </template>
                                        <template v-else>
                                            <template v-if="v.check_like == false">
                                                <li><i v-on:click="like(v)" class="far fa-thumbs-up"></i>
                                                    @{{ v.so_luong_like }}</li>
                                            </template>
                                            <template v-else>
                                                <li><i v-on:click="like(v)" class="fa-solid fa-thumbs-up"></i>
                                                    @{{ v.so_luong_like }}</li>
                                            </template>
                                        </template>
                                        <li><i class="far fa-comments"></i><a
                                                v-bind:href="'/blog-detail/blog-detail-post-' + v.id"> Bình luận</a></li>
                                    </ul>
                                    <div class="read-more">
                                        <a v-bind:href="'/blog-detail/blog-detail-post-' + v.id">Read More <i
                                                class="fas fa-angle-double-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                    <div style="text-align: left">
                        <nav class="m-b-30" aria-label="Page navigation example">
                            <ul class="pagination justify-content-end pagination-primary">
                                <li class="page-item">
                                    <a class="page-link" href="javascript:void(0)" aria-label="Previous"
                                        @click.prevent="changePage(pagination.current_page - 1)">
                                        <span aria-hidden="true">Pre</span>
                                    </a>
                                </li>
                                <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']"
                                    class="page-item">
                                    <a class="page-link" href="javascript:void(0)"
                                        @click.prevent="changePage(page)">@{{ page }}</a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a href="javascript:void(0)" class="page-link" aria-label="Next"
                                        @click.prevent="changePage(pagination.current_page + 1)">
                                        <span aria-hidden="true">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <aside class="blog-sidebar">
                        <div class="widget blog-widget">
                            <div class="widget-title mb-30">
                                <h5 class="title">Search Objects</h5>
                            </div>
                            <form action="/search-blog" method="post" class="sidebar-search">
                                @csrf
                                <input type="text" name="value_search_blog" placeholder="Search...">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                        <div class="widget blog-widget">
                            <div class="widget-title mb-30">
                                <h5 class="title">Categories</h5>
                            </div>
                            <div class="sidebar-cat">
                                <ul>
                                    <li><a href="#">Movies</a> <span>12</span></li>
                                    <li><a href="#">Action Movies</a> <span>10</span></li>
                                    <li><a href="#">Streaming</a> <span>9</span></li>
                                    <li><a href="#">Download</a> <span>16</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget blog-widget">
                            <div class="widget-title mb-30">
                                <h5 class="title">Recent Posts</h5>
                            </div>
                            <div class="rc-post">
                                <ul>
                                    <template v-for="(value, key) in recent_posts">
                                        <li class="rc-post-item">
                                            <div class="thumb">
                                                <a v-bind:href="'/blog-detail/blog-detail-post-' + value.id"><img
                                                        style="width: 100px; height: 80px;"
                                                        v-bind:src="value.hinh_anh.split(',')[0]" alt=""></a>
                                            </div>
                                            <div class="content">
                                                <h5 class="title"><a
                                                        v-bind:href="'/blog-detail/blog-detail-post-' + value.id">@{{ catChuoi(value.tieu_de) }}...</a>
                                                </h5>
                                                <span class="date"><i class="far fa-clock"></i>@{{ format_day(value.created_at) }}
                                                </span>
                                            </div>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                        <div class="widget blog-widget">
                            <div class="widget-title mb-30">
                                <h5 class="title">Tag Post</h5>
                            </div>
                            <div class="tag-list">
                                <ul>
                                    <li><a href="#">Movies</a></li>
                                    <li><a href="#">Creative</a></li>
                                    <li><a href="#">News</a></li>
                                    <li><a href="#">Romantic</a></li>
                                    <li><a href="#">Who</a></li>
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">Blending</a></li>
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            new Vue({
                el: '#app',

                data: {
                    list: [],
                    pagination: {
                        total: 0,
                        per_page: 2,
                        from: 1,
                        to: 0,
                        current_page: 1
                    },
                    offset: 4,
                    user_login: {},
                    so_luong: -1,
                    recent_posts: [],
                },

                created() {
                    this.loadData(this.pagination.current_page);
                },

                computed: {
                    isActived: function() {
                        return this.pagination.current_page;
                    },
                    pagesNumber: function() {
                        if (!this.pagination.to) {
                            return [];
                        }
                        var from = this.pagination.current_page - this.offset;
                        if (from < 1) {
                            from = 1;
                        }
                        var to = from + (this.offset * 2);
                        if (to >= this.pagination.last_page) {
                            to = this.pagination.last_page;
                        }
                        var pagesArray = [];
                        while (from <= to) {
                            pagesArray.push(from);
                            from++;
                        }
                        return pagesArray;
                    }
                },

                methods: {
                    catChuoi(text) {
                        return text.substring(0, 50);
                    },

                    like(v) {
                        axios
                            .get('/client/like-bai-viet/' + v.id + '/' + this.user_login.id)
                            .then((res) => {
                                if (res.data.status) {
                                    this.loadData(this.pagination.current_page);
                                } else {
                                    this.loadData(this.pagination.current_page);
                                }
                            });
                    },

                    loadData: function(page) {
                        axios
                            .get('/data-home-page?page=' + page) // đổi link ở đây
                            .then((res) => {
                                this.list = res.data.data.data.data; // chỉ đổi ở đây
                                console.log(this.list);
                                this.recent_posts = res.data.data.recent_posts;
                                console.log(this.recent_posts);
                                this.pagination = res.data.data.pagination;
                                this.so_luong = res.data.data.data.so_luong;
                                this.user_login = res.data.data.user_login;
                                console.log(this.user_login);
                            });
                    },

                    format_day(value) {
                        return moment(String(value)).format('HH:mm DD/MM/YYYY');
                    },

                    changePage: function(page) {
                        this.pagination.current_page = page;
                        this.loadData(page);
                    },
                },
            });
        });
    </script>
@endsection
