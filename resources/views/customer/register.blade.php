@extends('layout.layout')

@section('title','Đăng Ký')

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
    .alert-success{
        display: none;
    }
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
.site-btn{
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
.site-btn:hover{
    opacity: 0.9;
}
.formLogin{
    max-width: 400px;
    box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;
}
.fa-google-plus-g{
    color: red;
}
.social:hover{
    opacity: 0.8;
}
.form-title{
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
                    <span>Đăng ký</span>
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
                <div class="alert alert-success" role="alert">
                    A simple success alert—check it out!
                </div>
                <form class="form-register-customer pl-3 pr-3">
                <h3 class="text-center mt-4 form-title">Đăng ký</h3>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Họ tên <span style="font-weight: bold;color:red;">*</span></label>
                        <input type="text" name="name" class="form-control" aria-describedby="emailHelp" autofocus>
                        <div class="invalid-feedback name">
                            Please provide a valid city.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email <span style="font-weight: bold;color:red;">*</span></label>
                        <input type="text" name="email" class="form-control" aria-describedby="emailHelp">
                        <div class="invalid-feedback email">
                            Please provide a valid city.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số điện thoại <span style="font-weight: bold;color:red;">*</span></label>
                        <input type="text" name="phone" class="form-control" aria-describedby="emailHelp">
                        <div class="invalid-feedback phone">
                            Please provide a valid city.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mật khẩu <span style="font-weight: bold;color:red;">*</span></label>
                        <input type="password" name="password" class="form-control">
                        <div class="invalid-feedback password">
                            Please provide a valid city.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nhập lại mật khẩu <span style="font-weight: bold;color:red;">*</span></label>
                        <input type="password" name="confirm_password" class="form-control">
                        <div class="invalid-feedback confirm_password">
                            Please provide a valid city.
                        </div>
                    </div>
                    <button style="width:100%;margin-bottom:10px;" type="submit" class="site-btn btn-submit-register mb-5 mt-3">Đăng ký</button>

                </form>
            </div>
        </div>
    </div>
</section>
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
<script src="{{ asset('users/js/register.js') }}"></script>
@endsection