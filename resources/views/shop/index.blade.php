@extends('layout.layout')
@section('title','Shop')
@section('main')

<style>
    /* Pagination*/
    #paginate ul{
        list-style: none;
        display: flex;
        justify-content: center;
    }
    #paginate .active{
        background-color: #000;
        color: #fff;
        border-radius:50%;
    }
    #paginate .active a{
        color: #fff;
    }
    #paginate .disabled{
         display: none;
    }
    #paginate a:hover{
        cursor: pointer;
    }

  /* range prive */
    .middle {
        position: relative;
        width: 85%;
        max-width: 500px;
        margin-top: -20px;
        display: inline-block;
    }

    .slider {
        position: relative;
        z-index: 1;
        height: 10px;
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .slider>.track {
        position: absolute;
        z-index: 1;
        left: 0;
        right: 0;
        top: 1px;
        bottom: 5px;
        border-radius: 5px;
        background-color: #ccc;
    }

    .slider>.range {
        position: absolute;
        z-index: 2;
        left: 0%;
        right: 0%;
        top: 1px;
        bottom: 5px;
        border-radius: 5px;
        background-color: #111111;
    }

    .slider>.thumb {
        top:30%;
        position: absolute;
        z-index: 3;
        width: 18px;
        height: 18px;
        background-color: #111111;
        border-radius: 50%;
    }
    .slider>.thumb.left {
        left: 5%;
        transform: translate(-15px, -10px);
    }

    .slider>.thumb.right {
        right: 5%;
        transform: translate(15px, -10px);
    }

    .range_slider {
        position: absolute;
        pointer-events: none;
        -webkit-appearance: none;
        z-index: 2;
        height: 10px;
        width: 105%;
        opacity: 0;
    }

    .range_slider::-webkit-slider-thumb {
        pointer-events: all;
        width: 30px;
        height: 30px;
        border-radius: 0;
        border: 0 none;
        background-color:#111111 ;
        cursor: pointer;
        -webkit-appearance: none;
    }

    #multi_range {
        margin: 0 auto;
        border-radius: 20px;
        margin-top: 25px;
        text-align: center;
        width: 220px;
        font-weight: 500;
        font-size: 13px;
        color: #ca1515;
    }
    /* select option */
    .filter-right {
     padding: 2px;
    }
    .product__item__pic img{
            width:100%;
            height:100%;
    }
</style>
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Tất cả sản phẩm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="shop__sidebar">
                        <div class="sidebar__sizes">
                            <div class="section-title">
                                <h4>Danh mục</h4>
                            </div>
                            <div class="size__list">
                                @if(!empty($categories))
                                @foreach ($categories as $cate)
                                    @if(count($cate['product'])>0)
                                    <label for="cate-{{$cate['id']}}">
                                        <div class="d-flex justify-content-between">
                                        <span>{{$cate['name']}}</span>
                                        <span class="pr-3">
                                            ({{count($cate['product'])}})
                                        </span>
                                        </div>
                                        <input type="checkbox" id="cate-{{$cate['id']}}" class="idCate" name="idCate" value="{{$cate['id']}}">
                                        <span class="checkmark"></span>
                                    </label>
                                    @endif
                                @endforeach
                                @else
                                <p>Không có dữ liệu</p>
                                @endif
                            </div>
                        </div>
                        <div class="sidebar__sizes">
                            <div class="section-title">
                                <h4>Thương hiệu</h4>
                            </div>
                            <div class="size__list">
                            @if(!empty($brands))
                                @foreach ($brands as $brand)
                                    @if(count($brand['prods'])>0)
                                    <label for="brand-{{$brand['id']}}">
                                        <div class="d-flex justify-content-between">
                                        <span>{{$brand['name']}}</span>
                                        <span class="pr-3">
                                            ({{count($brand['prods'])}})
                                        </span>
                                        </div>
                                        <input type="checkbox" id="brand-{{$brand['id']}}" class="idBrand" name="idBrand" value="{{$brand['id']}}">
                                        <span class="checkmark"></span>
                                    </label>
                                    @endif
                                @endforeach
                            @else
                                <p>Không có dữ liệu</p>
                            @endif
                            </div>
                        </div>
                        <div class="sidebar__filter">
                            <div class="section-title">
                                <h4>Giá</h4>
                            </div>
                            <div class="filter-range-wrap">
                            <div class="middle">
                                <div class="multi-range-slider my-2">
                                    <input type="range" id="input_left" class="range_slider" min="0" max="100" value="0" onmousemove="left_slider(this.value)">
                                    <input type="range" id="input_right" class="range_slider" min="0" max="100" value="100" onmousemove="right_slider(this.value)">
                                    <div class="slider">
                                        <div class="track"></div>
                                        <div class="range"></div>
                                        <div class="thumb left"></div>
                                        <div class="thumb right"></div>
                                    </div>
                                </div>
                                <div id="multi_range">
                                    <span id="left_value">0</span><span> ~ </span><span id="right_value">10,000,000</span>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 col-md-9">
                <div class="row mb-4">
                    <div class="col-lg-9 col-md-9  d-flex justify-content-end align-item-center">
                        <span id="totalProduct"></span>
                    </div>
                    <div class="col-lg-3 col-md-3 text-align-center  d-flex justify-content-end">
                        <select class="form-select filter-right" aria-label="Default select example">
                            <option value ="default" selected>Theo thứ tự mặc định</option>
                            <option value="price_increase">Giá thấp - cao</option>
                            <option value="price_down">Giá cao - thấp</option>
                            <option value="newest">Mới nhất</option>
                            <option value="oldest">Cũ nhất</option>
                            <option value="sales">Khuyến mãi</option>
                        </select>
                    </div>
                </div>
                    <div class="row search-result">
                        @foreach($products as $product)
                            <div class="col-lg-4 col-md-6">
                                    <div class="product__item" data-id="{{$product['slug']}}">
                                        <div class="product__item__pic set-bg" data-setbg="{{$urlImage}}/{{$product['image']}}">
                                            <?php echo($product['discount']==0 ?'':"<div class='label new'>{$product['discount']} %</div>") ?>
                                            <ul class="product__hover">
                                                <li><a href="{{$urlImage}}/{{$product['image']}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                                <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                                <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h6><a href="/detail/{{$product['slug']}}">{{$product['name']}}</a></h6>
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="product__price"><?php echo number_format($product['price']-($product['price']*$product['discount'])/100, 0, '', ',') ?><span><?php echo ($product['discount']==0?'':number_format($product['price'], 0, '', ',')) ?></span></div>
                                        </div>
                                    </div>
                            </div>
                            @endforeach                   
                    </div> 
                    <div class="row d-flex justify-content-center mt-3">
                        <div class="pagination__option" id="paginate">
                      
                        </div>
                    </div>      
            </div>
        </div>
    </section>
    <script src="{{ asset('users/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('users/js/pagination.js') }}"></script>
    <script src="{{ asset('users/js/shop.js') }}"></script>
    <!-- Shop Section End -->
@endsection