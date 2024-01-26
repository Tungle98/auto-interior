<!DOCTYPE html>

<html
    lang="en"
    class="light-style layout-menu-fixed layout-compact"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

    <title>Dashboard noi that o to hoang duong</title>

    <meta name="description" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico"/>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"/>

    <link rel="stylesheet" href="{{asset('backend/assets/vendor/fonts/boxicons.css')}}"/>

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('backend/assets/vendor/css/core.css')}}" class="template-customizer-core-css"/>
    <link rel="stylesheet" href="{{asset('backend/assets/vendor/css/theme-default.css')}}"
          class="template-customizer-theme-css"/>
    <link rel="stylesheet" href="{{asset('backend/assets/css/demo.css')}}"/>

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}"/>
    <link rel="stylesheet" href="{{asset('backend/assets/vendor/libs/apex-charts/apex-charts.css')}}"/>
    <link href="{{ asset('backend/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="{{asset('backend/assets/vendor/js/helpers.js')}}"></script>

    <script src="{{asset('backend/assets/js/config.js')}}"></script>

</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
                   <img src="{{asset('frontend/images/logo-oto.png')}}" alt="Logo Image" style="width: 150px">
              </span>
{{--                    <span class="app-brand-text demo menu-text fw-bold ms-2">Admin</span>--}}
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                <!-- Forms & Tables -->
                <li class="menu-header small text-uppercase"><span class="menu-header-text">Quản lý pages</span>
                </li>
                <!-- Forms -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-detail"></i>
                        <div data-i18n="Form Elements">Bài viết</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{route('cms.blog.index')}}" class="menu-link">
                                <div data-i18n="Basic Inputs">Danh sách bài viết</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('cms.blog.create-edit')}}" class="menu-link">
                                <div data-i18n="Input groups">Tạo bài viết</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-detail"></i>
                        <div data-i18n="Form Elements">Danh mục sản phẩm</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{route('cms.category.index')}}" class="menu-link">
                                <div data-i18n="Basic Inputs">Danh sách danh mục</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-detail"></i>
                        <div data-i18n="Form Elements">Sản phẩm</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{route('cms.product.index')}}" class="menu-link">
                                <div data-i18n="Basic Inputs">Danh sách sản phẩm</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('cms.product.create-edit')}}" class="menu-link">
                                <div data-i18n="Input groups">Tạo sản phẩm mới</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-detail"></i>
                        <div data-i18n="Form Elements">Nhãn hàng</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{route('cms.brand.index')}}" class="menu-link">
                                <div data-i18n="Basic Inputs">Danh sách nhãn hàng</div>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-detail"></i>
                        <div data-i18n="Form Elements">Silder trang chủ</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{route('cms.slider.index')}}" class="menu-link">
                                <div data-i18n="Basic Inputs">Danh sách slider</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('cms.slider.create-edit')}}" class="menu-link">
                                <div data-i18n="Input groups">Tạo slider</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-detail"></i>
                        <div data-i18n="Form Elements">Khuyến mãi</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{route('cms.promotion.index')}}" class="menu-link">
                                <div data-i18n="Basic Inputs">Danh sách khuyến mãi</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('cms.promotion.create-edit')}}" class="menu-link">
                                <div data-i18n="Input groups">Tạo khuyến mãi</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-detail"></i>
                        <div data-i18n="Form Elements">Config thông tin</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{route('cms.config-system.index')}}" class="menu-link">
                                <div data-i18n="Basic Inputs">Danh sách config</div>
                            </a>
                        </li>

                    </ul>
                </li>
                <!-- Tables -->
                <li class="menu-item">
                    <a href="{{route('cms.customer-request.index')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-table"></i>
                        <div data-i18n="Tables">Khách hàng feeback</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-detail"></i>
                        <div data-i18n="Form Elements"> Feedback video</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{route('cms.feedback-video.index')}}" class="menu-link">
                                <div data-i18n="Basic Inputs">Ds feeback video</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('cms.feedback-video.create-edit')}}" class="menu-link">
                                <div data-i18n="Input groups">Tạo feeback video</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Forms & Tables -->
                <li class="menu-header small text-uppercase"><span class="menu-header-text">Quản lý thông tin</span></li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-detail"></i>
                        <div data-i18n="Form Elements">Tài khoản</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{route('cms.user.index')}}" class="menu-link">
                                <div data-i18n="Basic Inputs">Danh sách tài khoản</div>
                            </a>
                            <a href="{{route('cms.role.index')}}" class="menu-link">
                                <div data-i18n="Basic Inputs">Danh sách vai trò</div>
                            </a>
                            <a href="{{route('cms.permission.index')}}" class="menu-link">
                                <div data-i18n="Basic Inputs">Danh sách quyền</div>
                            </a>
                        </li>

                    </ul>
                </li>
                <!-- Forms -->
            </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
    @include('admin.layouts.header')
    <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->


<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

<script src="{{asset('backend/assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{ asset('backend/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="{{asset('backend/assets/vendor/libs/popper/popper.js')}}"></script>
<script src="{{asset('backend/assets/vendor/js/bootstrap.js')}}"></script>
<script src="{{asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('backend/assets/vendor/js/menu.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{asset('backend/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

<!-- Main JS -->
<script src="{{asset('backend/assets/js/main.js')}}"></script>

<!-- Page JS -->
<script src="{{asset('backend/assets/js/dashboards-analytics.js')}}"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="{{asset('backend/js/helper.js')}}"></script>
@stack('scripts')
</body>
</html>
