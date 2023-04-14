@extends('layout.layout')


@section('title')
{!! $datas->titlePosts !!}
@endsection

@section('main')

<?php

use Carbon\Carbon;
use App\Http\Controllers\Controller;

Carbon::setLocale('vi');


?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<link rel="stylesheet" href="{{ asset('users/css/font-awesome.min.css') }}" type="text/css">
<style>
    .blog__details__desc>p>img {
        width: 100% !important;
        height: 100% !important;
    }

    .blog__feature__item__pic {
        width: 110px !important;
    }

    @media only screen and (max-width: 600px) {
        .btn-send-comment-blog {
            width: 100%;
        }
    }

    .slick-slider-prod-related-blog-1,
    .slick-slider-prod-related-blog-2 {
        position: relative;

    }

    .btn-prev-slider-prod-in-blog-1,
    .btn-next-slider-prod-in-blog-1,
    .btn-prev-slider-prod-in-blog-2,
    .btn-next-slider-prod-in-blog-2 {
        position: absolute;
        z-index: 50;
        border-radius: 50%;
        background: none;
        border: none;
        outline: none;
        font-size: 20px;


    }

    .btn-next-slider-prod-in-blog-1,
    .btn-next-slider-prod-in-blog-2 {
        right: 15px;
    }

    .ele-slider-prod-related-in-detail-posts {
        cursor: pointer;
    }
</style>
<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                    <!-- <a href="/blog/">Bài viết</a> -->
                    <a href="/blog/categories/{!! $datas->cate_posts->slugCatePost !!}.html">{{ $datas->cate_posts->nameCatePosts }}</a>
                    <span>{!! $datas->titlePosts !!}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Blog Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <div class="blog__details__content">
                    <div class="blog__details__item">
                        <img src="{{ $urlImageBlog }}{{ $datas->imagePosts }}" alt="">
                        <div class="blog__details__item__title">
                            <span class="tip">{{ $datas->cate_posts->nameCatePosts }}</span>
                            <h4>{!! $datas->titlePosts !!}</h4>
                            <ul>
                                <li>đăng bởi <span>{{ $datas->author }}</span></li>
                                <li><?= Carbon::parse($datas->created_at)->day . " " . Carbon::parse($datas->created_at)->translatedFormat('F') . ", " . Carbon::parse($datas->created_at)->year ?></li>
                                <li><?= Controller::DisplayViews($datas->viewPosts) ?> lượt xem</li>
                            </ul>
                        </div>
                    </div>
                    <div class="fb-like" data-href="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' . request()->getHttpHost() . '/blog/detail/' . $datas->cate_posts->slugCatePost . '/' . $datas->slugPosts . '.html' : 'http://127.0.0.1:8000/blog/detail/' . $datas->cate_posts->slugCatePost . '/' . $datas->slugPosts . '.html'; ?>" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
                    <div class="blog__details__desc">
                        <p>{!! $datas->summaryPosts !!}</p>
                    </div>
                    <!--  -->
                    @if(count($prods) > 0)
                    <em>Có thể bạn quan tâm các sản phẩm liên quan đến bài viết:</em>
                    <button type="button" class="text-danger btn-prev-slider-prod-in-blog-1"><i class="fas fa-angle-left"></i></button>
                    <button type="button" class="text-danger btn-next-slider-prod-in-blog-1"><i class="	fas fa-angle-right"></i></button>
                    <div class="row mb-4 slick-slider-prod-related-blog-1">
                        @foreach($prods as $item)
                        <?php
                        $price = ($item->price != 0) ? $item->price - ($item->price * $item->discount / 100) : $item->price;
                        ?>
                        <div data-slug="{!! $item->slug !!}" class="col-lg-3 ele-slider-prod-related-in-detail-posts">
                            <div class="card">
                                <img src="<?= $urlImageProd . $item->image ?>" class="card-img-top" alt="..." width="80px" height="120px">
                                <div class="card-body">
                                    <h5 class="card-title title-prod-in-posts p-0">{!! $item->name !!}</h5>
                                    <p class="card-text p-0">{{ number_format($price , 0, ',', '.') }}đ <?php echo ($item->discount != 0) ? '<strong class="text-danger">-' . $item->discount . '%</strong>' : '' ?></p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    <!--  -->
                    <!-- <div class="blog__details__quote">
                            <div class="icon"><i class="fa fa-quote-left"></i></div>
                            <p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna
                                aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                            aliquip ex ea commodo consequat.</p>
                        </div> -->
                    <div class="blog__details__desc">
                        {!! $datas->contentPosts !!}
                    </div>


                    <div class="blog__details__tags tags-of-detail">

                        <?php

                        foreach ($datas->tags as $key => $value) {
                            echo ' <a data-id="' . $value->id . '" href="' . $value->slugTagBlog . '">' . $value->nameTagBlog . '</a>';
                        }

                        ?>
                    </div>
                    <!--  -->
                    @if(count($prods) > 0)
                    <em>Có thể bạn quan tâm các sản phẩm liên quan đến bài viết:</em>
                    <button type="button" class="text-danger btn-prev-slider-prod-in-blog-2"><i class="fas fa-angle-left"></i></button>
                    <button type="button" class="text-danger btn-next-slider-prod-in-blog-2"><i class="	fas fa-angle-right"></i></button>
                    <div class="row mb-4 slick-slider-prod-related-blog-2">
                        @foreach($prods as $item)
                        <?php
                        $price = ($item->price != 0) ? $item->price - ($item->price * $item->discount / 100) : $item->price;
                        ?>
                        <div data-slug="{!! $item->slug !!}" class="col-lg-3 ele-slider-prod-related-in-detail-posts">
                            <div class="card">
                                <img src="<?= $urlImageProd . $item->image ?>" class="card-img-top" alt="..." width="80px" height="120px">
                                <div class="card-body">
                                    <h5 class="card-title title-prod-in-posts p-0">{!! $item->name !!}</h5>
                                    <p class="card-text p-0">{{ number_format($price , 0, ',', '.') }}đ <?php echo ($item->discount != 0) ? '<strong class="text-danger">-' . $item->discount . '%</strong>' : '' ?></p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    <!--  -->
                    <!-- <div class="blog__details__btns">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__details__btn__item">
                                    <h6><a href="#"><i class="fa fa-angle-left"></i> Previous posts</a></h6>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__details__btn__item blog__details__btn__item--next">
                                    <h6><a href="#">Next posts <i class="fa fa-angle-right"></i></a></h6>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="fb-like" data-href="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' . request()->getHttpHost() . '/blog/detail/' . $datas->cate_posts->slugCatePost . '/' . $datas->slugPosts . '.html' : 'http://127.0.0.1:8000/blog/detail/' . $datas->cate_posts->slugCatePost . '/' . $datas->slugPosts . '.html'; ?>" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
                    <div class="fb-comments" data-href="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' . request()->getHttpHost() . '/blog/detail/' . $datas->cate_posts->slugCatePost . '/' . $datas->slugPosts . '.html' : 'http://127.0.0.1:8000/blog/detail/' . $datas->cate_posts->slugCatePost . '/' . $datas->slugPosts . '.html'; ?>" data-width="100%" data-numposts="5"></div>
                    <!-- <div class="blog__details__comment">
                        <h5>3 Bình luận</h5>
                        <a href="#div-text" class="leave-btn">Để lại bình luận</a>
                        <div class="row">
                            <div class="col-lg-12 mb-4">
                                <form id="form-comment-blog">
                                    <div class="form-group">
                                        <textarea style="resize: none;" class="form-control" name="" id="" cols="30" rows="5"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-send-comment-blog"><i class="	fas fa-paper-plane"></i> Gửi bình luận</button>
                                </form>
                            </div>
                        </div>
                        <div class="blog__comment__item">
                            <div class="blog__comment__item__pic">
                                <img src="{{ asset('users/img/blog/details/comment-1.jpg') }}" alt="">
                            </div>
                            <div class="blog__comment__item__text">
                                <h6>Brandon Kelley</h6>
                                <p>Duis voluptatum. Id vis consequat consetetur dissentiet, ceteros commune perpetua
                                    mei et. Simul viderer facilisis egimus tractatos splendi.</p>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i> Seb 17, 2019</li>
                                    <li><i class="fas fa-heart"></i> 12</li>
                                    <li><i class="fa fa-share"></i> 1</li>
                                </ul>
                            </div>
                        </div>
                        <div class="blog__comment__item blog__comment__item--reply">
                            <div class="blog__comment__item__pic">
                                <img src="{{ asset('users/img/blog/details/comment-2.jpg') }}" alt="">
                            </div>
                            <div class="blog__comment__item__text">
                                <h6>Brandon Kelley</h6>
                                <p>Consequat consetetur dissentiet, ceteros commune perpetua mei et. Simul viderer
                                    facilisis egimus ulla mcorper.</p>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i> Seb 17, 2019</li>
                                    <li><i class="fas fa-heart"></i> 12</li>
                                    <li><i class="fa fa-share"></i> 1</li>
                                </ul>
                            </div>
                        </div>
                        <div class="blog__comment__item">
                            <div class="blog__comment__item__pic">
                                <img src="{{ asset('users/img/blog/details/comment-3.jpg') }}" alt="">
                            </div>
                            <div class="blog__comment__item__text">
                                <h6>Brandon Kelley</h6>
                                <p>Duis voluptatum. Id vis consequat consetetur dissentiet, ceteros commune perpetua
                                    mei et. Simul viderer facilisis egimus tractatos splendi.</p>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i> Seb 17, 2019</li>
                                    <li><i class="fas fa-heart"></i> 12</li>
                                    <li><i class="fa fa-share"></i> 1</li>
                                </ul>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__item">
                        <div class="section-title">
                            <h4>Chuyên mục</h4>
                        </div>
                        <ul>
                            <li><a href="/blog/">Tất cả <span>({{ $totalBlog }})</span></a></li>

                            @foreach($cates as $cate)
                            <li><a href="/blog/categories/{!! $cate->slugCatePost !!}.html">{{$cate->nameCatePosts}} <span>({{count($cate->posts)}})</span></a></li>
                            @endforeach
                            <!--                            
                            <li><a href="#">Street style <span>(75)</span></a></li>
                            <li><a href="#">Lifestyle <span>(35)</span></a></li>
                            <li><a href="#">Beauty <span>(60)</span></a></li> -->
                        </ul>
                    </div>
                    <div class="blog__sidebar__item">
                        <div class="section-title">
                            <h4>Tin liên quan</h4>
                        </div>

                        @foreach($related as $item)

                        <a href="/blog/detail/{!! $item->cate_posts->slugCatePost !!}/{!! $item->slugPosts !!}.html" class="blog__feature__item">
                            <div class="blog__feature__item__pic">
                                <img src="<?php echo ($item->imagePosts != null) ? $urlImageBlog . $item->imagePosts : 'https://artsmidnorthcoast.com/wp-content/uploads/2014/05/no-image-available-icon-6.png' ?>" alt="">
                            </div>
                            <div class="blog__feature__item__text title-blog-related">
                                <h6>{!! $item->titlePosts !!}</h6>
                                <span><?= Carbon::parse($item->created_at)->day . " " . Carbon::parse($item->created_at)->translatedFormat('F') . ", " . Carbon::parse($item->created_at)->year ?></span>
                            </div>
                        </a>
                        @endforeach




                    </div>
                    <div class="blog__sidebar__item">
                        <div class="section-title">
                            <h4>Từ khóa tìm kiếm</h4>
                        </div>
                        <div class="blog__sidebar__tags tags-of-detail">
                            <?php

                            foreach ($datas->tags as $key => $value) {
                                echo ' <a data-id="' . $value->id . '" href="' . $value->slugTagBlog . '">' . $value->nameTagBlog . '</a>';
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    function AjaxSetup() {
        return $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }
    var host = 'http://127.0.0.1:3000/';
</script>
<script src="{{ asset('users/js/blog.js') }}"></script>
<!-- Script Plugin FACEBOOK -->
<div id="fb-root"></div>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, "script", "facebook-jssdk"));
</script>
@endsection


<!--  -->
<!-- Instagram End -->

<!-- Footer Section Begin -->