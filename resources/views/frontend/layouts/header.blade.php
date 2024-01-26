<div class="header ">
    <div class="pb-5">
{{--        <nav id="nav_top">--}}
{{--            <div class="container d-flex flex-row">--}}
{{--                <div class="logo">--}}
{{--                    <a href="{{route('home')}}"> <img src="{{asset('frontend/images/logo-oto.png')}}" alt="Logo Image"></a>--}}
{{--                </div>--}}
{{--                <div class="hamburger">--}}
{{--                    <div class="line1"></div>--}}
{{--                    <div class="line2"></div>--}}
{{--                    <div class="line3"></div>--}}
{{--                </div>--}}
{{--                <ul class="nav-links mb-0">--}}
{{--                    <!-- <li> <img src="logo.svg" alt="Logo Image"></li> -->--}}
{{--                    <li><a href="{{route('home')}}" class="active">Trang chủ</a></li>--}}
{{--                    <li><a href="{{route('intro')}}">Giới thiệu</a></li>--}}
{{--                    <li>--}}
{{--                        <a href="{{route('cua-hang')}}">Cửa hàng &#9662;</a>--}}
{{--                        <ul class="dropdown dropdown-custom">--}}
{{--                            @foreach($categories as $item)--}}
{{--                            <li class="text-capitalize"><a href="{{route('danh-muc',['slug'=>$item->slug])}}">{{$item->name}}</a></li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    <li><a href="{{route('blogs')}}">Tin tức</a></li>--}}
{{--                    <li><a href="{{route('contact')}}">Liên hệ</a></li>--}}

{{--                </ul>--}}
{{--            </div>--}}

{{--        </nav>--}}
        <nav id="" class="nav-header">
            <div class="container p-0">
                <div class="menu-icon">
                    <i class="fa fa-bars fa-2x"></i>
                </div>
                <div class="logo">
                    <a href="{{route('home')}}"> <img class="" src="{{asset('frontend/images/logo-oto.png')}}" alt="Logo Image"></a>
                </div>
                <div class="menu">
                    <ul class="nav-links">
                        <li><a href="{{route('home')}}" class="active">Trang chủ</a></li>
                        <li><a href="{{route('intro')}}">Giới thiệu</a></li>
                        <li>
                            <a href="{{route('cua-hang')}}">Cửa hàng &#9662;</a>
                            <ul class="dropdown dropdown-custom">
                                @foreach($categories  as $key =>$item)
                                    @if($key < 5 && $key >= 0 && $item)
                                    <li class="text-capitalize"><a href="{{route('danh-muc',['slug'=>$item->slug])}}">{{$item->name}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        <li><a href="{{route('blogs')}}">Tin tức</a></li>
                        <li><a href="{{route('contact')}}">Liên hệ</a></li>
                    </ul>
                </div>
            </div>

        </nav>
    </div>
</div>
