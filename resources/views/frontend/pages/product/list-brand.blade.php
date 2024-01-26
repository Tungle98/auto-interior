@extends('frontend.layouts.main')
@section('pageTitle', 'Sản phẩm nổi bật tại cửa hàng')
@section('content')
    <div class="container product-content">
        <div class="row">
            <div class="mb-3 row">
                <div class="col-md-9">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}" style="color: gray">TRANG CHỦ</a>
                            </li>
                            <li class="breadcrumb-item active text-uppercase" aria-current="page"
                                style="color: #000000; font-weight: bold">
                                @isset($products)
                                    Cửa hàng
                                @endisset
                                @isset($productCategory)
                                    Màn hình Zestech
                                @endisset

                            </li>
                        </ol>
                    </nav>
                </div>
                {{--                <div class="col-md-3" style="text-align:right;">--}}
                {{--                    <form method="GET" action="">--}}
                {{--                        @csrf--}}
                {{--                        <select class="form-control" placeholder="Lọc theo..." name="orderby">--}}
                {{--                            <option value="date-new">Mới nhất</option>--}}
                {{--                            <option value="price">Giá từ thấp đến cao</option>--}}
                {{--                            <option value="price-desc">Giá từ cao xuống thấp</option>--}}
                {{--                        </select>--}}
                {{--                    </form>--}}
                {{--                </div>--}}
            </div>
            <div class="col-md-3 post-sidebar" id="shop-sidebar">
                @include('frontend.pages.product.left-component-product')
            </div>
            <div class="col-md-9 detail-product-content">
                <div class="row">
                    @if(isset($products))
                        @foreach($products as $item)
                            <div class="col-md-4 col-6 item-product">
                                <a href="{{route('san-pham',['slug' => $item->slug])}}" target="_blank">

                                    <div class="box-img">
                                        <img src="{{$item->image}}" alt="{{$item->desc}}" class="w-100">
                                    </div>
                                    <div class="box-text">
                                        <div class="title-wrapper">
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
                                </a>
                            </div>
                        @endforeach
                        <div> {!! $products->links() !!}</div>
                    @else
                        @foreach($productCategory as $i)
                            @if($i->brand_id === 1)

                                <div class="col-md-4 col-6 item-product">
                                    <a href="{{route('san-pham',['slug' => $i->slug])}}" target="_blank">
                                        {{--                                        <img src="{{$i->image}}" class="card-img-to">--}}
                                        <div class="box-img">
                                            <img src="{{$i->image}}" alt="{{$i->desc}}" class="w-100">
                                        </div>
                                        <div class="box-text">
                                            <div class="title-wrapper">
                                                <p class="name product-title mb-0 pb-0"><a
                                                        href="{{route('san-pham',['slug' => $i->slug])}}">{{$i->name}}</a>
                                                </p>
                                            </div>
                                            @if($i->price_discount > 0)
                                                <del><span class="woocommerce-Price-amount amount"> {{number_format($i->price)}} &nbsp;<span
                                                            class="woocommerce-Price-currencySymbol">₫</span>
                                                    </span>
                                                </del>
                                                <ins><span
                                                        class="woocommerce-Price-amount amount">{{number_format($i->price_discount)}} &nbsp;<span
                                                            class="woocommerce-Price-currencySymbol">₫</span></span></ins>
                                            @else
                                                <ins><span
                                                        class="woocommerce-Price-amount amount">{{number_format($i->price)}} &nbsp;<span
                                                            class="woocommerce-Price-currencySymbol">₫</span></span></ins>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            @endif

                        @endforeach

                    @endif

                </div>
            </div>
        </div>

    </div>
@endsection
