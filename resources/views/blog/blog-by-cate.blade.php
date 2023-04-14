@extends('layout.layout')


@section('title')
{{ $dataCate->nameCatePosts }}
@endsection

@section('main')
<style>
   .blog__item__pic{
       height: 200px !important;
   }
</style>
<?php

use Carbon\Carbon;
Carbon::setLocale('vi');


?>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>{{ $dataCate->nameCatePosts }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div id="row-all-blog-by-cate" class="row">

            <!--  -->
           
            @foreach($blogs as $value)
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic large__item set-bg" data-setbg="<?php echo ($value->imagePosts != null) ? $urlImageBlog.$value->imagePosts : 'https://artsmidnorthcoast.com/wp-content/uploads/2014/05/no-image-available-icon-6.png' ?>"></div>
                    <div class="blog__item__text">
                        <h6><a href="/blog/detail/{!! $value->cate_posts->slugCatePost !!}/{!! $value->slugPosts !!}.html">{!! $value->titlePosts  !!}</a></h6>
                        <ul>
                            <li>đăng bởi <span>{{ $value->author }}</span></li>
                            <li><?= Carbon::parse($value->created_at)->day." ". Carbon::parse($value->created_at)->translatedFormat('F').", ".Carbon::parse($value->created_at)->year ?></li>
                        </ul>
                    </div>
                </div>
                </div>
            @endforeach
         
       

            <!--  -->


            <!--  -->

            <!--  -->

            <!-- <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="img/blog/blog-2.jpg"></div>
                    <div class="blog__item__text">
                        <h6><a href="#">Amf Cannes Red Carpet Celebrities Kendall Jenner, Pamela...</a></h6>
                        <ul>
                            <li>by <span>Ema Timahe</span></li>
                            <li>Seb 17, 2019</li>
                        </ul>
                    </div>
                </div>
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="img/blog/blog-4.jpg"></div>
                    <div class="blog__item__text">
                        <h6><a href="#">Ireland Baldwin Shows Off Trendy Ilse Valfre Tattoo At Stagecoach...</a>
                        </h6>
                        <ul>
                            <li>by <span>Ema Timahe</span></li>
                            <li>Seb 17, 2019</li>
                        </ul>
                    </div>
                </div>
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="img/blog/blog-8.jpg"></div>
                    <div class="blog__item__text">
                        <h6><a href="#">Kim Kardashian Steps Out In Paris Wearing Shocking Sparkly...</a></h6>
                        <ul>
                            <li>by <span>Ema Timahe</span></li>
                            <li>Seb 17, 2019</li>
                        </ul>
                    </div>
                </div>
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="img/blog/blog-10.jpg"></div>
                    <div class="blog__item__text">
                        <h6><a href="#">A-list Battle! Angelina Jolie & Lady Gaga Fighting Over Who...</a></h6>
                        <ul>
                            <li>by <span>Ema Timahe</span></li>
                            <li>Seb 17, 2019</li>
                        </ul>
                    </div>
                </div>
            </div> -->

            <!--  -->



            <!-- <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="img/blog/blog-3.jpg"></div>
                    <div class="blog__item__text">
                        <h6><a href="#">Gigi Hadid, Rita Ora, Serena & Other Hot Celebs Stun At 2019...</a></h6>
                        <ul>
                            <li>by <span>Ema Timahe</span></li>
                            <li>Seb 17, 2019</li>
                        </ul>
                    </div>
                </div>
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="img/blog/blog-5.jpg"></div>
                    <div class="blog__item__text">
                        <h6><a href="#">Billboard Music Awards: Best, Worst & Wackiest Dresses On The...</a></h6>
                        <ul>
                            <li>by <span>Ema Timahe</span></li>
                            <li>Seb 17, 2019</li>
                        </ul>
                    </div>
                </div>
                <div class="blog__item">
                    <div class="blog__item__pic large__item set-bg" data-setbg="img/blog/blog-6.jpg"></div>
                    <div class="blog__item__text">
                        <h6><a href="#">Stephanie Pratt Busts Out Of Teeny Black Bikini During Hawaii...</a></h6>
                        <ul>
                            <li>by <span>Ema Timahe</span></li>
                            <li>Seb 17, 2019</li>
                        </ul>
                    </div>
                </div>
            </div> -->
            @if($count > 12)
            <div class="col-lg-12 text-center box-tag-a-view-more-blog-by-cate">
                <a href="#" data-cate="{!! $dataCate->slugCatePost !!}" data-id="{{ $idMin }}" class="primary-btn load-btn a-btn-view-more-blog-by-cate">Xem thêm {{ $remaining }} bài viết</a>
            </div>
            @endif



            <!--  -->
        </div>
    </div>
</section>
<!-- Blog Section End -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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
<script src="{{ asset('users/js/blog-by-cate.js') }}"></script>
@endsection


<!--  -->
<!-- Instagram End -->

<!-- Footer Section Begin -->