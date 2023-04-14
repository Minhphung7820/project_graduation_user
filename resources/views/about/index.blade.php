@extends('layout.layout')
@section('title', 'Giới thiệu')
@section('main')
<style>
.blog-details{
 padding-top:20px;
 }
</style>
<div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                        <a href="#">Về chúng tôi</a>
                        <span>Giới thiệu</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<section class="blog-details spad">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-10 col-md-10 ">
                
                @if (!empty($infos))
                    @foreach($infos as $about)
                        {!!$about['introShop']!!}
                    @endforeach
                @else
                    xin chào
                @endif
            </div>
            
        </div>
    </div>
</section>
@endsection
