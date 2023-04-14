@extends('layout.layout')

@section('title','Đăng nhập')

@section('main')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<link rel="stylesheet" href="{{ asset('users/css/font-awesome.min.css') }}" type="text/css">
<style>
    .form-login-customer input {
        height: 40px;
        border-radius: 20px;
    }

    .page-login {
        min-height: 500px;
    }

    .social-container {
        margin: 20px 0;
    }

    .social-container a {
        border: 1px solid #DDDDDD;
        border-radius: 50%;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        margin: 0 5px;
        height: 40px;
        width: 40px;
    }

    .site-btn {
        border-radius: 20px;
        border: 1px solid #dc3545;
        background-color: #dc3545;
        color: #FFFFFF;
        font-size: 12px;
        font-weight: bold;
        padding: 12px 45px;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: transform 80ms ease-in;
    }

    .site-btn:hover {
        opacity: 0.9;
    }

    .formLogin {
        max-width: 400px;
        box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;
    }

    .fa-google-plus-g {
        color: red;
    }

    .social:hover {
        opacity: 0.8;
    }

    .form-title {
        font-weight: 700;
    }
</style>
<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Đăng nhập</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->
<section class="page-login spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 m-auto formLogin">
                <form class="form-login-customer pl-3 pr-3">
                    <h3 class="text-center mt-4 form-title">Đăng nhập</h3>
                    <div class="social-container text-center">
                        <a href="auth/facebook" class="social fb"><i class="fab fa-facebook-f"></i></a>
                        <a href="auth/google" class="social gg"><i class="fab fa-google-plus-g"></i></a>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Địa chỉ Email <span style="font-weight: bold;color:red;">*</span></label>
                        <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" autofocus>
                        <div class="invalid-feedback email">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mật khẩu <span style="font-weight: bold;color:red;">*</span></label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        <div class="invalid-feedback password">

                        </div>
                    </div>
                    <div class="form-group">
                        <span>Bạn chưa có tài khoản?</span>
                        <a href="/register">Đăng ký</a>
                    </div>
                    <div class="form-group text-center">
                        <a class="a-btn-forgot-password" href="" data-toggle="modal" data-target="#modal-forgot-reset-password">Quên mật khẩu ?</a>
                    </div>
                    <button style="width:100%;margin-bottom:10px;" type="submit" class="site-btn mb-5">Đăng nhập</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!--  -->
<div class="modal fade" id="modal-forgot-reset-password" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-forgot-password-send-mail">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><i class="	fas fa-question"></i> Quên mật khẩu</h5>
                    <button type="button" class="close btn-cancel-resetpass" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Địa chỉ email <span style="color: red;font-weight:bold;">(*)</span></label><br>
                        <em>(Web sẽ gửi khôi phục mật khẩu cho email quý khách !)</em>
                        <input type="text" name="email_forgot" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div class="invalid-feedback email_forgot">

                        </div>
                        <div class="valid-feedback email_forgot">
                            Looks good!
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-cancel-resetpass" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-success btn-send-reset-password"><i class="fab fa-telegram-plane"></i> Gửi xác thực</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--  -->
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
<script src="{{ asset('users/js/login.js') }}"></script>
@endsection