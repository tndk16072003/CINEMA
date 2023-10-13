@extends('client.share.master')

@section('content')
    <section class="blog-area blog-bg" data-background="/assets_client/img/bg/contact_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @foreach ($blog as $key => $value)
                        @php
                            $hinh_anh = explode(',', $value->hinh_anh);
                            if (Auth::guard('customer')->check()) {
                                $user = Auth::guard('customer')->user()->id;
                            } else {
                                $user = -1;
                            }
                        @endphp
                        <div class="blog-post-item">
                            <div class="blog-post-thumb">
                                <a href="/blog-detail/blog-detail-post-{{ $value->id }}"><img src="{{ $hinh_anh[0] }}"
                                        alt=""></a>
                            </div>
                            <div class="blog-post-content">
                                <span class="date"><i class="far fa-clock"></i>
                                    <?php
                                    $date = new DateTimeImmutable($value->created_at);
                                    echo $date->format('H:i d/m/Y');
                                    ?></span>
                                <h2 class="title"><a
                                        href="/blog-detail/blog-detail-post-{{ $value->id }}">{{ $value->tieu_de }}</a>
                                </h2>
                                <p>{{ $value->mo_ta_ngan }}</p>
                                <div class="blog-post-meta">
                                    <ul>
                                        <li class="like_button" data-id_bv="{{ $value->id }}">
                                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                                            <i class="far fa-thumbs-up"></i>{{ $value->so_luong_like }}
                                        </li>
                                        <li><i class="far fa-comments"></i><a
                                                href="/blog-detail/blog-detail-post-{{ $value->id }}">bình luận</a></li>
                                    </ul>
                                    <div class="read-more">
                                        <a href="/blog-detail/blog-detail-post-{{ $value->id }}">Đọc thêm <i
                                                class="fas fa-angle-double-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $blog->links() }}
                </div>
                <div class="col-lg-4">
                    <aside class="blog-sidebar">
                        <div class="widget blog-widget">
                            <div class="widget-title mb-30">
                                <h5 class="title">Search Objects</h5>
                            </div>
                            <form action="/search-blog" class="sidebar-search">
                                @csrf
                                <input type="text" name="value_search" placeholder="Search...">
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
                                    @foreach ($newBlog as $key => $value)
                                        @php
                                            $hinh_anh = explode(',', $value->hinh_anh);
                                        @endphp
                                        <li class="rc-post-item">
                                            <div class="thumb">
                                                <a href="/blog-detail/blog-detail-post-{{ $value->id }}"><img
                                                        width="100px" height="80px" src="{{ $hinh_anh[0] }}"
                                                        alt=""></a>
                                            </div>
                                            <div class="content">
                                                <h5 class="title"><a
                                                        href="/blog-detail/blog-detail-post-{{ $value->id }}">{{ $value->tieu_de }}</a>
                                                </h5>
                                                <span class="date"><i class="far fa-clock"></i>
                                                    <?php
                                                    $date = new DateTimeImmutable($value->created_at);
                                                    echo $date->format('H:i d/m/Y');
                                                    ?>
                                                </span>
                                            </div>
                                        </li>
                                    @endforeach
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
            $('.like_button').on('click', function() {
                var id_bv: $(this).data('id_bv');
                var id_user: {{ $user }};
                $.get('/client/like-bai-viet/', function(so_luong_like) {
                    console.log(so_luong_like);
                });
                // $.ajax({
                //     url : "", // gửi ajax đến file result.php
                //     type : "get", // chọn phương thức gửi là get
                //     dateType:"text", // dữ liệu trả về dạng text
                //     data : { // Danh sách các thuộc tính sẽ gửi đi
                //         id_bv: $(this).data('id_bv'),
                //         id_user: {{ $user }}
                //     },
                //     success : function (so_luong_like){
                //         // Sau khi gửi và kết quả trả về thành công thì gán nội dung trả về
                //         // đó vào thẻ div có id = result
                //         // $('#result').html(result);
                //         console.log(so_luong_like);
                //     }
                // });
                // $.ajax({
                //     type: "GET",
                //     url: "/client/like-bai-viet",
                //     data: {
                //         id_bv: $(this).data('id_bv'), // thay 123 bằng id_bv cần gửi đi
                //         id_user: {{ $user }} // thay 456 bằng id_user cần gửi đi
                //     },
                //     success: function(so_luong_like) {
                //         // xử lý khi gửi thành công
                //         console.log(so_luong_like);
                //     },
                // });
            });
        });
    </script>
@endsection
