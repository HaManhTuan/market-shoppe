@extends('layouts.admin.admin')
@section('content')
<link rel="stylesheet" href="{{ asset('public/frontend/css-custom/dropify.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/assets/vendor/datatables/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/assets/vendor/datatables/css/buttons.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/assets/vendor/datatables/css/select.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/assets/vendor/datatables/css/fixedHeader.bootstrap4.css')}}">
<style>
    .error{
        color: brown;
        font-size: 14px;
        padding: 5px;
    }
</style>
<script src="{{ asset('public/admin/assets/js/plugins/notify.js')}}"></script>
@if(Session::has('flash_message_success'))
<script>
  $(document).ready(function() {
      $(".breadcrumb").notify("{{ Session::get('flash_message_success') }}", "success");
  });
</script>
 @endif
 @if(Session::has('flash_message_error'))
<script>
  $(document).ready(function() {
      $(".breadcrumb").notify("{{ Session::get('flash_message_error') }}", "error");
  });
</script>
 @endif
<style>
    .rd-add:hover{
        cursor: pointer;
    }
    .custom-load{
        display: none;
        float: right;
        margin: 0px 8px;
        border: 3px solid transparent;
        border-top: 3px solid #5969ff;
        border-left: 3px solid #5969ff;
        -webkit-animation: 1s spin linear infinite;
        animation: 2s spin linear infinite;
    }
    .spinner-custom{
        width: 26px;
        height: 26px
    }
</style>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Danh sách sản phẩm
            </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Sản phẩm</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                @can('add_product')
                <div class="card-header"><span class="badge badge-primary rd-add" style="padding: 8px 15px;"
                    ><i class="mdi mdi-plus" ></i> Thêm mới</span>
                    <span class="dashboard-spinner spinner-custom custom-load"></span>
                </div>
                @endcan
            </div>
            <div class="card-body">
                @if ($products->count() > 0)
                <table class="table table-striped table-bordered" id="table-product">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col" style="width: 200px;">Ảnh đại diện</th>
                                <th scope="col" class="text-center">Danh mục</th>
                                <th scope="col" style="text-align:center">SL </th>
                                <th style="width: 200px;">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $stt = 1;
                            @endphp
                            @foreach ($products as $record)
                                <tr class="tr-item" id="tr-item-{{$record->id}}">
                                    <td>{{ $stt++ }}</td>
                                    <td>
                                        {{ $record->name}} <br>
                                        =========================
                                        <p class="">Giá: <span class="text-danger">{{ number_format($record->price) }}</span> VNĐ</p>
                                        @if ($record->promotional_price > 0)  
                                         <p class="">Giá KM: <span class="text-success">{{ number_format($record->promotional_price) }}</span> VNĐ</p>
                                         <p class="">Sale: <span class="text-success">{{ ($record->sale) }}</span> %</p>
                                        @endif
                                         ========================= 
                                        <p>Người tạo: {{ $record->user->name }}</p>
                                        ========================= <br>
                                        <p>Ngày tạo: {{ $record->created_at }}</p> 
                                        ========================= <br>
                                        <p>Ngày nhập hàng: {{ $record->updated_at }}</p> 
                                    </td>
                                    <td><img src="{{ asset('public/uploads/images/products/'.$record->image) }}" style="max-width: 100%;"></td>
                                    <td>
                                        {{ $record->category->name }}
                                    </td>
                                    <td>{{ $record->stock }}</td>
                                    <td>
                                        @can('edit_product')
                                        <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Thêm ảnh" onclick="window.location.href='{{ url('admin/product/add-image/'.$record->url) }}'"><i class="fa fa-image"></i></button>
                                        <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Sửa sản phẩm" onclick="window.location.href='{{ url('admin/product/edit-pro/'.$record->url) }}'"><i class="fa fa-pencil-alt"></i></button>
                                        @endcan
                                        @can('delete_product')
                                        <button class="btn btn-danger btn-del" data-id="{{ $record->id }}" data-toggle="tooltip" data-placement="top" title="Xóa sản phẩm"><i class="fa fa-trash-alt"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                 <p align="center" style="font-weight:bold">Không có dữ liệu</p>   
                @endif
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/admin/assets/js/js-custom/myjs.js') }}"></script>
<script src="{{ asset('public/admin/assets/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('public/admin/assets/vendor/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('public/admin/assets/vendor/datatables/js/data-table.js')}}"></script>
<script>
  $('#table-product').DataTable({
    "columnDefs": [
        { "orderable": false, "targets": 0 },
        { "orderable": false, "targets": 2 },
        { "orderable": false, "targets": 5 }
        ],
      "order": [],
  });
</script>
<script src="{{ asset('public/admin/assets/js/plugins/sweetalert2.all.js')}}"></script>
<script>
    $(document).on('click', '.btn-del', function () {
        let id = $(this).attr('data-id');
        Swal({
            title: 'Xác nhận xóa?',
            type: 'error',
            html: '<p>Bạn sắp xóa 1 sản phẩm.</p><p>Bạn có chắn chắn muốn xóa?</p>',
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
                    url: '{{ url('admin/product/delete-pro') }}',
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
                                if ($("#table-product .tr-item").length == 0) {
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