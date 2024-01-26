



@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
        {{--            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>--}}

        <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header">Danh sách khách hàng phản hồi</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-index"  id="tableList">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Content</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                    </table>
                </div>
            </div></div>
    </div>

@endsection
@push('scripts')

    <script >
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
                ajax: "{{ route('cms.customer-request.index') }}",
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
                    {data: 'phone', name: 'phone'},
                    {data: 'email', name: 'email'},
                    {data: 'content', name: 'content'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', searchable: false},
                ],
                columnDefs:[{
                    "defaultContent": "",
                    "targets": "_all"
                }]
            });
        });
        {{--$('body').on('click', '.editProperty', function () {--}}
        {{--    var property_id = $(this).data('id');--}}
        {{--    $.get("{{ route('cms.customer-register.index') }}" + '/' + property_id + '/edit', function (data) {--}}
        {{--        $('#modelHeading').html("Xác nhận xử lý");--}}
        {{--        $('#saveBtn').val("edit-property");--}}
        {{--        $('#ajaxModel').modal('show');--}}
        {{--        $('#property_id').val(data.id);--}}
        {{--        // $('#status').val(data.status);--}}
        {{--    })--}}
        {{--});--}}
        $('div.alert').delay(5000).slideUp(300);
    </script>

@endpush
