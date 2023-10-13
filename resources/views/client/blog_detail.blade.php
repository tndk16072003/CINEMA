@extends('client.share.master')
@section('content')
    <section class="blog-details-area blog-bg" data-background="/assets_client/img/bg/contact_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-post-item blog-details-wrap">
                        @php $hinh_anh = explode(',', $blog_detail->hinh_anh) @endphp
                        <div class="blog-post-thumb">
                            <a href="#"><img src="{{ $hinh_anh[0] }}" alt=""></a>
                        </div>
                        <div class="blog-post-content">
                            <div class="blog-details-top-meta">
                                <span class="user"><i class="far fa-user"></i> by <a href="#">Admin</a></span>
                                <span class="date"><i class="far fa-clock"></i> <?php
                                $date = new DateTimeImmutable($blog_detail->created_at);
                                echo $date->format('H:i d/m/Y');
                                ?></span>
                            </div>
                            <h2 class="title">{{ $blog_detail->tieu_de }}</h2>
                            <p>{{ $blog_detail->noi_dung }}</p>
                            <blockquote>
                                <i class="fas fa-quote-right"></i>
                                <p>Watch Mobflx movies & TV shows online or stream rights to your smart TV, game console,
                                    PC, mobile more.</p>
                                <figure><span>Frenk Smith</span> Founder ceo</figure>
                            </blockquote>
                            <div class="blog-img-wrap">
                                <div class="row">
                                    @foreach ($hinh_anh as $key => $value)
                                        @if ($key > 0)
                                            <div class="col-sm-6">
                                                <img width="385px" height="300px" src="{{ $value }}" alt="">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="blog-post-meta">
                                <div class="blog-details-tags">
                                    <ul>
                                        <li><i class="fas fa-tags"></i> <span>Tags :</span></li>
                                        <li><a href="#">Movies ,</a> <a href="#">Creative ,</a> <a
                                                href="#">News ,</a> <a href="#">English</a></li>
                                    </ul>
                                </div>
                                <div class="blog-post-share">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (isset($comment))
                        <div class="blog-comment mb-80">
                            <div class="widget-title mb-45">
                                <h5 class="title">Comment</h5>
                            </div>
                            @foreach ($comment as $key => $value)
                                <ul class="mt-4">
                                    <li>
                                        <div class="single-comment">
                                            <div class="comment-avatar-img">
                                                <img src="{{ $value->avatar }}" alt="img">
                                            </div>
                                            <div class="comment-text">
                                                <div class="comment-avatar-info">
                                                    <div class="row">
                                                        <div class="col-md-10" style="width: 600px">
                                                            <h5>{{ $value->ho_va_ten }}</h5>
                                                            <p>{{ $value->noi_dung }}</p>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <a id="reply" class="comment-reply-link"
                                                                data-id_cmt="{{ $value->id }}">Reply <i
                                                                    class="fas fa-reply-all"></i></a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </li>
                                    @php
                                        $data = DB::table('comments')
                                            ->where('id_binh_luan', $value->id)
                                            ->get();
                                        $cmtCon = json_decode($data);
                                    @endphp
                                    @if (isset($cmtCon))
                                        @foreach ($cmtCon as $k => $v)
                                            <li class="comment-reply">
                                                <div class="single-comment">
                                                    <div class="comment-avatar-img">
                                                        <img src="{{ $v->avatar }}" alt="img">
                                                    </div>
                                                    <div class="comment-text">
                                                        <div class="comment-avatar-info">
                                                            <div class="row">
                                                                <div class="col-md-10" style="width: 600px">
                                                                    <h5>{{ $v->ho_va_ten }}</h5>
                                                                    <p>{{ $v->noi_dung }}</p>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <a id="reply" class="comment-reply-link"
                                                                        data-id_cmt="{{ $value->id }}">Reply <i
                                                                            class="fas fa-reply-all"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            @endforeach
                        </div>
                    @endif
                    <div class="contact-form-wrap">
                        <div class="widget-title mb-50" id="form_binh_luan">
                            <h5 class="title">Post a Comment</h5>
                        </div>
                        <div class="contact-form">
                            <form action="/client/binh-luan" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <input name="id_bai_viet" type="hidden" value="{{ $blog_detail->id }}">
                                    </div>
                                    <div class="col-md-12">
                                        <input name="id_binh_luan" type="hidden" id="id_binh_luan">
                                    </div>
                                </div>
                                <textarea id="message" name="noi_dung" placeholder="Type Your Message..."></textarea>
                                <button type="submit" class="btn">Send Message</button>
                            </form>
                        </div>
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
            $('.comment-reply-link').click(function() {
                var id_cmt = $(this).data('id_cmt');
                $('#id_binh_luan').val(id_cmt);
                $('html, body').animate({
                    scrollTop: $("#form_binh_luan").offset().top
                }, 1000);
            });
            $('#message').keyup(function() {
                if({!! json_encode($checkUserLogin) !!} == false) {
                    toastr.warning('Chức năng này cần phải đăng nhập');
                }
            });
        });
    </script>
@endsection
