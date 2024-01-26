@extends('admin.layouts.main')

@section('title', isset($query) ? 'Chỉnh sửa bài viết' : 'Tạo bài viết')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            @include('admin.pages.component.alert-error')
            <div class="row">

                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header"> {{ isset($query) ? 'Chỉnh sửa bài viết' : 'Tạo bài viết' }}</h5>
                        <div class="card-body">
                            <form class="row g-3 needs-validation" novalidate
                                  @if(isset($query))
                                  action="{{ route('cms.blog.update', $query->id) }}"
                                  @else
                                  action="{{ route('cms.blog.store') }}"
                                  @endif
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Tiêu đề bài viết</label>
                                    <input name="title" type="text" class="form-control" id="title"
                                           value="{{ old('title',  isset($query) ? $query->title : '') }}"
                                           pattern="^.{2,255}$"
                                           placeholder="Tiêu đề bài viết........" required>
                                    <div class="form-text">Tên Golfer không được để trống. 2-255 ký tự</div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlReadOnlyInput1" class="form-label">Mô tả ngắn</label>
                                    <input name="desc" type="text" class="form-control" id="desc"
                                           value="{{ old('desc',  isset($query) ? $query->desc : '') }}"
                                           pattern="^.{2,255}$"
                                           placeholder="Mô tả bài viết........" required>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">Trạng thái hiển thị</label>
                                    <select class="form-select" id="exampleFormControlSelect1"
                                            aria-label="Chọn trạng thái hiển thị" name="status" required>
                                        <option selected>Chọn trạng thái hiển thị</option>
                                        <option value="0" {{@$query && @$query->status === 0 ? "selected" : "" }}>Ẩn</option>
                                        <option value="1" {{@$query && @$query->status === 1 ? "selected" : "" }}>Hiển thị</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">Bài viết nổi bật</label>
                                    <select class="form-select" id="exampleFormControlSelect1"
                                            aria-label="Default select example" name="is_top" required>
                                        <option selected>Chọn  bài viết nổi bật</option>
                                        <option value="0" {{@$query && @$query->is_top === 0 ? "selected" : "" }}>Bình thường</option>
                                        <option value="1" {{@$query && @$query->is_top === 1 ? "selected" : "" }}>Nổi bật</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleDataList" class="form-label">Ảnh bài viết</label>
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

                                <div>
                                    <label for="exampleFormControlTextarea1" class="form-label">Nôi dung bài viết</label>
                                    <textarea name="content" class="form-control" id="content"
                                              required minlength="10"
                                              placeholder="Mô tả ...">{{ old('content',  isset($query) ? $query->content : '') }}</textarea>
                                </div>
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary" type="submit">Lưu bài viết</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@push('scripts')
    <script type="text/javascript">
        ClassicEditor
            .create( document.querySelector( '#content' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush
