@extends('frontend.layouts.main')
@section('pageTitle', 'Giới thiệu chi tiết dịch vụ')
@section('content')
    <div class="header-banner-intro container-fluid p-0">
        <div class="intro-img">
            <img class="w-100"
                 src="http://mauweb.monamedia.net/hungvy/wp-content/uploads/2018/11/collection_top.jpg" alt="">
        </div>
        <div class="intro-text">
            <h3 class="text-uppercase">Giới thiệu</h3>
{{--            <nav aria-label="breadcrumb">--}}
{{--                <ol class="breadcrumb">--}}
{{--                    <li class="breadcrumb-item"><a href="{{route('home')}}" style="color: white">Trang chủ</a></li>--}}
{{--                    <li class="breadcrumb-item" aria-current="page">Giới thiệu</li>--}}
{{--                </ol>--}}
{{--            </nav>--}}
        </div>
    </div>
    <div class="container">
        <div class="text-center">
            <img src="{{asset('frontend/images/logo-oto.png')}}" alt="logo" style="height: 200px">
        </div>
        <div class="content-intro">
            <div class="intro-title text-center">
                <div class="mona_title">
                    <h3><span>VỀ CHÚNG TÔI</span></h3>
                </div>
                <p>Chuyên cung cấp các mặt hàng điện tử chuyên dụng cho xe hơi</p>
            </div>
            <div class="row mt-5 text-center">
                <div class="col-md-4">
                    <h4 class="text-uppercase "> Bảo dưỡng xe</h4>
                </div>
                <div class="col-md-4">
                    <h4 class="text-uppercase"> Nâng cấp màn hình</h4>
                </div>
                <div class="col-md-3">
                    <h4 class="text-uppercase"> Thay thế linh kiện</h4>
                </div>

            </div>
        </div>
    </div>
@endsection
