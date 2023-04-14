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

    <!-- Css Styles -->
    <link rel="stylesheet" href="../users/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../users/css/font-awesome.min.css" type="text/css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" /> -->
    <link rel="stylesheet" href="../users/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../users/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../users/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="../users/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../users/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../users/css/style.css" type="text/css">
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

    /*  */
    .modal-body {
        background-color: white !important;
    }
    .inc{
        padding-left: 12px;
        /* background-color: red; */
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
                </a></li>
        </ul>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <a href="/login">Login</a>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo">
                        <a href="/"><img src="../users/img/logo.png" alt=""></a>
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
                        <div class="header__right__auth">
                            @if(!session()->has('access_token_login'))
                            <a href="/login">Đăng nhập</a>
                            <a href="/register">Đăng ký</a>
                            @else
                            <a href="/my-account">{{ session()->get('customer')->name }}</a>
                            @endif
                        </div>
                        <ul class="header__right__widget">
                            <li><a href="/cart"><span class="icon_bag_alt"></span>
                                    <div class="tip countcart2">0</div>
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
    <!-- Instagram End -->

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-7">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="/"><img src="../users/img/logo.png" alt=""></a>
                        </div>
                        <p class="text-center">Shop bán hàng trực tuyến T&N</p>
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
                        <h6>NEWSLETTER</h6>
                        <form action="#">
                            <input type="text" placeholder="Email">
                            <button type="submit" class="site-btn">Subscribe</button>
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
    <!--  -->
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
    <!--  -->
    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="../users/js/bootstrap.min.js"></script>
    <script src="../users/js/sweetalert2.all.min.js"></script>
    <script src="../users/js/jquery.magnific-popup.min.js"></script>
    <script src="../users/js/jquery-ui.min.js"></script>
    <script src="../users/js/mixitup.min.js"></script>
    <script src="../users/js/jquery.countdown.min.js"></script>
    <script src="../users/js/jquery.slicknav.js"></script>
    <script src="../users/js/owl.carousel.min.js"></script>
    <script src="../users/js/jquery.nicescroll.min.js"></script>
    <script src="../users/js/main.js"></script>
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
                        loadCount_2()
                    }
                })
            })
            // Nếu modal đóng load lại 
            $('#modalshowNotifications').on('hide.bs.modal', function(e) {
                loadNotification()
            });
        });
    </script>

    <script src="{{asset('users/js/cart.js') }}"></script>
    <script>
        let carts = cartSettings.get('cart');
        $('.countcart2').html(carts.length)
        $('.tip').html(carts.length)
    </script>
    <!-- End Make Notifications -->
</body>

</html>