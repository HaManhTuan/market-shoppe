@extends('layouts.admin.admin')
@section('content')
<link rel="stylesheet" href="{{ asset('public/frontend/css-custom/dropify.min.css') }}">
<style>
    .error {
        color: brown;
        font-size: 14px;
        padding: 5px;
    }

    .font-16 {
        font-size: 16px;
    }

</style>
<link rel="stylesheet" href="{{ asset('public/admin/assets/css/bootstrap-4.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/assets/css/animate.css') }}">
<script src="{{ asset('public/admin/assets/js/plugins/notify.js')}}"></script>
@if(Session::has('flash_message_success'))
<script>
    $(document).ready(function () {
        $(".breadcrumb").notify("{{ Session::get('flash_message_success') }}", "success");
    });

</script>
@endif
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Danh sách ảnh sản phẩm
            </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Ảnh sản phẩm</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
        <div class="card">
            <div class="card-header">
                <h3>Thông tin sản phẩm</h3>
            </div>
            <div class="card-body">
                <h5> Tên sản phẩm: {{  $product_detail->name }}</h5>
                <h5> Danh mục: {{  $product_detail->category->name }}</h5>
                <h5> Người tạo: {{  $product_detail->user->name }}</h5>
                <h5> Ngày tạo: {{  $product_detail->created_at }}</h5>
                <h5> Số lượng: {{  $product_detail->stock }}</h5>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
        <div class="card">
            <div class="card-header">
                <h3>Thêm ảnh sản phẩm kèm theo</h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/product/add-image/'.$product_detail->url) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product_detail->id }}">
                    <div class="form-group">
                        <label for="my-input">Ảnh sản phẩm</label>
                        <input id="file" class="form-control" type="file" name="file[]" multiple>
                    </div>
                    <button type="submit" class="btn btn-success">Thêm</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h3>Ảnh kèm theo</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th>Ảnh</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $stt = 1;
                        @endphp
                        @foreach ($product_img as $item)
                        <tr>
                            <td scope="row">{{ $stt++ }}</td>
                            <td><img src="{{ asset('public/uploads/images/products/'.$item->img) }}" height="200"></td>
                            <td>

                                <button data-id="{{$item->id}}" class="btn btn-danger btn-del" role="button"><i
                                        class="fa fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="{{ asset('public/admin/assets/js/plugins/sweetalert2.all.js')}}"></script>
    <script>
        $(document).on('click', '.btn-del', function () {
            let id = $(this).attr('data-id');
            Swal({
                title: 'Xác nhận xóa?',
                type: 'error',
                html: '<p>Bạn sắp xóa 1 ảnh.</p><p>Bạn có chắn chắn muốn xóa?</p>',
                showConfirmButton: true,
                confirmButtonText: '<i class="ti-check" style="margin-right:5px"></i>Đồng ý',
                confirmButtonColor: '#ef5350',
                cancelButtonText: '<i class="ti-close" style="margin-right:5px"></i> Hủy bỏ',
                showCancelButton: true,
                focusConfirm: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value == true) {
                    $.ajax({
                        url: '{{ url('admin/product/delete-img') }}',
                        type: 'POST',
                        data: {
                            id: id,
                            length: '1'
                        },
                        dataType: 'JSON',
                        headers: {
                            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                        },
                        success: function (data) {
                            //console.log(data);
                            if (data.status == '_success') {
                                Swal({
                                    title: data.msg,
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    type: 'success',
                                    timer: 2000
                                }).then(() => {
                                    $("#tr-item-" + id).remove();
                                    if ($("#img-table .tr-item").length == 0) {
                                        location.reload();
                                    }
                                });
                            } else {
                                Swal({
                                    title: data.msg,
                                    showCancelButton: false,
                                    showConfirmButton: true,
                                    confirmButtonText: 'OK',
                                    type: 'error'
                                });
                            }
                        },
                        error: function (err) {
                            console.log(err);
                            Swal({
                                title: 'Error ' + err.status,
                                text: err.responseText,
                                showCancelButton: false,
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                type: 'error'
                            });
                        }
                    });
                }
                return false;
            });
            return false;
        });
    </script>
@endsection
