@extends('layout.layout')
@section('title','Quản lý đơn hàng')
@section('main')
<section class="shop-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg">
                <table class="table">
                    <thead>
                        <tr class="thead-dark">
                            <th>#</th>
                            <th>Ngày mua</th>
                            <th>Số lượng sản phẩm</th>
                            <th>Tổng giá trị</th>
                            <th>Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row"></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            {{-- <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn">
                    <a href="#">Continue Shopping</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn update__btn">
                    <a href="/cart"><span class="icon_loading"></span> Update cart</a>
                </div>
            </div> --}}
        </div>
        <div class="row">
            <div class="col-lg-6">
                {{-- <div class="discount__content">
                    <h6>Discount codes</h6>
                    <form action="#">
                        <input type="text" placeholder="Enter your coupon code">
                        <button type="submit" class="site-btn">Apply</button>
                    </form>
                </div> --}}
            </div>
            <div class="col-lg-4 offset-lg-2">
                {{-- <div class="cart__total__procced">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal <span class="total"></span></li>
                        <li>Total <span class="total"></span></li>
                    </ul>
                    <a href="#" id="checkOutBtn" class="primary-btn">Thanh toán</a>
                </div> --}}
            </div>
        </div>
    </div>
</section>
@endsection