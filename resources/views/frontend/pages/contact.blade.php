@extends('frontend.layouts.main')
@section('pageTitle', 'Thông tin liên hệ và phản hồi')
@section('content')
    <div class="header-banner-intro container-fluid p-0">
        <div class="intro-img">
            <img class="w-100"
                 src="http://mauweb.monamedia.net/hungvy/wp-content/uploads/2018/11/collection_top.jpg" alt="">
        </div>
        <div class="intro-text">
            <h3 class="text-uppercase">Liên hệ</h3>
{{--            <nav aria-label="breadcrumb">--}}
{{--                <ol class="breadcrumb">--}}
{{--                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>--}}
{{--                    <li class="breadcrumb-item " aria-current="page">Liên hệ</li>--}}
{{--                </ol>--}}
{{--            </nav>--}}
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29996.012353455462!2d105.62678889164802!3d19.987454191483028!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3136f323dec8117b%3A0x134da4664b239f33!2zxJDhu4tuaCBMb25nLCBZw6puIMSQ4buLbmgsIFRoYW5oIEhvw6EsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1695741651565!5m2!1svi!2s"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-md-6 contact-right">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <img src="{{asset('frontend/images/logo-oto.png')}}" alt="logo" style="height: 150px">
                    </div>
                    <div class="col-md-6">
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
                </div>
                <div class="mona_title">
                    <h3><span>LIÊN HỆ VỚI CHÚNG TÔI</span></h3>
                </div>
                <div>
                    {{ csrf_field() }}
                    <form class="row g-3" id="myForm"  method="post">
                        <div class="col-6">
                            <label for="name" class="visually-hidden">Họ và tên</label>
                            <input type="text"  class="form-control" id="name" placeholder="Họ và tên" name="name">
                        </div>
                        <div class="col-6">
                            <label for="email" class="visually-hidden">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                        </div>
                        <div class="col-6">
                            <label for="phone" class="visually-hidden">Số điện thoại</label>
                            <input type="number" class="form-control" id="phone" placeholder="Số điện thoại" name="phone">
                        </div>
                        <div class="col-6">
                            <label for="address" class="visually-hidden">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" placeholder="Địa chỉ" name="address">
                        </div>
                        <div class="col-12">
                            <textarea class="common-textarea form-control" id="content" name="content" placeholder="Enter Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Messege'" required=""></textarea>
                        </div>
                        <div class="col-12 text-center">
                            <button type="button"  class="btn btn-send-request mb-3">Gửi</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $(".btn-send-request").click(function(e){
                e.preventDefault();

                var _token = $("input[name='_token']").val();
                var name = $("input[name='name']").val();
                var phone = $("input[name='phone']").val();
                var email = $("input[name='email']").val();
                var address = $("input[name='address']").val();
                var content = $("textarea[name='content']").val();

                $.ajax({
                    url: "{{ route('send-request') }}",
                    type:'POST',
                    data: {_token:_token, name:name, phone:phone, email:email, content:content, address:address},
                    success: function(data) {
                        if($.isEmptyObject(data.errors)){
                            $(".error_msg").html('');
                            alert(data.message);
                            $('#name').val('');
                            $('#content').val('');
                            $('#phone').val('');
                            $('#email').val('');
                            $('#address').val('');
                        }else{
                            let resp = data.errors;
                            for (index in resp) {
                                $("#" + index).html(resp[index]);
                            }
                        }
                    }
                });

            });
        });
    </script>
@endsection
