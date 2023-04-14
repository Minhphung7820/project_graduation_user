@extends('layout.layout')
@section('title','Trang Chủ')
@section('main')
<!-- Categories Section Begin -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<style>
    .reletive {
        position: relative;
    }

    .absolute {
        position: absolute;
        top: 5%;
        left: 5%;
        padding: 0px 3px;
        font-size: 9px;
        background-color: #36a300;
        color: #fff;
    }

    /* Pagination*/
    #paginateHome ul {
        list-style: none;
        display: flex;
        justify-content: center;
    }

    #paginateHome .active {
        background-color: #000;
        color: #fff;
        border-radius: 50%;
    }

    #paginateHome .active a {
        color: #fff;
    }

    #paginateHome .disabled {
        display: none;
    }

    #paginateHome a:hover {
        cursor: pointer;
    }

    .product__item__pic img {
        width: 100%;
        height: 100%;
    }

    /* slide show  */
    * {
        box-sizing: border-box
    }

    /* thiết lập style cho slideshow container */
    .slideshow-container {
        max-width: 1000px;
        position: relative;
        margin: auto;
    }

    /* ẩn hình ảnh cho phần tử slideshow */
    .mySlides {
        display: none;
    }

    /* thiết kế nút mũi tên*/
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        margin-top: -22px;
        padding: 16px;
        color: white;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
    }

    /* thiết kế nút mũi tên next nằm phía bên phải */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* hiệu ứng thay đổi background khi hover vào nút mũi tên*/
    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Thiết lập style cho nội dung của mỗi phần tử slideshow */
    .text {
        color: #f2f2f2;
        font-size: 15px;
        padding: 8px 12px;
        position: absolute;
        bottom: 8px;
        width: 100%;
        text-align: center;
    }

    /* Thiết lập style cho số hiển thị của phần tử */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    /* thiết lập style  nút tròn điều khiển*/
    .dot {
        cursor: pointer;
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    .active,
    .dot:hover {
        background-color: #717171;
    }

    /* tạo hiệu ứng chuyển động fade */

    /* end slide show */
    :root {
        --animate-duration: 2s;
        --animate-delay: 2s;
    }

    .modal {
        position: absolute;
        float: left;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }
</style>

<section class="categories">
    <div class="container-fluid">
        <div class="row">
            @foreach($cateHomeClientTop_1 as $cateTop_1)
            <div class="col-lg-6 p-0">
                <div class="categories__item categories__large__item set-bg" data-setbg="{{$urlCate}}/{{$cateTop_1['image']}}">
                    <div class="categories__text">
                        <h1>{{$cateTop_1['name']}}</h1>
                        <p class="text-left">( {{count($cateTop_1['product'])}} sản phẩm )</p>
                        <a href="/shop/{{$cateTop_1['slug']}}">Shop now</a>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="col-lg-6">
                <div class="row">
                    @foreach($cateHomeClientTop_4 as $cateTop_4)
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="{{$urlCate}}/{{$cateTop_4['image']}}">
                            <div class="categories__text">
                                <h4>{{$cateTop_4['name']}}</h4>
                                <p class="text-center">( {{count($cateTop_4['product'])}} sản phẩm )</p>
                                <a href="/shop/{{$cateTop_4['slug']}}">Shop now</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="section-title">
                    <h4>Sản phẩm mới nhất</h4>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <ul class="filter__controls">
                    <li onclick="filter('all')">Tất cả</li>
                    <li onclick="filter('men')">Nam</li>
                    <li onclick="filter('women')">Nữ</li>
                </ul>
            </div>
        </div>
        <div class="row property__gallery  filter-result">
            @foreach ($productsHome as $item)
            <div class="col-lg-3 col-md-4 col-sm-6 mix men">
                <div class="product__item" data-id="{{$item['slug']}}">
                    <div class="product__item__pic set-bg" data-setbg="{{$urlImage}}/{{$item['image']}}">
                        <?php echo ($item['discount'] == 0 ? '' : "<div class='label new'>{$item['discount']} %</div>") ?>
                        <ul class="product__hover">
                            <li><a href="{{$urlImage}}/{{$item['image']}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                            <li><a><span class="icon_heart_alt" data-toggle="modal" data-target="#Modal_BuyNow{{$item['id']}}"></span> </a></li>
                            <li><a><span class="icon_bag_alt" data-toggle="modal" data-target="#Modal_AddtoCart{{$item['id']}}"></span></a></li>

                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>
                            <a href="/detail/{{$item['slug']}}">{{$item['name']}}</a>
                        </h6>
                        <div class="rating">
                            <!-- <i class="fa fa-star"></i> -->
                        </div>
                        <!-- <div class="product__price">{{number_format(($item['price']-($item['price']*$item['discount']/100)),0)}}</div> -->
                        <div class="product__price"><?php echo number_format($item['price'] - ($item['price'] * $item['discount']) / 100, 0, '', ',') ?>đ<span><?php echo ($item['discount'] == 0 ? '' : number_format($item['price'], 0, '', ',')) ?></span></div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="Modal_AddtoCart{{$item['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="wrapper-themvaogio">
                                <div class="box-themvaogio fadeIn" class="">
                                    <div class="tieude">
                                        <h1>THÔNG TIN SẢN PHẨM</h1>
                                    </div>
                                    <div class="content">
                                        <div class="left">
                                            <div class="box-img">
                                                <img src="{{$urlImage}}/{{$item['image']}}" alt="">
                                            </div>
                                        </div>
                                        <div class="right">
                                            <div class="mausac">
                                                <h1>Màu có sẵn <span style="color: #e96b6d;">*</span></h1>
                                                <div class="box-color">
                                                    1,2
                                                @foreach($productModal as $prodM)
                                                            @if($prodM['idProd'] == $item['id'])
                                                            {{$prodM['color']}}
                                                            @endif
                                                        @endforeach
                                          
                                                    <!-- <div class="show-color-detail" data-id="52"><span></span></div>
                                                            <div class="show-color-detail" data-id="53"><span></span></div>
                                                            <div class="show-color-detail" data-id="54"><span></span></div>
                                                            <div class="show-color-detail" data-id="55"><span></span></div> -->
                                                </div>
                                            </div>
                                            <div class="size">
                                                <h1>Size có sẵn <span style="color: #e96b6d;">*</span></h1>
                                                <div class="size-action">
                                                    <select name="" id="chonsize">
                                                        <option value="" selected disabled hidden>Chọn size</option>

                                                    </select>
                                                    <p id="SoLuongSize"></p>
                                                </div>
                                                <div class="ChonSoLuongSize">
                                                    <h1>Chọn số lượng</h1>
                                                    <div class="ChonSoLuongSize-action">
                                                        <button id="GiamSoLuong">-</button>
                                                        <input id="SoLuongSP" type="number" value="1">
                                                        <button id="TangSoLuong">+</button>
                                                    </div>
                                                </div>
                                                <p id="SoLuongToiDa"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="action">
                                        <button id="submit-muahang">Thêm vào giỏ</button>
                                        <button id="close-themvaogio" data-dismiss="modal">Hủy</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="Modal_AddtoCart{{$item['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="wrapper-themvaogio">
                                <div class="box-themvaogio fadeIn" class="">
                                    <div class="tieude">
                                        <h1>THÔNG TIN SẢN PHẨM</h1>
                                    </div>
                                    <div class="content">
                                        <div class="left">
                                            <div class="box-img">
                                                <img src="{{$urlImage}}/{{$item['image']}}" alt="">
                                            </div>
                                        </div>
                                        <div class="right">
                                            <div class="mausac">
                                                <h1>Màu có sẵn <span style="color: #e96b6d;">*</span></h1>
                                                <div class="box-color">
                                                    <div class="show-color-detail" data-id="52"><span></span></div>
                                                    <div class="show-color-detail" data-id="53"><span></span></div>
                                                    <div class="show-color-detail" data-id="54"><span></span></div>
                                                    <div class="show-color-detail" data-id="55"><span></span></div>
                                                </div>
                                            </div>
                                            <div class="size">
                                                <h1>Size có sẵn <span style="color: #e96b6d;">*</span></h1>
                                                <div class="size-action">
                                                    <select name="" id="chonsize">
                                                        <option value="" selected disabled hidden>Chọn size</option>
                                                        <option value="">S</option>
                                                        <option value="">M</option>
                                                        <option value="">L</option>
                                                        <option value="">XL</option>
                                                    </select>
                                                    <p id="SoLuongSize"></p>
                                                </div>
                                                <div class="ChonSoLuongSize">
                                                    <h1>Chọn số lượng</h1>
                                                    <div class="ChonSoLuongSize-action">
                                                        <button id="GiamSoLuong">-</button>
                                                        <input id="SoLuongSP" type="number" value="1">
                                                        <button id="TangSoLuong">+</button>
                                                    </div>
                                                </div>
                                                <p id="SoLuongToiDa"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="action">
                                        <button id="submit-muahang">Thêm vào giỏ</button>
                                        <button id="close-themvaogio" data-dismiss="modal">Hủy</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach

        </div>
        <div class="row d-flex justify-content-center mt-3">
            <div class="pagination__option" id="paginateHome">

            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Banner Section Begin -->
<section class="banner set-bg">
    <div class="container2">
        <div class="col-xl-12 p-0 col-lg-12 m-auto">
            <div class="banner__slider owl-carousel">
                @if(count($sliders)>0)
                @foreach($sliders as $slider)
                <a href="<?php echo ($slider['image'] != null) ? $slider['href'] : '/' ?>">
                    <img src="<?php echo ($slider['image'] != null) ? $urlSliders . '/' . $slider['image'] : '{{urlSliders}}/noimage/salekhonglo.png' ?>" alt="">
                </a>
                @endforeach
                @else
                <div class="banner__item">
                    <div class="banner__text">
                        <span>The Chloe Collection</span>
                        <h1>The Project Jacket</h1>
                        <a href="">Shop now</a>
                    </div>
                </div>
                @endif
            </div>
        </div>

    </div>
</section>
<!-- Banner Section End -->

<!-- Trend Section Begin -->
<section class="trend spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Xem nhiều</h4>
                    </div>
                    @foreach($productsHotTrend as $hotTrend)
                    <div class="trend__item">
                        <div class="trend__item__pic reletive">
                            <a href="/detail/{{$hotTrend['slug']}}"><img style="width: 90px; height: 90px" src="{{$urlImage}}/{{$hotTrend['image']}}" alt="Image"></a>
                            <?php echo ($hotTrend['discount'] == 0 ? '' : "<div class='label new absolute'>{$hotTrend['discount']} %</div>") ?>
                        </div>
                        <div class="trend__item__text">
                            <a href="/detail/{{$hotTrend['slug']}}">
                                <h6>{{$hotTrend['name']}}</h6>
                            </a>
                            <!-- Hiển thị đánh giá -->
                            <?php
                            $output = '';
                            $users_rating = 0;
                            $total_rating = 0;
                            foreach ($hotTrend['reviews'] as $key => $rating) {
                                if ($rating['status'] == 2) {
                                    $total_rating++;
                                    $users_rating += $rating['num_star'];
                                }
                            }
                            $avgRatingH = ($total_rating > 0) ? $users_rating / $total_rating : 0;
                            $avgRatingH = number_format($avgRatingH, 1);
                            for ($i = 1; $i <= 5; $i++) {
                                if (ceil($avgRatingH) >= $i) {
                                    if (strpos($avgRatingH, ".") !== false) {
                                        if (ceil($avgRatingH) - 1 >= $i) {
                                            $output .=  ' <i class="fa fa-star text-warning"></i>';
                                        } else if (ceil($avgRatingH) - 1 < $i) {
                                            $output .= ' <i class="fas fa-star-half-alt text-warning"></i>';
                                        }
                                    } else {
                                        $output .= ' <i class="fa fa-star text-warning"></i>';
                                    }
                                } else {
                                    $output .= ' <i class="far fa-star text-warning"></i>';
                                }
                            }
                            ?>
                            <!-- End show Rating -->
                            <div style="font-size: 12px;" class="rating-every-prod">
                                {!! $output !!}
                            </div>
                            <div class="product__price"><?php echo number_format($hotTrend['price'] - ($hotTrend['price'] * $hotTrend['discount']) / 100, 0, ',', '.') ?>đ<span><?php echo ($hotTrend['discount'] == 0 ? '' : number_format($hotTrend['price'], 0, '', ',') . 'đ') ?></span></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Khuyến mãi </h4>
                    </div>
                    @foreach($productsBestSeller as $seller)
                    <div class="trend__item">
                        <div class="trend__item__pic reletive">
                            <a href="/detail/{{$seller['slug']}}"><img style="width: 90px; height: 90px" src="{{$urlImage}}/{{$seller['image']}}" alt="Image"></a>
                            <?php echo ($seller['discount'] == 0 ? '' : "<div class='label new absolute'>{$seller['discount']} %</div>") ?>
                        </div>
                        <div class="trend__item__text">
                            <a href="/detail/{{$seller['slug']}}">
                                <h6>{{$seller['name']}}</h6>
                            </a>
                            <!-- Hiển thị đánh giá -->
                            <?php
                            $output = '';
                            $users_rating = 0;
                            $total_rating = 0;
                            foreach ($seller['reviews'] as $key => $rating) {
                                if ($rating['status'] == 2) {
                                    $total_rating++;
                                    $users_rating += $rating['num_star'];
                                }
                            }
                            $avgRatingH = ($total_rating > 0) ? $users_rating / $total_rating : 0;
                            $avgRatingH = number_format($avgRatingH, 1);
                            for ($i = 1; $i <= 5; $i++) {
                                if (ceil($avgRatingH) >= $i) {
                                    if (strpos($avgRatingH, ".") !== false) {
                                        if (ceil($avgRatingH) - 1 >= $i) {
                                            $output .=  ' <i class="fa fa-star text-warning"></i>';
                                        } else if (ceil($avgRatingH) - 1 < $i) {
                                            $output .= ' <i class="fas fa-star-half-alt text-warning"></i>';
                                        }
                                    } else {
                                        $output .= ' <i class="fa fa-star text-warning"></i>';
                                    }
                                } else {
                                    $output .= ' <i class="far fa-star text-warning"></i>';
                                }
                            }
                            ?>
                            <!-- End show Rating -->
                            <div style="font-size: 12px;" class="rating-every-prod">
                                {!! $output !!}
                            </div>
                            <div class="product__price"><?php echo number_format($seller['price'] - ($seller['price'] * $seller['discount']) / 100, 0, ',', '.') ?>đ<span><?php echo ($seller['discount'] == 0 ? '' : number_format($seller['price'], 0, '', ',') . 'đ') ?></span></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Bán chạy</h4>
                    </div>
                    @foreach($productsFeature as $feature)
                    <div class="trend__item">
                        <div class="trend__item__pic reletive">
                            <a href="/detail/{{$feature['slug']}}"><img style="width: 90px; height: 90px" src="{{$urlImage}}/{{$feature['image']}}" alt="Image"></a>
                            <?php echo ($feature['discount'] == 0 ? '' : "<div class='label new absolute'>{$feature['discount']} %</div>") ?>
                        </div>
                        <div class="trend__item__text">
                            <a href="/detail/{{$feature['slug']}}">
                                <h6>{{$feature['name']}}</h6>
                            </a>
                            <!-- Hiển thị đánh giá -->
                            <?php
                            $output = '';
                            $users_rating = 0;
                            $total_rating = 0;
                            foreach ($feature['reviews'] as $key => $rating) {
                                if ($rating['status'] == 2) {
                                    $total_rating++;
                                    $users_rating += $rating['num_star'];
                                }
                            }
                            $avgRatingH = ($total_rating > 0) ? $users_rating / $total_rating : 0;
                            $avgRatingH = number_format($avgRatingH, 1);
                            for ($i = 1; $i <= 5; $i++) {
                                if (ceil($avgRatingH) >= $i) {
                                    if (strpos($avgRatingH, ".") !== false) {
                                        if (ceil($avgRatingH) - 1 >= $i) {
                                            $output .=  ' <i class="fa fa-star text-warning"></i>';
                                        } else if (ceil($avgRatingH) - 1 < $i) {
                                            $output .= ' <i class="fas fa-star-half-alt text-warning"></i>';
                                        }
                                    } else {
                                        $output .= ' <i class="fa fa-star text-warning"></i>';
                                    }
                                } else {
                                    $output .= ' <i class="far fa-star text-warning"></i>';
                                }
                            }
                            ?>
                            <!-- End show Rating -->
                            <div style="font-size: 12px;" class="rating-every-prod">
                                {!! $output !!}
                            </div>
                            <div class="product__price"><?php echo number_format($feature['price'] - ($feature['price'] * $feature['discount']) / 100, 0, ',', '.') ?>đ<span><?php echo ($feature['discount'] == 0 ? '' : number_format($feature['price'], 0, '', ',') . 'đ') ?></span></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Trend Section End -->
<!-- Discount Section Begin -->
<section class="discount">
    <div class="container">
        @foreach($productsBestSeller as $seller)
        <div class="row mySlides animate__animated animate__fadeIn">
            <div class="col-lg-6 p-0">
                <div class="discount__pic">
                    <a href="/detail/{{$seller['slug']}}">
                        <img src="{{$urlImage}}/{{$seller['image']}}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-6 p-0">
                <div class="discount__text">
                    <div class="discount__text__title">
                        <h5 class="text-dark">Sale</h5>
                        <h2 class="p-4"> {{$seller['discount']}} %</h2>
                    </div>
                    <h3>{{$seller['name']}}</h3>
                    <a class="mt-2" href="/detail/{{$seller['slug']}}">Shop now</a>
                </div>
            </div>
        </div>
        @endforeach
        <br>
        <div style="text-align:center">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
        <!-- Nút tròn điều khiển slideshow-->
    </div>
</section>
<!-- Discount Section Begin -->
<script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "flex";
        dots[slideIndex - 1].className += " active";
        var mySlider = setTimeout(showSlides, 4000); // Change image every 2 seconds
    }
</script>
<!-- Discount Section End -->

<!-- Services Section Begin -->
<section class="services spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-car"></i>
                    <h6>Miễn phí vận chuyển</h6>
                    <p>Với đơn hàng lớn hơn 2,000,000 đ</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-money"></i>
                    <h6>Hoàn trả 100% tiền</h6>
                    <p>Nếu sản phẩm không đúng chất lượng</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-support"></i>
                    <h6>Hỗ trợ Online 24/7</h6>
                    <p>Nhân viên tận tình</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-headphones"></i>
                    <h6>Thanh toán Online</h6>
                    </h6>
                    <p>Thanh toán an toàn 100%</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section End -->


<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="{{ asset('users/js/pagination.js') }}"></script>
<script src="{{ asset('users/js/home.js') }}"></script>
<script src="{{ asset('users/js/cart.js') }}"></script>

@endsection