@extends('frontend.layouts.main')
@section('pageTitle', $product->name)
@section('pageContent', html_entity_decode(strip_tags($product->desc)))
@section('content')
    <div class="container product-content">
        <div class="row">
            <div class="col-md-3 post-sidebar" id="shop-sidebar">

                @include('frontend.pages.product.left-component-product')
            </div>
            <div class="col-md-9 detail-product-content">

                <div class="row">
                    <div class="col-md-6">
                      <img src="{{$product->image}}" alt="" class="w-100">
                    </div>
                    <div class="col-md-6 mt-4">
                        <div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb text-uppercase">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}" style="color: gray">Trang
                                            chủ</a></li>
                                    <li class="breadcrumb-item fw-bold" aria-current="page" >{{$product->category->name}}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="product-dtl">
                            <div class="product-info">
                                <div class="product-name">{{$product->name}}</div>
                                <div style="border-bottom: 3px solid lightgray ; width: 30px" class="mt-3 mb-2"></div>
                                <div class="product-price-discount">
                                    <span>{{number_format($product->price)}} đ</span>
                                    @if($product->price_discount > 0)
                                    <span
                                        class="line-through">{{number_format($product->price_discount)}} đ</span></div>
                                @endif
                            </div>

                            <p>
                                {!! $product->desc !!}
                            </p>
                            <div class="product_meta">

                                        <span class="posted_in">Danh mục: <a
                                                href="{{route('danh-muc',['slug'=>$product->category->slug])}}"
                                                rel="tag">{{$product->category->name}}</a></span>
                            </div>
                        </div>
                    </div>

                </div>
                <hr>
                <div class="product-info-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="description-tab" data-toggle="tab"
                               href="#description" role="tab" aria-controls="description"
                               aria-selected="true">Mô tả</a>
                        </li>
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"--}}
                        {{--                               aria-controls="review" aria-selected="false">Reviews (0)</a>--}}
                        {{--                        </li>--}}
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel"
                             aria-labelledby="description-tab">
                            {!! $product->content !!}
                        </div>
                        <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                            <div class="review-heading">REVIEWS</div>
                            <p class="mb-20">There are no reviews yet.</p>
                            <form class="review-form">
                                <div class="form-group">
                                    <label>Your rating</label>
                                    <div class="reviews-counter">
                                        <div class="rate">
                                            <input type="radio" id="star5" name="rate" value="5"/>
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rate" value="4"/>
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rate" value="3"/>
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rate" value="2"/>
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rate" value="1"/>
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Your message</label>
                                    <textarea class="form-control" rows="10"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="" class="form-control" placeholder="Name*">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="" class="form-control"
                                                   placeholder="Email Id*">
                                        </div>
                                    </div>
                                </div>
                                <button class="round-black-btn">Submit Review</button>
                            </form>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="related related-products-wrapper product-section">
                    <h2>Sản phẩm tương tự</h2>
                    <div class="row product-list-pc">
                        @foreach($related_product as $item)
                            <div class="col-md-3 item-product">
                                <div class="box-img">
                                    <a
                                        href="{{route('san-pham',['slug' => $item->slug])}}">
                                        <img src="{{$item->image}}" alt="{{$item->slug}}" class="w-100">
                                    </a>
                                </div>
                                <div class="box-text">
                                    <div class="product-title">
                                        <p class="name product-title"><a
                                                href="{{route('san-pham',['slug' => $item->slug])}}">{{$item->name}}</a>
                                        </p>
                                    </div>
                                    <div class="price-wrapper">
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
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
