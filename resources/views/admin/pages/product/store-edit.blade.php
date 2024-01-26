@extends('admin.layouts.main')

@section('title', isset($query) ? 'Chỉnh sửa sản phẩm' : 'Tạo sản phẩm mới')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            @include('admin.pages.component.alert-error')
            <div class="row">

                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header"> {{ isset($query) ? 'Chỉnh sửa sản phẩm ' : 'Tạo sản phẩm mới' }}</h5>
                        <div class="card-body">
                            <form class="row g-3 needs-validation" novalidate
                                  @if(isset($query))
                                  action="{{ route('cms.product.update', $query->id) }}"
                                  @else
                                  action="{{ route('cms.product.store') }}"
                                  @endif
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Tên sản phẩm </label>
                                        <input name="name" type="text" class="form-control" id="name"
                                               value="{{ old('name',  isset($query) ? $query->name : '') }}"
                                               pattern="^.{2,255}$"
                                               placeholder="Tên sản phẩm........" required>
                                        {{--                                        <div class="form-text">Tên Golfer không được để trống. 2-255 ký tự</div>--}}
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="exampleFormControlReadOnlyInput1" class="form-label">Mô tả
                                            ngắn</label>
                                        <textarea name="desc" class="form-control" id="description"
                                                  required minlength="10"
                                                  placeholder="Mô tả ...">{{ old('desc',  isset($query) ? $query->desc : '') }}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Giá sản phẩm </label>
                                        {{--                                        <input name="price" type="number" class="form-control" id="price"--}}
                                        {{--                                               value="{{ old('price',  isset($query) ? $query->price : '') }}"--}}
                                        {{--                                               pattern="^.{2,255}$"--}}
                                        {{--                                               placeholder="Giá sản phẩm........" required onkeyup="oneDot(this)">--}}
                                        <input type="text" name="price" class="form-control"
                                               id="currency-field"
                                               pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$"
                                               value="{{ old('price',  isset($query) ? $query->price : '') }}"
                                               data-type="currency"
                                               placeholder="" required>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="exampleFormControlTextarea1" class="form-label">Giá khuyến
                                            mãi</label>
                                        <input type="text" name="price_discount" class="form-control"
                                               id="currency-field"
                                               pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$"
                                               value="{{ old('price_discount',  isset($query) ? $query->price_discount : '') }}"
                                               data-type="currency"
                                               placeholder="" required>
{{--                                        <input name="price_discount" type="number" class="form-control"--}}
{{--                                               id="price_discount"--}}
{{--                                               value="{{ old('price_discount',  isset($query) ? $query->price_discount : '') }}"--}}
{{--                                               pattern="^.{2,255}$"--}}
{{--                                               placeholder="Giá khuyến mãi sản phẩm........" onkeyup="oneDot(this)">--}}
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="exampleFormControlSelect1" class="form-label">Trạng thái hiển
                                            thị</label>
                                        <select class="form-select" id="status"
                                                aria-label="Default select example" name="status">
                                            <option selected>Chọn trạng thái hiển thị</option>
                                            <option value="0" {{@$query && @$query->status === 0 ? "selected" : "" }}>
                                                Ẩn
                                            </option>
                                            <option value="1" {{@$query && @$query->status === 1 ? "selected" : "" }}>
                                                Hiển thị
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="exampleFormControlSelect1" class="form-label">Danh mục sản
                                            phẩm</label>
                                        <select class="form-select" id="exampleFormControlSelect1"
                                                aria-label="Default select example" name="category_id">
                                            <option selected>Chọn danh mục</option>
                                            @foreach($categories as $item)
                                                <option
                                                    @if(isset($query) && $query->category_id == $item->id)
                                                    selected
                                                    @endif
                                                    value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="exampleFormControlSelect1" class="form-label">Nhãn hiệu sản
                                            phẩm</label>
                                        <select class="form-select" id="exampleFormControlSelect1"
                                                aria-label="Default select example" name="brand_id">
                                            <option selected>Chọn nhãn hiệu</option>
                                            @foreach($brands as $item)
                                                <option
                                                    @if(isset($query) && $query->brand_id == $item->id)
                                                    selected
                                                    @endif
                                                    value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
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
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Chi tiết sản
                                        phẩm</label>
                                    <textarea name="content" class="form-control" id="content"
                                              required minlength="10"
                                              placeholder="Mô tả ...">{{ old('content',  isset($query) ? $query->content : '') }}</textarea>
                                </div>
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary" type="submit">Lưu sản phẩm</button>
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
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

        function oneDot(input) {
            var value = input.value,
                value = value.split('.').join('');

            if (value.length > 3) {
                value = value.substring(0, value.length - 3) + '.' + value.substring(value.length - 3, value.length);
            }

            input.value = value;
        }

        $("input[data-type='currency']").on({
            keyup: function () {
                formatCurrency($(this));
            },
            blur: function () {
                formatCurrency($(this), "blur");
            }
        });


        function formatNumber(n) {
            // format number 1000000 to 1,234,567
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }


        function formatCurrency(input, blur) {
            // appends $ to value, validates decimal side
            // and puts cursor back in right position.

            // get input value
            var input_val = input.val();

            // don't validate empty input
            if (input_val === "") {
                return;
            }

            // original length
            var original_len = input_val.length;

            // initial caret position
            var caret_pos = input.prop("selectionStart");

            // check for decimal
            if (input_val.indexOf(".") >= 0) {

                // get position of first decimal
                // this prevents multiple decimals from
                // being entered
                var decimal_pos = input_val.indexOf(".");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                right_side = formatNumber(right_side);

                if (blur === "blur") {
                    right_side += "00";
                }

                right_side = right_side.substring(0, 2);

                input_val = left_side + "." + right_side;

            } else {
                input_val = formatNumber(input_val);
                input_val = input_val;

                // final formatting
                // if (blur === "blur") {
                //     input_val += ".00";
                // }
            }

            // send updated string to input
            input.val(input_val);

            // put caret back in the right position
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }

        $('div.alert').delay(5000).slideUp(300);
    </script>
@endpush
