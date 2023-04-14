@extends('layout.layout')

@section('title', 'Tài khoản của tôi')

@section('main')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<link rel="stylesheet" href="{{ asset('users/css/font-awesome.min.css') }}" type="text/css">
<style>
    .form-login-customer input {
        height: 40px;
        border-radius: 20px;
    }

    .page-account {
        min-height: 500px;
    }

    .tabledetail th {
        font-size: 12px
    }

    .tabledetail td p {
        font-size: 12px
    }
    .alert-success{
        display: none;
    }
</style>
<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Tài khoản của tôi</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->
<section class="page-account mt-3">
    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-3 col-sm-12">
                <div class="list-group">
                    <a href="#" id="allBillsLink" class="list-group-item list-group-item-action"><i class="	fas fa-id-card"></i> Đơn hàng của
                        tôi</a>
                    <!-- <a href="#" class="list-group-item list-group-item-action">Cập nhật thông tin</a> -->
                    @if(session()->get('customer')->provider == null)
                    <a href="#" class="list-group-item list-group-item-action a-btn-change-password" data-toggle="modal" data-target="#modal-change-password"><i class="	fas fa-user-lock"></i> Đổi mật khẩu</a>
                    @endif
                    <a href="/logout" class="list-group-item list-group-item-action"><i class="	fas fa-power-off"></i> Đăng xuất</a>
                </div>
            </div>
            <!--  -->
            <div class="modal fade" id="modal-change-password" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form id="form-change-password">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="	fas fa-lock"></i> Đổi mật khẩu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-success" role="alert">
                                    A simple success alert—check it out!
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="idCus" value="{{ session()->get('customer')->id }}">
                                    <label for="exampleInputPassword1">Nhập mật khẩu cũ <span style="color: red;font-weight:bold;">(*)</span></label>
                                    <input type="password" name="old_password" class="form-control" id="exampleInputPassword1">
                                    <div class="invalid-feedback old_password">
                                        Please provide a valid city.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nhập mật khẩu mới <span style="color: red;font-weight:bold;">(*)</span></label>
                                    <input type="password" name="new_password" class="form-control" id="exampleInputPassword1">
                                    <div class="invalid-feedback new_password">
                                        Please provide a valid city.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nhập lại mật khẩu <span style="color: red;font-weight:bold;">(*)</span></label>
                                    <input type="password" name="confirm_password" class="form-control" id="exampleInputPassword1">
                                    <div class="invalid-feedback confirm_password">
                                        Please provide a valid city.
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-success">[<i class="	fas fa-sync"></i>] Đổi mật khẩu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--  -->
            <div class="col-lg-9 col-sm-12" id="resultBillDetail">
                <table class="table tablebills">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Ngày đặt hàng</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th class="desktop"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($bills as $item)
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= date('H:i - d/m/yy', strtotime($item['created_at'])) ?></td>
                            <td><?= number_format($item['total'], 0) ?></td>
                            <td>
                                @if ($item['status'] == 1)
                                <b>Đã đặt hàng</b>
                                @else
                                @if ($item['status'] == 2)
                                <b>Đang giao</b>
                                @else
                                @if ($item['status'] == 0)
                                <b>Đã hủy</b>
                                @else
                                @if ($item['status'] == 3)
                                <b>Thành công</b>
                                @else
                                @endif
                                @endif
                                @endif
                                @endif

                            </td>
                            <td class="desktop">
                                <a href="#" class="btn-sm btn-success billdetailbtn" data-id="{{ $item['idBill'] }}">Chi tiết</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="accordion" id="accordionExample">
                    @foreach ($bills as $item)
                    <div class="card mt-2">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$item['idBill']}}" aria-expanded="true" aria-controls="collapse{{$item['idBill']}}">
                                    <b>{{$item['customername']}}</b>
                                    <p><?= date('H:i - d/m/yy', strtotime($item['created_at'])) ?></p>
                                </button>
                            </h2>
                        </div>

                        <div id="collapse{{$item['idBill']}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <span>Tổng tiền :</span> <b><?= number_format($item['total'], 0) ?></b><br>
                                <span>Tình trạng : </span> @if ($item['status'] == 1)
                                <b>Đã đặt hàng</b>
                                @else
                                @if ($item['status'] == 2)
                                <b>Đang giao</b>
                                @else
                                @if ($item['status'] == 0)
                                <b>Đã hủy</b>
                                @else
                                @if ($item['status'] == 3)
                                <b>Thành công</b>
                                @else
                                @endif
                                @endif
                                @endif
                                @endif
                                <br>
                                <a href="#" class="btn-sm btn-success billdetailbtn" data-id="{{ $item['idBill'] }}">Chi tiết</a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>
</section>
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="users/js/personal.js"></script>
<script>
    function AjaxSetup() {
        return $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    }
    var host = 'http://127.0.0.1:3000/';
    if ($("#usernamelogin").val() && $("#usernamelogin").val().trim() != '') {
        sessionStorage.setItem("login", 1);
    }
    var width = $(window).width();
    var desktop = $(".desktop");
    var mobie = $(".mobie");
    if (width <= 1200) {
        $(".tablebills").hide();
        $(".accordion").show();
    } else {
        $(".tablebills").show();
        $(".accordion").hide();
    }

    // 

    $(document).on("click", ".a-btn-change-password", function(e) {
        e.preventDefault();
    })
</script>
<script src="{{ asset('users/js/change-password.js') }}"></script>
@endsection