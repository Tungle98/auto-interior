@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
        {{--            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>--}}

        <!-- Basic Bootstrap Table -->
            <div class="card">

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-header">Danh sách nhãn hàng</h5>
                    </div>
                    <div class="col-md-6 " style="text-align: right; margin-top: 20px">
                        <button
                            type="button"
                            class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#modalCenter">
                            Nhãn hàng +
                        </button>

                    </div>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table table-index" id="tableList">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tiêu đề</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                    </table>
                    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCenterTitle">Tạo nhãn hàng mới</h5>
                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{route('cms.brand.store')}}" id="formData">
                                        @csrf
                                        <input type="hidden" name="property_id" id="property_id">
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="name" class="form-label">Tên nhãn hàng</label>
                                                <input
                                                    name="name"
                                                    type="text"
                                                    id="name"
                                                    class="form-control"
                                                    placeholder="Enter Name" required/>
                                            </div>
                                        </div>

                                        <div class="col mb-3">
                                            <label for="desc" class="form-label">Mô tả</label>
                                            <input
                                                name="desc"
                                                type="text"
                                                id="desc"
                                                class="form-control"
                                                placeholder="Mô tả nhãn hàng" required/>
                                        </div>
                                        <div class="col mb-3">
                                            <label for="emailWithTitle" class="form-label">Trạng thái hiển thị</label>
                                            <select class="form-select" id="status"
                                                    aria-label="Default select example" name="status" required>
                                                <option selected>Chọn trạng thái</option>
                                                <option value="0">Ẩn</option>
                                                <option value="1">Hiển thị</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="close-btn" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">
                                                Đóng
                                            </button>
                                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')

    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#tableList').DataTable({
                dom: "Bfrtip",
                processing: true,
                serverSide: true,
                ajax: "{{ route('cms.brand.index') }}",
                language: {
                    search: 'Nhập từ cần tìm',
                    lengthMenu: "Hiện thị _MENU_  kết quả",
                    info: "Hiển thị từ _START_ đến _END_ của _TOTAL_ kết quả",
                    paginate: {first: "Premier", previous: "Trang trước", next: "Trang sau", last: "Dernier"},
                    emptyTable: 'Không có dữ liệu'
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', searchable: false},
                ],
                columnDefs: [{
                    "defaultContent": "",
                    "targets": "_all"
                }]
            });
            $('body').on('click', '.deleteProperty', function () {

                var data_id = $(this).data("id");
                if (confirm("Bạn có chắc chắn muốn xóa bản ghi này !") == true) {
                    // alert("Now deleting");
                    $.ajax({
                        type: "POST",
                        url: "{{ url('cms/brand/delete') }}" + '/' + data_id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            table.draw();
                            toastr.success('Xóa thành công bản ghi!')
                        },
                        error: function (data) {
                            toastr.error('Có lỗi xảy ra')
                            console.log('Error:', data);
                        }
                    });
                    return true;
                } else {
                    console.log('cancel delete')
                    return false;
                }

            });
            $('body').on('click', '.editProperty', function () {
                var property_id = $(this).data('id');
                $.get("{{ route('cms.brand.index') }}" + '/' + property_id + '/edit', function (data) {
                    $('#modelHeading').html("Cập nhật thông tin config");
                    $('#saveBtn').val("edit-property");
                    $('#modalCenter').modal('show');
                    $('#property_id').val(data.id);
                    $('#name').val(data.name);
                    $('#status').val(data.status);
                    $('#desc').val(data.desc);
                })
            });
            document.getElementById("close-btn").addEventListener("click", function(){
                document.getElementById("formData").reset();
            });
            $('div.alert').delay(5000).slideUp(300);
        });


    </script>

@endpush
