@extends('layout.layout1')
@section('main')
@foreach ($product as $item)
@section('title')
{{$item['name']}}
@endsection
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<link rel="stylesheet" href="{{ asset('users/css/font-awesome.min.css') }}" type="text/css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<!-- Latest compiled and minified JavaScript -->

<style>
    .progress-label-left {
        float: left;
        margin-right: 0.5em;
        line-height: 1em;
    }

    .progress-label-right {
        float: right;
        margin-left: 0.3em;
        line-height: 1em;
    }

    .star-light {
        color: #e9ecef;
    }

    @media only screen and (max-width: 576px) {
        .box-image-custom-rating {
            width: 25%;
            float: left;
        }

        .box-content-custom-rating {
            width: 75%;
            float: left;
        }
    }
    /*  */
    #btn-next-slider-prod-related,#btn-prev-slider-prod-related{
        width: 40px;
        height: 40px;
        outline: none;
        border: none;
    }
    #btn-next-slider-prod-related{
        margin-left: 10px;
    }
    /*  */
</style>
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                    <a href="/shop/{{ $item['slugcate'] }}">{{$item['catename']}} </a>
                    <span>{{$item['name']}}</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach
<!-- Breadcrumb End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <input type="hidden" id="rating-average-prod" value="">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__left product__thumb nice-scroll">
                        @for ($i = 0; $i < count($images); $i++) <a class="pt active" href="#product-<?= $i ?>">
                            <img src="{{$images[$i]}}" alt="">
                            </a>
                            @endfor

                    </div>
                    <div class="product__details__slider__content">
                        <div class="product__details__pic__slider owl-carousel">
                            @for ($i = 0; $i < count($images); $i++) <img data-hash="product-<?= $i ?>" class="product__big__img" src="{{$images[$i]}}" alt="">
                                @endfor
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product__details__text">
                    @foreach ($product as $item)

                    <h3>{{$item['name']}} <span>Thương hiệu: {{$item['brandname']}}</span></h3>
                    <div>
                        <span id="box-avg-rating-2"></span>

                        <i class="fas fa-star  mr-1 main_star_2"></i>
                        <i class="fas fa-star  mr-1 main_star_2"></i>
                        <i class="fas fa-star  mr-1 main_star_2"></i>
                        <i class="fas fa-star  mr-1 main_star_2"></i>
                        <i class="fas fa-star  mr-1 main_star_2"></i>

                    </div>
                    <div class="rating">
                        <span>( <span id="total-review-star"></span> đánh giá )</span>
                    </div>
                    <div class="product__details__price">@if ($item['discount']==0)
                        {{number_format($item['price'],0,",",".")}} <small style="font-weight: bold;   text-decoration: underline;">đ</small>
                        @else
                        {{number_format($item['price']-($item['price']*$item['discount']/100),0,",",".")}} <small style="font-weight: bold;   text-decoration: underline;">đ</small> <span>{{number_format($item['price'],0,",",".")}} <small style="font-weight: bold;   text-decoration: underline;">đ</small></span>
                        @endif
                    </div>

                    <div class="product__details__button">
                        <div class="quantity">
                            <span>Số lượng:</span>
                            <div class="pro-qty">
                                <input onkeydown="return false;" type="text" id="qtyIpt" min=1 max=5 value="1">
                            </div>
                        </div>
                        <input type="hidden" name="" id="image" value='<?= $image ?>'>
                        <button class="cart-btn" onclick="addToCart('{{$item['idProd']}}','{{$item['name']}}','{{$item['price']-($item['price']*$item['discount']/100)}}')"><span class="icon_bag_alt"></span> Thêm vào giỏ hàng</button>

                    </div>
                    @endforeach
                    <div class="product__details__widget">
                        <ul>
                            <li>
                                <span>Màu sắc:</span>
                                <select class="form-control mt-2" name="colors" id="color">
                                    @foreach ($colors as $item)
                                    <option value="{{$item['color']}}" selected="selected">{{$item['color']}}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li>
                            <li>
                                <span>Size sản phẩm:</span>
                                <div class="size__btn" >
                                    <div class="form-check form-check-inline" id="sizeInfo">
                                       
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link nav-link-der active" data-toggle="tab" href="#tabs-1" role="tab">Đặc điểm nổi bật</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specification</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link nav-link-rating" data-toggle="tab" href="#tabs-3" role="tab">Đánh giá</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane tab-pane-der active" id="tabs-1" role="tabpanel">

                            <h6>Description</h6>
                            @foreach ($product as $item)
                            {!! $item['content'] !!}
                            @endforeach
                        </div>
                        <!-- <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <h6>Specification</h6>
                            <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                            consequat massa quis enim.</p>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                            quis, sem.</p>
                        </div> -->
                        <div class="tab-pane tab-pane-rating" id="tabs-3" role="tabpanel">
                            <div style="border-top:none ;border-left:none;border-right:none;" class="card">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4 text-center">
                                            <h2 class="text-warning mt-4 mb-4">
                                                <b><span id="average_rating">0.0</span> / 5</b>
                                            </h2>
                                            <div class="mb-3">
                                                <i class="fas fa-star star-light mr-1 main_star"></i>
                                                <i class="fas fa-star star-light mr-1 main_star"></i>
                                                <i class="fas fa-star star-light mr-1 main_star"></i>
                                                <i class="fas fa-star star-light mr-1 main_star"></i>
                                                <i class="fas fa-star star-light mr-1 main_star"></i>
                                            </div>
                                            <h3 style="font-size: 20px;"><span id="total_review">0</span> bài đánh giá</h3>
                                        </div>
                                        <div class="col-sm-4">
                                            <p>
                                            <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                                            <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                                            </div>
                                            </p>
                                            <p>
                                            <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                                            <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                                            </div>
                                            </p>
                                            <p>
                                            <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                                            <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                                            </div>
                                            </p>
                                            <p>
                                            <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                                            <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                                            </div>
                                            </p>
                                            <p>
                                            <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                                            <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                                            </div>
                                            </p>
                                        </div>
                                        <div class="col-sm-4 text-center">

                                            <button data-login="{{ $show = (session()->has('customer')) ? 1 : 0 }}" style="width:100%;" type="button" class="btn btn-success mt-2" name="add_review" id="add_review">Viết đánh giá</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5" id="review_content"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Review -->
        <div class="modal fade" id="review_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Đánh giá khách hàng</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center mt-2 mb-4">
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                        </h4>
                        <!-- <div class="form-group">
                            <input type="text"  name="user_name" id="user_name" class="form-control" placeholder="Enter Your Name" />
                        </div> -->
                        <input type="hidden" id="idCustomer" value="{{ $show = session()->has('customer') ? session()->get('customer')->id : '' }}">
                        <input type="hidden" id="idProd" value="{{ $item['idProd'] }}">
                        <div class="form-group">
                            <textarea name="user_review" id="user_review" class="form-control" rows="10" style="resize: none;" placeholder="Nhập đánh giá của quý khách"></textarea>
                        </div>
                        <div class="form-group text-center mt-4">
                            <button style="width:100%;" type="button" class="btn btn-primary" id="save_review">Gửi đánh giá</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- end Modal Review -->

        <!-- Modal login -->
        <div class="modal fade" id="modal-login-review" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Mời quý khách đăng nhập</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pt-4 pb-4">
                        <form class="form-login-customer-in-detail-product">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Địa chỉ Email <span style="font-weight: bold;color:red;">*</span></label>
                                <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div class="invalid-feedback email">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mật khẩu <span style="font-weight: bold;color:red;">*</span></label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                <div class="invalid-feedback password">

                                </div>
                            </div>
                            <button style="width:100%;margin-bottom:10px;" type="submit" class="site-btn">Đăng nhập</button>

                            <a href="http://127.0.0.1:8000/auth/google"> <button style="width:100%;margin-bottom:10px;background:#eb1460;" type="button" class="site-btn">Đăng nhập với Google <i class="fab fa-google"></i></button></a>

                            <a href="http://127.0.0.1:8000/auth/facebook"><button style="width:100%;background:#3d4db7;" type="button" class="site-btn">Đăng nhập với Facebook <i class="fab fa-facebook-f"></i></button></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- end Modal login-->
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="related__title">
                    <h5>SẢN PHẨM CÙNG LOẠI</h5>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row list-prod-related">
                    @foreach ($relate as $item1)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item" data-id="{{$item1['slug']}}">
                            <div class="product__item__pic set-bg" data-setbg="http://127.0.0.1:3000/images/{{$item1['image']}}">
                                <?php echo ($item1['discount'] != 0) ? '<div style="background-color: red;" class="label new">-' . $item1['discount'] . '%</div>' : '' ?>
                                <!-- <ul class="product__hover">
                                    <li><a href="{{$item1['image']}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                </ul> -->
                            </div>
                            <div class="product__item__text">
                                <h6><a href="/detail/{{$item1['slug']}}">{{$item1['name']}}</a></h6>
                                <!-- Hiển thị đánh giá -->
                                <?php
                                $output = '';
                                $users_rating = 0;
                                $total_rating = 0;
                                foreach ($item1['reviews'] as $key => $rating) {
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
                                <div style="font-size: 15px;" class="rating-every-prod">
                                    {!! $output !!} <span>({{ $avgRatingH }})</span>
                                </div>
                                <?php
                                $price = ($item1['discount'] != 0) ?  $item1['price'] - ($item1['price'] * $item1['discount'] / 100) :  $item1['price'];
                                ?>
                                <div class="product__price">{{number_format($price , 0, ',', '.')}}đ <?php echo ($item1['discount'] != 0) ? '<span>' . number_format(($item1['price'] - ($item1['price'] * $item1['discount'] / 100)), 0, ',', '.') . '</span>' : '' ?></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!--  -->
            <button id="btn-prev-slider-prod-related"><i class="	fas fa-angle-left"></i></button>
            <button id="btn-next-slider-prod-related"><i class="	fas fa-angle-right"></i></button>
            <!--  -->
        </div>
    </div>
</section>
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
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
    const login = "{{ $show = (session()->has('customer')) ? 1 : 0 }}"
</script>
<script src="{{ asset('users/js/login.js') }}"></script>
<script src="{{ asset('users/js/raiting.js') }}"></script>
<script>
    $(document).ready(function() {
    let slug = window.location.pathname.split('/').slice(-1);
    let color = $("#color option:selected").val().trim();
    loadSizes(color)
    $('#color').on('change',function(){
        color = $(this).val().trim();
        loadSizes(color)
    })

    function loadSizes(){
        $.ajax({
            type: 'GET',
            url: `http://127.0.0.1:3000/api/singleProd/${slug}`,
            data:{
                slug:slug
            },
            success: (res)=>{
                let storage =res.storage;
                let arrSize = storage.filter(item=>item.color==color);
                let html=arrSize.map(item=>{
                    return`
                    <input class="form-check-input sizes" name="sizes" type="radio" name="inlineRadioOptions" id="${item.sizename}" value="${item.sizename}-${item.id}">
                    <label class="form-check-label" for="${item.sizename}">${item.sizename}</label>
                    `
                })
                document.getElementById('sizeInfo').innerHTML = html.join(' ');
            },
            error: (err)=>{
              console.log(err)  
            }
    
        })
    }
    })    
    </script>
<script>
    $('.list-prod-related').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        prevArrow: $("#btn-prev-slider-prod-related"),
        nextArrow: $("#btn-next-slider-prod-related"),
        autoplay: true,
        autoplaySpeed: 1500,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
</script>
@endsection