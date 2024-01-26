<div class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="row">
                <div class="col-md-4 col-12 info-store">
                    <div>
{{--                        <img src="{{asset('frontend/images/logo-oto.png')}}" alt="Logo Image" class="w-100">--}}
                      <h4 class="text-uppercase text-white">  Nội Thất ô tô Hoàng Dương</h4>
                    </div>
                    <div>
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ isset($contact['address']) ? $contact['address'] : "" }}
                        </p>
                    </div>
                    <div>
                        <p><i class="fa fa-phone" aria-hidden="true"></i>
                            {{ isset($contact['phone']) ? $contact['phone'] : "" }}</p>
                    </div>
                    <div>
                        <p><i class="fa fa-envelope" aria-hidden="true"></i>
                            {{ isset($contact['email']) ? $contact['email'] : "" }}</p>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <h3>Menu</h3>
                    <div class="footer_line"></div>
                    <div>
                        <ul class="p-0">
                            <li><a href="{{route('home')}}">Trang chủ</a></li>
                            <li><a href="{{route('intro')}}">Giới thiệu</a></li>
                            <li><a href="{{route('cua-hang')}}">Cửa hàng</a></li>
                            <li><a href="{{route('blogs')}}">Tin tức</a></li>
                            <li><a href="{{route('contact')}}">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <h3>Danh mục</h3>
                    <div></div>
                    <div>
                        <ul class="p-0">
                            @foreach($categories as $item)
                            <li><a href="{{route('danh-muc',['slug'=>$item->slug])}}">{{$item->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <h3>Đăng kí</h3>
                    <div></div>
                    <p>Đăng ký để nhận được được thông tin mới nhất từ chúng tôi.</p>
                    <div role="form" class="wpcf7" id="wpcf7-f256-o1" lang="vi" dir="ltr">
                        <div class="screen-reader-response"></div>
                        <form action="/hungvy/#wpcf7-f256-o1" method="post" class="wpcf7-form"
                              novalidate="novalidate">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Email" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-paper-plane"></i></button>
                            </div>
                        </form>
                    </div>
                    <div>
                        <i class="icon-facebook"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<div class="copyright">&copy;Bản quyền thuộc về dev tun</div>
<div class="hotline-phone-ring-wrap">
    <div class="hotline-phone-ring">
        <div class="hotline-phone-ring-circle"></div>
        <div class="hotline-phone-ring-circle-fill"></div>
        <div class="hotline-phone-ring-img-circle"> <a href="tel: {{ isset($contact['phone']) ? $contact['phone'] : "" }}" class="pps-btn-img"> <img
                    src="https://netweb.vn/img/hotline/icon.png" alt="so dien thoai" width="50"> </a>
        </div>
    </div>
    <div class="hotline-bar">
        <a href="tel: {{ isset($contact['phone']) ? $contact['phone'] : "" }}"> <span class="text-hotline"> {{ isset($contact['phone']) ? $contact['phone'] : "" }}</span> </a>
    </div>

</div>


<div class="float-icon-hotline">
    <ul class="left-icon hotline">
        <li class="hotline_float_icon"><a target="_blank" rel="nofollow" id="messengerButton"
                                          href="https://maps.app.goo.gl/RV7dTXsn9DpvJiWV9"><i
                    class="fa fa-map animated infinite tada"></i><span>Map</span></a></li>
        <li class="hotline_float_icon"><a target="_blank" rel="nofollow" id="messengerButton"
                                          href="{{ isset($contact['zalo']) ? $contact['zalo'] : "" }}"><i
                    class="fa fa-zalo animated infinite tada"></i><span>Zalo</span></a></li>
        <li class="hotline_float_icon"><a target="_blank" rel="nofollow" id="messengerButton"
                                          href="{{ isset($contact['facebook']) ? $contact['facebook'] : "" }}"><i
                    class="fa fa-messenger animated infinite tada"></i><span>Facebook</span></a></li>
    </ul>
</div>
