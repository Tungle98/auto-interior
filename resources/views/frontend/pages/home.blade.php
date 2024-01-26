@extends('frontend.layouts.main')
@section('content')
    <div class="header-banner container-fluid p-0">
        <section class="banner__slider">
            <div class="slider stick-dots">
                @foreach($sliders as $slider)
                    <div class="slide">
                        <div class="slide__img">
                            <img src="" alt=""
                                 data-lazy="{{$slider->image}}"
                                 class="w-100 animated " data-animation-in="zoomInImage"/>
                        </div>
                        <div class="slide__content ">
                            <div class="slide__content--headings text-center">

                                <p class="animated top-title" data-aos="fade-up" data-aos-duration="2000">
                                    {{$slider->desc}}</p>
                                <h2 class="animated title" data-aos="fade-up">{{$slider->title}}</h2>
                                {{--                                <button class="btn-light btn button-custom animated" data-aos="fade-up"--}}
                                {{--                                        data-aos-duration="2000">Our menu--}}
                                {{--                                </button>--}}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" width="44px" height="44px"
                        id="circle" fill="none" stroke="currentColor">
                    <circle r="20" cy="22" cx="22" id="test"></circle>
                </symbol>
            </svg>
        </section>


    </div>
    <div class="container">
        <div class="head-intro text-center mb-5">
            <h2>HỆ THỐNG ĐỒ CHƠI XE Ô TÔ TOÀN DIỆN
            </h2>
            <div class="devvn_separator"></div>
            <p>
                Nội thất ô tô Hoàng Dương chuyên phân phối đồ chơi ô tô và phụ tùng bảo dưỡng cao cấp
            </p>
        </div>
        <div class="content-intro">
            <div class="row">
                @if(isset($brandProductZtech[0]))
                    <div class="col-md-6 mb-4">
                        <div class="intro-parent " >
                            <a href="{{route('brand',['slug'=>$brandProductZtech[0]->slug])}}" class="intro-link">
                                <img
                                    src="{{asset('frontend/images/anh555.png')}}"
                                    alt="" class="w-100 img-bg">
                                                            <div class="overlay"></div>
                                <div class="intro-text">
                                    <div class="intro-text-title">
                                        <h4>Màn hình Zestech</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
                <div class="col-md-6 mb-4">
                    <div class="intro-parent" style="">
                        <a href="{{route('danh-muc',['slug'=> 'do-den-gtr'])}}" class="intro-link">
                            <img src="{{asset('frontend/images/do-den.png')}}" alt="" class="w-100">
                            <div class="intro-text">
                                <div class="intro-text-title">
                                    <h4>Độ đèn GTR</h4>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="intro-parent" style="">
                        <a href="{{route('danh-muc',['slug'=>'phim-cach-nhiet'])}}" class="intro-link">
                            <img src="{{asset('frontend/images/phim-cach-nhiet.png')}}" alt="" class="w-100">
                            <div class="intro-text">
                                <div class="intro-text-title">
                                    <h4>PHIM CÁCH NHIỆT Ô TÔ</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                @if(isset($categoryProductHome[2]))
                    <div class="col-md-6 mb-4">
                        <div class="intro-parent" style="">
                            <a href="{{route('danh-muc',['slug'=>$categoryProductHome[2]->slug])}}" class="intro-link">
                                <img src="{{asset('frontend/images/cam-hanh-trinh-1.png')}}" alt="" class="w-100">
                                <div class="intro-text">
                                    <div class="intro-text-title">
                                        <h4>Camera hành trình</h4>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @if(isset($categoryProductHome[0]))
        <div class="content-product container">
            <div class="content-intro">
                <div class="intro-title text-center">
                    <div class="mona_title">
                        <h3 class="text-uppercase"><span>{{$categoryProductHome[0]->name}}</span></h3>
                    </div>
                    <a href="{{route('danh-muc',['slug'=>$categoryProductHome[0]->slug])}}" target="_self"
                       class="btn-show-more button secondary is-link box-shadow-5-hover lowercase">
                        <span>Xem thêm</span>
                        <i class="fa fa-play" aria-hidden="true"></i>

                    </a>
                </div>

            </div>
            <div class="product_list">
                <div class="row product-list-pc">
                    @foreach($categoryProductHome[0]->product as $key =>$item)
                        @if($key < 5 && $key >= 0 && $item)
                            <div class="col-md-3 col-6 item-product">
                                <div class="box-img">
                                    <a href="{{route('san-pham',['slug' => $item->slug])}}">
                                        <img src="{{$item->image}}" alt="{{$item->slug}}" class="w-100">
                                    </a>
                                </div>
                                <div class="box-text">
                                    <div class="product-title">
                                        <p class="name product-title mb-0 pb-0"><a
                                                href="{{route('san-pham',['slug' => $item->slug])}}">{{$item->name}}</a>
                                        </p>
                                    </div>
                                    <span class="price">
                                            @if($item->price_discount > 0)
                                            <del><span class="woocommerce-Price-amount amount"> {{number_format($item->price)}} &nbsp;<span
                                                        class="woocommerce-Price-currencySymbol">₫</span>
                                                    </span>
                                                </del>
                                            <ins><span
                                                    class="woocommerce-Price-amount amount">{{number_format($item->price_discount)}} &nbsp;<span
                                                        class="woocommerce-Price-currencySymbol">₫</span></span></ins>
                                        @else
                                            <ins><span
                                                    class="woocommerce-Price-amount amount">{{number_format($item->price)}} &nbsp;<span
                                                        class="woocommerce-Price-currencySymbol">₫</span></span></ins>
                                        @endif

                                        </span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if(isset($categoryProductHome[1]))
        <div class="content-product container">
            <div class="content-intro">
                <div class="intro-title text-center">
                    <div class="mona_title">
                        <h3><span>{{$categoryProductHome[1]->name}}</span></h3>
                    </div>
                    <a href="{{route('danh-muc',['slug'=>$categoryProductHome[1]->slug])}}" target="_self"
                       class="btn-show-more button secondary is-link box-shadow-5-hover lowercase">
                        <span>Xem thêm</span>
                        <i class="fa fa-play" aria-hidden="true"></i>

                    </a>
                </div>

            </div>
            <div class="product_list">
                <div class="row product-list-pc">
                    @foreach($categoryProductHome[1]->product as $key =>$item)
                        @if($key < 8 && $key >= 0 && $item)
                            <div class="col-md-3 col-6 item-product">
                                <div class="box-img">
                                    <a href="{{route('san-pham',['slug' => $item->slug])}}">
                                        <img src="{{$item->image}}" alt="{{$item->slug}}" class="w-100">
                                    </a>
                                </div>
                                <div class="box-text">
                                    <div class="product-title">
                                        <p class="name product-title mb-0 pb-0"><a
                                                href="{{route('san-pham',['slug' => $item->slug])}}">{{$item->name}}</a>
                                        </p>
                                    </div>
                                    <span class="price">
                                            @if($item->price_discount > 0)
                                            <del><span class="woocommerce-Price-amount amount"> {{number_format($item->price)}} &nbsp;<span
                                                        class="woocommerce-Price-currencySymbol">₫</span>
                                                    </span>
                                                </del>
                                            <ins><span
                                                    class="woocommerce-Price-amount amount">{{number_format($item->price_discount)}} &nbsp;<span
                                                        class="woocommerce-Price-currencySymbol">₫</span></span></ins>
                                        @else
                                            <ins><span
                                                    class="woocommerce-Price-amount amount">{{number_format($item->price)}} &nbsp;<span
                                                        class="woocommerce-Price-currencySymbol">₫</span></span></ins>
                                        @endif

                                        </span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    {{--    <div class="content-ads container">--}}
    {{--        <div class="row">--}}
    {{--            @foreach($promotions as $item)--}}
    {{--            <div class="col-md-6 mb-3">--}}
    {{--                <div class="wrap-home">--}}
    {{--                    <div class="area">--}}
    {{--                        <img class="stretch w-100"--}}
    {{--                             src="{{$item->image}}"/>--}}
    {{--                    </div>--}}

    {{--                    <div class="display-position">--}}
    {{--                        <h1>{{$item->name}}</h1>--}}
    {{--                        <p>{{$item->desc}}</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            @endforeach--}}
    {{--        </div>--}}
    {{--    </div>--}}
        @if(isset($categoryProductHome[2]))
            <div class="content-product container">
                <div class="content-intro">
                    <div class="intro-title text-center">
                        <div class="mona_title">
                            <h3><span>{{$categoryProductHome[2]->name}}</span></h3>
                        </div>
                        <a href="{{route('danh-muc',['slug'=>$categoryProductHome[2]->slug])}}" target="_self"
                           class="btn-show-more button secondary is-link box-shadow-5-hover lowercase">
                            <span>Xem thêm</span>
                            <i class="fa fa-play" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="product_list">
                    <div class="row product-list-pc">
                        @foreach($categoryProductHome[2]->product as $key =>$item)
                            @if($key < 5 && $key >= 0 && $item)
                                <div class="col-md-3 col-6 item-product">
                                    <div class="box-img">
                                        <a href="{{route('san-pham',['slug' => $item->slug])}}">
                                            <img src="{{$item->image}}" alt="{{$item->slug}}" class="w-100">
                                        </a>
                                    </div>
                                    <div class="box-text">
                                        <div class="product-title">
                                            <p class="name product-title mb-0 pb-0"><a
                                                    href="{{route('san-pham',['slug' => $item->slug])}}">{{$item->name}}</a>
                                            </p>
                                        </div>
                                        <span class="price">
                                                @if($item->price_discount > 0)
                                                <del><span class="woocommerce-Price-amount amount"> {{number_format($item->price)}} &nbsp;<span
                                                            class="woocommerce-Price-currencySymbol">₫</span>
                                                        </span>
                                                    </del>
                                                <ins><span
                                                        class="woocommerce-Price-amount amount">{{number_format($item->price_discount)}} &nbsp;<span
                                                            class="woocommerce-Price-currencySymbol">₫</span></span></ins>
                                            @else
                                                <ins><span
                                                        class="woocommerce-Price-amount amount">{{number_format($item->price)}} &nbsp;<span
                                                            class="woocommerce-Price-currencySymbol">₫</span></span></ins>
                                            @endif

                                            </span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @if(isset($categoryProductHome[3]))
            <div class="content-product container">
                <div class="content-intro">
                    <div class="intro-title text-center">
                        <div class="mona_title">
                            <h3><span>{{$categoryProductHome[3]->name}}</span></h3>
                        </div>
                        <a href="{{route('danh-muc',['slug'=>$categoryProductHome[3]->slug])}}" target="_self"
                           class="btn-show-more button secondary is-link box-shadow-5-hover lowercase">
                            <span>Xem thêm</span>
                            <i class="fa fa-play" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="product_list">
                    <div class="row product-list-pc">
                        @foreach($categoryProductHome[3]->product as $key =>$item)
                            @if($key < 5 && $key >= 0 && $item)
                                <div class="col-md-3 col-6 item-product">
                                    <div class="box-img">
                                        <a href="{{route('san-pham',['slug' => $item->slug])}}">
                                            <img src="{{$item->image}}" alt="{{$item->slug}}" class="w-100">
                                        </a>
                                    </div>
                                    <div class="box-text">
                                        <div class="product-title">
                                            <p class="name product-title mb-0 pb-0"><a
                                                    href="{{route('san-pham',['slug' => $item->slug])}}">{{$item->name}}</a>
                                            </p>
                                        </div>
                                        <span class="price">
                                                @if($item->price_discount > 0)
                                                <del><span class="woocommerce-Price-amount amount"> {{number_format($item->price)}} &nbsp;<span
                                                            class="woocommerce-Price-currencySymbol">₫</span>
                                                        </span>
                                                    </del>
                                                <ins><span
                                                        class="woocommerce-Price-amount amount">{{number_format($item->price_discount)}} &nbsp;<span
                                                            class="woocommerce-Price-currencySymbol">₫</span></span></ins>
                                            @else
                                                <ins><span
                                                        class="woocommerce-Price-amount amount">{{number_format($item->price)}} &nbsp;<span
                                                            class="woocommerce-Price-currencySymbol">₫</span></span></ins>
                                            @endif

                                            </span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-8 text-center">
                <h2 class="text-uppercase">Tại sao lại chọn chúng tôi</h2>
                <div class="row mt-5">
                    <div class="col-md-6 col-12 mb-4">
                        <div class="item-choose-red">
                            <h3>Sản phẩm chính hãng</h3>
                            <p>Chuyên cung cấp đồ chơi xe ô tô nhập khẩu chính hãng trực tiếp từ nhà sản xuất</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-4">
                        <div class="item-choose-gray">
                            <h3>Lắp đặt miễn phí</h3>
                            <p>Chuyên cung cấp đồ chơi xe ô tô nhập khẩu chính hãng trực tiếp từ nhà sản xuất</p>
                        </div>

                    </div>
                    <div class="col-md-6 col-12 mb-4">
                        <div class="item-choose-gray">
                            <h3>Kỹ thuật chuyên nghiệp</h3>
                            <p>Chuyên cung cấp đồ chơi xe ô tô nhập khẩu chính hãng trực tiếp từ nhà sản xuất</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-4">
                        <div class="item-choose-red">
                            <h3>Dịch vụ hậu mãi</h3>
                            <p>Chuyên cung cấp đồ chơi xe ô tô nhập khẩu chính hãng trực tiếp từ nhà sản xuất</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <img src="https://minhthanhauto.vn/wp-content/uploads/2023/10/web-zestech-zx10.png" alt="img"
                     class="w-100">
            </div>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <h2 class="text-center">KHÁCH HÀNG NÓI GÌ VỀ NỘI THẤT OTO HOÀNG DƯƠNG</h2>
        <div class="devvn_separator"></div>
        <div class="wrapper mt-4">
            <div class="carousel-feedback ">
                @if(isset($videoFeedback))
                @foreach($videoFeedback as $video)
                    <div class="slick-change">
                        <div class="">
                            <a class="popup-youtube icon-link" href="{{$video->link}}">
                                <img  class="img-responsive" src="{{$video->image}}" alt="builder app video" />
                                <div class=" cricle-icon-play">
                                    <i class="fa fa-play play-style centered" aria-hidden="true"></i>
                                </div>
                           </a>

                        </div>
                    </div>

                @endforeach
                @endif
            </div>
        </div>
    </div>
{{--    </div>--}}
    <div class="content-news container">
        <div class="content-intro">
            <div class="intro-title text-center">
                <div class="mona_title">
                    <h3><span>TIN TỨC – SỰ KIỆN</span></h3>
                </div>
                <a href="{{route('blogs')}}" target="_self"
                   class="btn-show-more button secondary is-link box-shadow-5-hover lowercase">
                    <span>Xem thêm</span>
                    <i class="fa fa-play" aria-hidden="true"></i>

                </a>
            </div>
        </div>

        <div class="wrapper">
            <div class="carousel-news">
                @foreach($blogs as $blog)
                    <div class="slick-change">
                        <div class="card card-new-home">
                            <a href="{{route('blog',['slug' => $blog->slug])}}">
                                <img src="{{$blog->image}}" class="card-img-top w-100" alt="..." style="height: 230px">
                                <div class="card-body">
                                    <h5 class="card-title title-post">{{$blog->title}}</h5>
                                    <p class="card-text desc-post">
                                        {{$blog->desc}}
                                    </p>

                                </div>
                            </a>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
    <div class="container-fluid p-0 mt-5">
        <div class="banner-home-intro">
            <img src="{{asset('frontend/images/ntoooo.jpg') }}" alt="" class="w-100" style="height: 700px">
        </div>
        <div class="note-sevice">
            <div class="row">
                <div class="col-md-3 "></div>
            </div>
        </div>
    </div>

@endsection
