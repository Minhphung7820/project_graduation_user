@extends('layout.layout')
@section('title','Giỏ Hàng')
@section('main')

 <!-- Breadcrumb Begin -->
 <div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                    <?php if(Session::has('customer')){?>
                        <input type="hidden" name="" id="usernamelogin" value="<?php echo  Session::get('customer')->name;?>">
                        <input type="hidden" name="" id="useremaillogin" value="<?php echo Session::get('customer')->email;?>">
                        <?php } ?>
                    <span>Giỏ hàng của tôi</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Breadcrumb End -->

<!-- Shop Cart Section Begin -->
<section class="shop-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop__cart__table">

                    <table>
                        <thead>
                            <tr>
                                <th>Ảnh</th>
                                <th>Sản phẩm</th>
                                <th>Size</th>
                                <th>Màu</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="cartresult">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn">
                    <a href="/shop">Tiếp tục mua sắm</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn update__btn">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
            </div>
            <div class="col-lg-4 offset-lg-2">
                <div class="cart__total__procced">
                    <h6 class="text-center">Hóa đơn</h6>
                    <ul id="checkout">
                        <li class="item__checkout">
                            <div class="checkout-name">	
                                Jordan Delta 3 Mid Delta 3 Mid
                            </div>
                            <div  class="checkout-price">
                            3.524.000 ₫
                            </div>
                        </li>
                    </ul>
                    @if (session()->has('customer'))
                    <a href="#" onclick="checkOutBtn()"  class="primary-btn">Tiếp tục thanh toán</a>
                    @else
                    <a href="/login" class="primary-btn">Đăng nhập để thanh toán</a>
                        
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="text-center font-weight-bold" id="checkoutModalLabel">THÔNG TIN KHÁCH HÀNG</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row mb-3">
                @if ( !Session::has('customer'))
                <div class="col-sm">
                    <a  href="/auth/google" class="btn btn-danger">Đăng nhập cùng Google <i class="fa fa-google-plus" aria-hidden="true"></i></a>
                </div>
                @endif
            </div>

            <div class="row">
                <div class="col-sm mb-3">
                    <input type="text" value="" id="recievername" class="form-control" placeholder="Tên người nhận">
                </div>
                <div class="col-sm mb-3">
                    <input type="text" class="form-control" id="recieverphone" placeholder="Số điện thoại">
                </div>
            </div>
            <div class="row">
                <div class="col-sm mb-3">
                    <input type="text" class="form-control" id="recieveraddress" placeholder="Địa chỉ nhận hàng" >
                </div>
            </div>
            <div class="row">
                <div class="col-sm mb-3">
                    <label for="">Ghi chú</label>
                    <textarea name="" class="form-control" id="note" cols="30" rows="5"></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary" id="submitCounterBtn">Đặt hàng</button>
        </div>
      </div>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script

  src="https://code.jquery.com/jquery-3.6.1.min.js"
  integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
  crossorigin="anonymous"></script>
  
<script src="users/js/cart.js"></script>
<script>
    if($("#usernamelogin").val()&&$("#usernamelogin").val().trim()!=''){
        sessionStorage.setItem("login",1);
    }
//     if(!sessionStorage.getItem('cart')||(sessionStorage.getItem('cart')&&sessionStorage.getItem('cart')=='')){
//   window.location.replace('/');
// }
</script>
@endsection
    <!-- Instagram End -->