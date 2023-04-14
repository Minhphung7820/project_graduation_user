<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta property="fb:app_id" content="655110666095136" />
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="{{ asset('users/js/sweetalert2.all.min.js') }}"></script>
    <!-- Css Styles -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!--  -->
    <link rel="stylesheet" href="{{ asset('users/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('users/css/font-awesome.min.css') }}" type="text/css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" /> -->
    <link rel="stylesheet" href="{{ asset('users/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('users/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('users/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('users/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('users/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('users/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script type="text/javascript">
        if (window.location.hash && window.location.hash == '#_=_') {
            if (window.history && history.pushState) {
                window.history.pushState("", document.title, window.location.pathname);
            } else {
                // Prevent scrolling by storing the page's current scroll offset
                var scroll = {
                    top: document.body.scrollTop,
                    left: document.body.scrollLeft
                };
                window.location.hash = '';
                // Restore the scroll offset, should be flicker free
                document.body.scrollTop = scroll.top;
                document.body.scrollLeft = scroll.left;
            }
        }
    </script>
    <link rel="stylesheet" href="{{ asset('users/css/bell-ring.css') }}">
</head>
<style>
    .button-scroll-to-top {
        position: fixed;
        z-index: 100;
        bottom: 10px;
        right: 10px;
        border-radius: 50%;
        display: none;
    }

    .search-wrapper {
        position: absolute;
        transform: translate(-50%, -50%);
        top: 48%;
        left: 15%;
    }

    .search-wrapper.active {
        opacity: 1;
        border-radius: 30px;
        background-color: #EEEEEE;
    }

    .search-wrapper .input-holder {
        height: 40px;
        width: 50px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0);
        border-radius: 6px;
        position: relative;
        transition: all 0.3s ease-in-out;
    }

    .search-wrapper.active .input-holder {
        width: 380px;
        border-radius: 50px;
        background: #EEEEEE;
        transition: all .5s cubic-bezier(0.000, 0.105, 0.035, 1.570);
    }

    .search-wrapper .input-holder .search-input {
        width: 100%;
        height: 50px;
        padding: 0px 70px 0 20px;
        opacity: 0;
        position: absolute;
        top: -15px;
        left: 0px;
        background: transparent;
        box-sizing: border-box;
        border: none;
        outline: none;
        font-family: "Open Sans", Arial, Verdana;
        font-size: 16px;
        font-weight: 400;
        line-height: 20px;
        color: #FFF;
        transform: translate(0, 60px);
        transition: all .3s cubic-bezier(0.000, 0.105, 0.035, 1.570);
        transition-delay: 0.3s;
    }

    .search-wrapper.active .input-holder .search-input {
        opacity: 1;
        color: #000;
        background-color: #EEEEEE;
        transform: translate(0, 10px);
    }

    .search-wrapper .input-holder .search-icon {
        width: 40px;
        height: 40px;
        border: none;
        border-radius: 6px;
        background: #FFF;
        padding: 0px;
        outline: none;
        position: relative;
        z-index: 2;
        float: right;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .search-wrapper.active .input-holder .search-icon {
        width: 40px;
        height: 40px;
        margin: 0;
        border-radius: 30px;
        opacity: 1;
        color: red;
    }

    .search-wrapper .input-holder .search-icon span {
        width: 22px;
        height: 22px;
        padding-bottom: 26px;
        padding-left: 20px;
        display: inline-block;
        vertical-align: middle;
        position: relative;
        transform: rotate(45deg);
        transition: all .4s cubic-bezier(0.650, -0.600, 0.240, 1.650);
    }

    .search-wrapper.active .input-holder .search-icon span {
        transform: rotate(-45deg);
    }

    .search-wrapper .input-holder .search-icon span::before,
    .search-wrapper .input-holder .search-icon span::after {
        position: absolute;
        content: '';
    }

    .search-wrapper .input-holder .search-icon span::before {
        width: 4px;
        height: 11px;
        left: 9px;
        top: 18px;
        border-radius: 2px;
        background: #000;
    }

    .search-wrapper .input-holder .search-icon span::after {
        width: 22px;
        height: 22px;
        left: 0px;
        top: 0px;
        border-radius: 16px;
        border: 4px solid #000;
    }

    .search-wrapper .close {
        position: absolute;
        z-index: 1;
        top: 0;
        right: 2px;
        width: 25px;
        height: 25px;
        cursor: pointer;
        transform: rotate(-180deg);
        transition: all .3s cubic-bezier(0.285, -0.450, 0.935, 0.110);
        transition-delay: 0.2s;
    }

    .search-wrapper.active .close {
        top: 8px;
        right: -50px;
        transform: rotate(45deg);
        transition: all .6s cubic-bezier(0.000, 0.105, 0.035, 1.570);
        transition-delay: 0.5s;
    }

    .search-wrapper .close::before,
    .search-wrapper .close::after {
        position: absolute;
        content: '';
        background: #000;
        border-radius: 2px;
    }

    .search-wrapper .close::before {
        width: 5px;
        height: 25px;
        left: 10px;
        top: 0px;
    }

    .search-wrapper .close::after {
        width: 25px;
        height: 5px;
        left: 0px;
        top: 10px;
    }

    .input-holder {
        position: relative;
    }

    .resultDesktop {
        width: 300px;
        max-height: 420px;
        overflow-y: scroll;
        position: absolute;
        background-color: #fff;
        z-index: 999;
        top: 83%;
        right: 48%;
        border-radius: 3px;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    }

    ::-webkit-scrollbar {
        width: 7px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #dc3545;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #dc3545;
    }

    .item-ult {
        width: 260px;
        min-height: 65px;
        display: flex;
        margin: 15px 10px;
    }

    .item-ult .title {
        width: 200px;
        font-size: 14px;
        text-align: left;
        padding-left: 10px
    }

    .item-ult .title a {
        font-size: 14px;
        padding-bottom: 10px;
    }

    .item-ult .title a:hover {
        cursor: pointer;
        color: #36a300;
    }

    .item-ult .title p {
        font-size: 11px;
    }

    .img-search {
        width: 56px;
        height: 65px;
    }

    .non-active {
        font-size: 14px;
        text-align: left;
    }

    .header__logo {
        padding: 26px 0px 26px 150px;
    }

    .header__logo img {
        width: 38px;
        ;
    }

    .header__menu {
        min-width: 800px;
    }

    /* btn search */

    /*  */
    .btn-view-notification-client {
        position: fixed;
        z-index: 101;
        bottom: 90px;
        right: 10px;
        border-radius: 50%;
    }

    .span-count-not-not-seen {
        display: none;
        position: fixed;
        z-index: 102;
        right: 10px;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 1px 0px 5px 1px;
        text-align: center;
        bottom: 115px;
        font-size: 12px;
        font-weight: bold;
        width: 20px;
        height: 20px;
    }

    .star-light {
        color: gray;
    }
    .container-fluid{
        width:100%;
    }
    :root {
    --swiper-theme-color: black;
    }

    /*  */

    /*  */
    .modal-show-main-notification,
    .modal-show-main-notification-seen{
        background-color: white !important;
    }
    .header__menu > ul > li > a {
        background-color: white !important;
    }
    .modal {
        top:5%;
         position: fixed;
    }
.wrapper-themvaogio .box-themvaogio{
   width: 100%;
   min-height: 300px;
   background-color: white;
   display: flex;
   flex-direction: column;
   align-items: center;
   border-radius: 5px;
}
.box-themvaogio .tieude{
   width: 100%;
   display: flex;
   align-items: center;
   justify-content: center;
   margin: 1.5em 0;
   margin-bottom: 2em;
}
.box-themvaogio .tieude h1{
   font-size: 180%;
    font-weight: 700;
    font-family: 'Barlow Condensed', sans-serif;

}
.box-themvaogio .content{
   width: 100%;
   display: flex;
   justify-content: space-between;
}
.box-themvaogio .content .left{
   width: 50%;
   display: flex;
   justify-content: flex-end;
}
.box-themvaogio .content .left .box-img{
   width: 90%;
}
.box-themvaogio .content .left img{
   width:  100%;
   height: 290px;
   display: block;
}


.box-themvaogio .content .right{
   width: 50%;
   padding-left: 2em;
}
.box-themvaogio .content .right .mausac h1{
    margin-bottom:20px;
   font-size: 90%;
   font-family: 'Inter', sans-serif;
   font-weight: 700;
}
.box-themvaogio .content .right .mausac .box-color{
   display: flex;
   flex-wrap: wrap;
   align-items: center;
   cursor: pointer;
   margin-top: 0.8em;
}
.box-themvaogio .content .right .mausac .box-color div{
   height: 22px;
   width: 22px;
   border-radius: 50%;
   /* border: 1px solid yellow; */
   display: flex;
   align-items: center;
   justify-content: center;
   margin-right: 8px;
   margin-bottom: 0.5em;
}

.box-themvaogio .content .right .mausac .box-color div span{
   width: 60%;
   height: 60%;
   border-radius: 50%;
   /* background-color: yellow; */
}
.box-themvaogio .content .right .size{
   margin-top: 20px;
   width: 100%;
   position: relative;
}
.box-themvaogio .content .right .size .size-action{
   width: 100%;
   display: flex;
   align-items: center;
}
.box-themvaogio .content .right .size .size-action p{
   margin-bottom: 0;
   margin-left: 10px;
   font-size: 85%;
   font-family: 'Inter', sans-serif;
}
.box-themvaogio .content .right .size h1{
    margin-bottom:20px;
   font-size: 90%;
   font-family: 'Inter', sans-serif;
   font-weight: 700;

}
.box-themvaogio .content .right .size select{
   width: 60%;
   height: 35px;
   outline: none;
   border: 1px solid silver;
   font-size: 80%;
   text-indent: 0.3em;
}
.box-themvaogio .content .right .size select:focus{
   border: 1px solid rgb(119, 118, 118);
}
.box-themvaogio .content .right .size .ChonSoLuongSize{
   margin-top: 1em;
}
input[type=radio]{
    margin:0 4px;
}
.box-themvaogio > .action{
   width: 100%;
   display: flex;
   align-items: center;
   justify-content: center;
   margin: 3em 0;
   margin-bottom: 1em;

}
.box-themvaogio > .action button{
   outline: none;
   border: none;
   margin-right: 1em;
   padding: 6px 22px;
   transition: 0.2s;
}
.box-themvaogio > .action button:hover{
   background-color: #ff5c62;
   color: white;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    /* display: none; <- Crashes Chrome on hover */
    -webkit-appearance: none;
    margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
}

input[type=number] {
    -moz-appearance:textfield; /* Firefox */
}
*{
   margin: 0;
   padding: 0;
   box-sizing: border-box;
}

.ChonSoLuongSize-action{
    display: flex;
    align-items: center;
    width: 100%;
    height: 30px;
}
.ChonSoLuongSize-action #qtyIpt{
    width: 25%;
    height: 98.5%;
    text-align: center;
    margin-left: -3px;
    outline: none;
    border: 1px solid rgb(212, 212, 212);
    font-size: 80%;

}

.ChonSoLuongSize-action button{
    width: 25px;
    height: 100%;
    outline: none;
    border: none;
    transition: 0.2s;
}
.ChonSoLuongSize-action button:hover{
   background-color: #ff5c62;
   color: white;
}
.ChonSoLuongSize-action button#TangSoLuong{
   margin-left: -3px;
   border-left: 1px solid silver;
}
.size #SoLuongToiDa{
   margin-bottom: 0;
   font-size: 80%;
   margin-top: 10px;
   position: absolute;
   top: 98%;
}
.label{
    background-color: red !important;
}
</style>


<body>
    <!--  -->

    @if(session()->has('customer'))
    <button type="button" class="btn btn-success btn-view-notification-client" data-toggle="modal" data-target="#modalshowNotifications"><i class="fas fa-bell"></i></button>
    <span class="span-count-not-not-seen">0</span>
    <input type="hidden" id="idCustomer" value="{{ session()->get('customer')->id }}">
    @endif
    <!--  -->
    <button type="button" class="btn btn-danger button-scroll-to-top">
        <i class="	fa fa-arrow-up"></i>
    </button>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><a href="/cart"><span class="icon_bag_alt"></span>
                    <div class="tip">0</div>
                </a>
            </li>
        </ul>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <a href="/login">Login</a>
            <?php

            ?>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo">
                        @if(!empty($infos))
                        @foreach($infos as $info)
                        <a href="/"><img src="<?php echo ($info['logo'] != null) ? $urlLogo . '/' . $info['logo'] : '{{$urlLogo}}/image-Icon/no-image-logo.jpg' ?>" alt="{{$info['shopName']}}"></a>
                        @endforeach
                        @else
                        <a href="users/img/logo.png"></a>
                        @endif
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li class="{{ (request()->is('/')) ? 'active' : '' }}"><a href="/"><i class="fa fa-home"></i></a></li>
                            <li class="li-menu {{ (request()->is('shop/thoi-trang-nu')) ? 'active' : '' }}"><a href="/shop/thoi-trang-nu">Thời trang nữ</a></li>
                            <li class="li-menu {{ (request()->is('shop/thoi-trang-nam')) ? 'active' : '' }}"><a href="/shop/thoi-trang-nam">Thời trang nam</a></li>
                            <li class="{{ (request()->is('shop')) ? 'active' : '' }}"><a href="/shop">Sản phẩm</a></li>
                            <!-- <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="./product-details.html">Product Details</a></li>
                                    <li><a href="./shop-cart.html">Shop Cart</a></li>
                                    <li><a href="./checkout.html">Checkout</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li> -->
                            <li class="{{ (request()->is('blog/*') || request()->is('blog')) ? 'active' : '' }}"><a href="/blog/">Tin thời trang</a>
                                <ul class="dropdown">
                                    <?php

                                    use Illuminate\Support\Facades\Http;

                                    $cates = json_decode(Http::get('http://127.0.0.1:3000/api/allCateBlogClient'));
                                    foreach ($cates as $key => $value) {
                                        echo '<li><a href="/blog/categories/' . $value->slugCatePost . '.html">' . $value->nameCatePosts . '</a></li>';
                                    }
                                    ?>

                                    <!-- <li><a href="./shop-cart.html">Shop Cart</a></li>
                                    <li><a href="./checkout.html">Checkout</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li> -->
                                </ul>
                            </li>
                            <li class="{{ (request()->is('gioi-thieu') || request()->is('lien-he')) ? 'active' : '' }}"><a href="/gioi-thieu">Về chúng tôi</a>
                                <ul class="dropdown">
                                    <li>
                                        <a href="/gioi-thieu">Giới thiệu</a>
                                        <a href="/lien-he">Liên hệ</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__right">
                        <div class="header__right__auth noneCustom">
                            @if(!session()->has('access_token_login'))
                            <a href="/login">Đăng nhập</a>
                            <a href="/register">Đăng ký</a>
                            @else
                            <input type="hidden" name="" value="<?php echo session()->get('customer')->name ?>" id="usernamelogin">
                            <input type="hidden" name="" value="<?php echo session()->get('customer')->email ?>" id="useremaillogin">
                            <input type="hidden" name="" value="<?php echo session()->get('customer')->provider_id ?>" id="userPIlogin">

                            <a href="/my-account">{{ session()->get('customer')->name }}</a>
                            @endif
                        </div>
                        <ul class="header__right__widget">
                            <li>
                                <div class="search-wrapper">
                                    <div class="input-holder">
                                        <input type="text" class="search-input" id="liveSearch" placeholder="Tìm kiếm ..." />
                                        <button class="search-icon" onclick="searchToggle(this, event);"><span></span></button>
                                    </div>
                                    <span class="close" onclick="searchToggle(this, event);"></span>
                                </div>
                                <div class="resultDesktop searchItem d-none">
                                    <!-- item ult-->
                                </div>
                            </li>
                            <li><a class="noneCustom" href="/cart"><span class="icon_bag_alt"></span>
                                    <div class="tip countcart">0</div>
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    @yield('main')
    <!-- Instagram Begin -->
    <div class="instagram">
        <div class="container-fluid swiper slideShow_desc">
            <div class=" swiper-wrapper" >
                @foreach($infos as $info)
                <?php
                    $img = explode(',',$info['img_desc']);
                    foreach($img as $img_desc)
                    echo ($img_desc==null)?'':'
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0 swiper-slide">
                        <div class="instagram__item set-bg " data-setbg="'.$urlLogo.'/'.$img_desc.'">
                            <div class="instagram__text">
                                <i class="fa fa-instagram"></i>
                                <a href="/">'.$info['shopName'].'</a>
                            </div>
                        </div>
                    </div>'
                ?>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <!-- Instagram End -->

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-7">
                    <div class="footer__about">
                        <div class="footer__logo">
                            @if(!empty($infos))
                            @foreach($infos as $info)
                            <a href="/"><img src="<?php echo ($info['logo'] != null) ? $urlLogo . '/' . $info['logo'] : '{{$urlLogo}}/image-Icon/no-image-logo.jpg' ?>" alt="{{$info['shopName']}}"></a>
                            @endforeach
                            @else
                            <a href="users/img/logo.png"></a>
                            @endif
                        </div>
                        <p class="text-center">Shop bán hàng trực tuyến {{$info['shopName']}}</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-5">
                    <div class="footer__widget">
                        <h6>Về chúng tôi</h6>
                        <ul>
                            <li><a href="/gioi-thieu">Giới thiệu</a></li>
                            <li><a href="/blog/">Tin thời trang</a></li>
                            <li><a href="/lien-he">Liên hệ</a></li>
                            <li><a href="/shop">Shop</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="footer__widget">
                        <h6>Tài khoản</h6>
                        <ul>
                            <li><a href="/my-account">Tài khoản của bạn</a></li>
                            <li><a href="/my-account">Đơn hàng</a></li>
                            <li><a href="/cart">Giỏ hàng</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-sm-8">
                    <div class="footer__newslatter">
                        <h6>Bảng tin</h6>
                        <form action="#">
                            <input type="text" placeholder="Email">
                            <button type="submit" class="site-btn">Đăng ký</button>
                        </form>
                        <div class="footer__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->
    <!-- Search End -->
    <div class="modal fade" id="modalshowNotifications" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-bell"></i> Thông báo của bạn</h5>
                    <button type="button" class="close btn-close-notification" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Chưa xem</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Đã xem</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active modal-show-main-notification" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"></div>
                        <div class="tab-pane fade modal-show-main-notification-seen" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"></div>
                    </div>
                    <!--  -->
                    <!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Chưa xem</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Đã xem</a>
                        </li>

                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active modal-show-main-notification" id="home" role="tabpanel" aria-labelledby="home-tab"></div>
                        <div class="tab-pane fade  modal-show-main-notification-seen" id="profile" role="tabpanel" aria-labelledby="profile-tab"></div>
                    </div> -->
                    <!--  -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-close-notification" data-dismiss="modal">Đóng</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Js Plugins -->
    <script src="{{ asset('users/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('users/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('users/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('users/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('users/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('users/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('users/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('users/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('users/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('users/js/main.js') }}"></script>
    <script src="{{ asset('users/js/layout.js') }}"></script>
    <script src="{{ asset('users/js/cart.js') }}"></script>
    <script>
        var btnScrollTop = $('.button-scroll-to-top');

        $(window).scroll(function() {
            if ($(window).scrollTop() > 180) {
                btnScrollTop.fadeIn(500);
            } else {
                btnScrollTop.fadeOut(500);
            }
        });

        btnScrollTop.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, '300');
        });
    </script>
    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "107508228868916");
        chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v15.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Make Notification -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="{{ asset('users/js/notifications.js') }}"></script>
    <script>
        var pusher = new Pusher('d64673b10884e3d30bfd', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('NotificationsClient');
        channel.bind('ChannelNotClient', function(data) {
            console.log(data);
            loadNotification()
            // Nếu modal mở thì seen thông báo
            $('#modalshowNotifications').on('show.bs.modal', function(e) {
                AjaxSetup();
                $.ajax({
                    url: "http://127.0.0.1:3000/api/seenNotication",
                    type: "post",
                    data: {
                        id: $("#idCustomer").val()
                    },
                    success: function(response) {
                        console.log(response);
                        loadCount_2()
                    }
                })
            })
            // Nếu modal đóng load lại 
            $('#modalshowNotifications').on('hide.bs.modal', function(e) {
                loadNotification()
                console.log("Đang đóng");
            });
        });
    </script>
    <!-- End Make Notifications -->
    <script>
      var swiper = new Swiper(".slideShow_desc", {
        slidesPerView: "auto",
        spaceBetween: 0,
        freeMode: true,
        loop:true,
        centerSlide:true,
        fade:true,
        grabCursor:true,

        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });
    </script>
</body>

</html>