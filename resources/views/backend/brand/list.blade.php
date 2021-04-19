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
            <h2 class="pageheader-title">Danh sách thương hiệu
            </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Thương hiệu</a></li>
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
                @can('add_blog')
                <div class="card-header"><span class="badge badge-primary rd-add" style="padding: 8px 15px;"
                    ><i class="mdi mdi-plus" ></i> Thêm mới</span>
                    <span class="dashboard-spinner spinner-custom custom-load"></span>
                </div>
                @endcan
            </div>
            <div class="card-body">
                @if ($dataBrand->count() > 0)
                <table class="table table-striped table-bordered" id="brand-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên thương hiệu</th>
                                <th scope="col" style="width: 200px;">Ảnh đại diện</th>
                               
                                <th style="width: 200px;">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $stt = 1;
                            @endphp
                            @foreach ($dataBrand as $element)
                                <tr class="tr-item" id="tr-item-{{ $element->id}}">
                                    <td>{{$stt++}}</td>
                                    <td>{{$element->name}}</td>
                                    <td><img src="{{ asset('public/uploads/images/brand/'.$element->icon) }}" height="200"></td>
                                    <td>
                                        @can('edit_blog')
                                        <button class="btn btn-primary" onclick="window.location.href='{{ url('admin/brand/edit-brand/'.$element->id) }}'" data-toggle="tooltip" data-placement="top" title="Sửa thương hiệu">Sửa</button>
                                        @endcan
                                        @can('delete_blog')
                                        <button class="btn btn-danger btn-del" data-id="{{ $element->id }}" data-toggle="tooltip" data-placement="top" title="Xóa thương hiệu">Xóa</button>
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
  $('#table-blog').DataTable({
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
            html: '<p>Bạn sắp xóa 1 tin tức.</p><p>Bạn có chắn chắn muốn xóa?</p>',
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
                    url: '{{ url('admin/brand/delete-brand') }}',
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
                                if ($("#brand-table .tr-item").length == 0) {
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