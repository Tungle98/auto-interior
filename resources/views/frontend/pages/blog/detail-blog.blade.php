@extends('frontend.layouts.main')
@section('pageTitle', $detail->title)
@section('pageContent', html_entity_decode(strip_tags($detail->desc)))
@section('content')
    <div class="container news-content">
        <div class="row">

            <div class="col-md-9 detail-content mb-5">
                <h6 class="pt-4">Tin tức</h6>
                <h3>{{$detail->title}}</h3>
                <div>
                    <p>
                        {{$detail->desc}}
                    </p>
                </div>
                <div class="pt-5">
                    <img src="{{$detail->image}}"
                         class="w-100" alt="">
                </div>
                <div class="pt-5">
                    {!! $detail->content !!}
                </div>
            </div>
            <div class="col-md-3 post-sidebar">
                @include('frontend.pages.blog.right-component-blog')
            </div>
        </div>

    </div>
@endsection
