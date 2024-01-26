
@extends('admin.layouts.main')

@section('title', isset($query) ? 'Chỉnh sửa Khuyến mãi' : 'Tạo khuyến mãi')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            @include('admin.pages.component.alert-error')
            <div class="row">

                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header"> {{ isset($query) ? 'Chỉnh sửa khuyến mãi' : 'Tạo khuyến mãi' }}</h5>
                        <div class="card-body">
                            <form class="row g-3 needs-validation" novalidate
                                  @if(isset($query))
                                  action="{{ route('cms.promotion.update', $query->id) }}"
                                  @else
                                  action="{{ route('cms.promotion.store') }}"
                                  @endif
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Tiêu đề </label>
                                    <input name="name" type="text" class="form-control" id="name"
                                           value="{{ old('name',  isset($query) ? $query->name : '') }}"
                                           pattern="^.{2,255}$"
                                           placeholder="Tiêu đề ........" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlReadOnlyInput1" class="form-label">Mô tả ngắn</label>
                                    <input name="desc" type="text" class="form-control" id="desc"
                                           value="{{ old('desc',  isset($query) ? $query->desc : '') }}"
                                           pattern="^.{2,255}$"
                                           placeholder="Mô tả ........" required>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">Trạng thái hiển thị</label>
                                    <select class="form-select" id="exampleFormControlSelect1"
                                            aria-label="Default select example" name="status">
                                        <option selected>Chọn trạng thái hiển thị</option>
                                        <option value="0" {{@$query && @$query->status === 0 ? "selected" : "" }}>Ẩn</option>
                                        <option value="1" {{@$query && @$query->status === 1 ? "selected" : "" }}>Hiển thị</option>
                                    </select>
                                    <div class="mb-3">
                                        <label for="exampleDataList" class="form-label">Ảnh khuyến mãi</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input class="form-control image" type="file"
                                                       {{ !isset($query) ? 'required' : '' }}
                                                       name="image">
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                @if(!isset($query))
                                                    <div class="form-text">Ảnh không được để trống. Kích thước không quá
                                                        2Mb
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <img id="imageUser-Edit" class="previewImg"
                                                         src="{{ isset($query) ? asset($query->link_image) : '' }}"
                                                         style="width: 100%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 text-center">
                                        <button class="btn btn-primary" type="submit">Lưu thay đổi</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
