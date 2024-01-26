
@extends('frontend.layouts.main')
@section('pageTitle', 'Danh sách kết quả tìm kiếm')
@section('content')
    <div class="container news-content">
        <div class="row">

            <h2 class="text-uppercase">Kết quả tìm kiếm: {{ app('request')->input('key') }}</h2>
            <div class="col-md-9 mb-5">
                <div class="row">
                    @foreach($result as $item)
                        <div class="col-md-4 item-new">
                            <div class="card">
                                <a href="{{route('blog',['slug' => $item->slug])}}" target="_blank">
                                    <img src="{{$item->image}}" class="card-img-top w-100"
                                         alt="..." style="height: 200px">
                                    <div class="card-body">
                                        <h5 class="card-title title-post">{{$item->title}}</h5>
                                        <p class="card-text desc-post">{{$item->desc}}</p>

                                    </div>
                                </a>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="col-md-3 post-sidebar">
                @include('frontend.pages.blog.right-component-blog')
            </div>
        </div>

    </div>

@endsection
