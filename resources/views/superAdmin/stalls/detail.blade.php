@extends('layouts.superAdmin.app')
@section('content')
    <!-- sweet alert framework -->
    <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/bower_components/sweetalert/css/sweetalert.css') }}">
<!-- Notification.css -->
<link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/assets/pages/notification/notification.css') }}">
  <!-- animation nifty modal window effects css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/assets/css/component.css') }}">
     <!-- Switch component css -->
     <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/bower_components/switchery/css/switchery.min.css') }}">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Quản lý khách hàng đăng kí gian hàng</h4>
                    <span>Thông tin khách hàng đăng kí gian</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('manager.dashboard') }}">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Gian hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <div class="row">
                            <div class="col-md-4">
                                <form action="{{route('manager.stalls.changeInfo')}}" method="POST" id="frm-change-info" onsubmit="return false;">
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                    <table class="table table-border">
                                        <tr>
                                            <td>Tên hiện thị:</td>
                                            <td>
                                                <input type="text" name="name_display" value="{{$user->name_display}}" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Họ tên:</td>
                                            <td>
                                                <input type="text" name="name" value="{{$user->name}}" class="form-control" data-rule-required="true" data-msg-required="Vui lòng nhập tên">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td>
                                                <input type="text" name="email" value="{{$user->email}}" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Số điện thoại:</td>
                                            <td>
                                                <input type="text" name="phone" value="{{$user->phone}}" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Địa chỉ:</td>
                                            <td>
                                                <input type="text" name="address" value="{{$user->address}}" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Thông tin:</td>
                                            <td>
                                                <textarea name="description" class="form-control" cols="30" rows="10">{!! $user->description!!}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="box-b" style="text-align: center">
                                                    <button type="submit" class="btn btn-primary" id ="btn-change-info">Thay đổi</button>
                                                    <button type="button" class="btn {{$user->admin == 1 ? 'btn-success' : 'btn-danger' }}" id="btn-change-status" data-id="{{$user->id}}"
                                                        > {{$user->admin == 1 ? 'Đã kích hoạt' : 'Chưa kích hoạt' }} </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>

                            <div class="col-md-8">

                                @if ($products && count($products) > 0)
                                    <button class="btn btn-primary" id="btn-turn-on-all" data-id="{{$user->id}}">Kích hoạt tất cả</button>
                                    <button class="btn btn-danger" id="btn-turn-off-all" data-id="{{$user->id}}">Dừng kích hoạt tất cả</button>
                                @endif
                                <table id="tablePro" class="table table-striped table-bordered" style="margin-top: 5px">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="text-align:center">TT </th>
                                            <th scope="col">Tên sản phẩm</th>
                                            <th scope="col" style="width: 200px;">Ảnh đại diện</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col">TT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($products)
                                        @php
                                        $stt = 1;
                                        @endphp
                                        @foreach ($products as $key => $record)
                                            <tr class="tr-item" id="tr-item-{{$record->id}}">
                                                <td>
                                                    {{ $key + 1}}
                                                </td>
                                                <td>
                                                    {{ $record->name}}
                                                </td>
                                                <td><img src="{{ asset('uploads/images/products/'.$record->image) }}" style="max-width: 50%;"></td>
                                                <td>
                                                    <p class="">Giá: <span class="text-danger">{{ number_format($record->price) }}</span> đ</p>
                                                    @if ($record->promotional_price > 0)
                                                    <p class="">Giá KM: <span class="text-success">{{ number_format($record->promotional_price) }}</span> đ</p>
                                                    <p class="">Sale: <span class="text-success">{{ ($record->sale) }}</span> %</p>
                                                    @endif
                                                    <p class="">Số  lượng: <span class="text-danger">{{ $record->stock }}</span></p>
                                                </td>
                                                <td>
                                                    <div class="box-status" style="margin-bottom: 3px;">
                                                        <input type="checkbox" class="status-web" checked data-id={{ $record->id }} name="status" data-toggle="toggle" data-onstyle="success"  style="width: 70%;display: inline-block;" data-size="xs">
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .dataTables_wrapper {
        margin-top: 15px;
    }
</style>
<script src="{{ asset('frontend/assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/notify.js') }}"></script>
<script>
    function notify(from, align, type, message){
        $.growl({
            title: '',
            message: message,
            url: ''
        },{
            element: 'body',
            type: type,
            allow_dismiss: true,
            placement: {
                from: from,
                align: align
            },
            offset: {
                x: 30,
                y: 60
            },
            spacing: 10,
            z_index: 999999,
            delay: 2500,
            timer: 1000,
            url_target: '_blank',
            mouse_over: false,
            icon_type: 'class',
            template: '<div data-growl="container" class="alert" role="alert">' +
            '<button type="button" class="close" data-growl="dismiss">' +
            '<span aria-hidden="true">&times;</span>' +
            '<span class="sr-only">Close</span>' +
            '</button>' +
            '<span data-growl="icon"></span>' +
            '<span data-growl="title"></span>' +
            '<span data-growl="message"></span>' +
            '<a href="#" data-growl="url"></a>' +
            '</div>'
        });
    };
    $(document).on("click", "#btn-change-status", function() {
        console.log($(this).data('id'))
        let id = $(this).data('id');
        $.ajax({
            url: "{{route('manager.stalls.changeStatus')}}",
            type: 'POST',
            data: {id: id},
            dataType: 'JSON',
            headers: {
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            },
            success: function(data) {
                console.log(data);
                if (data.status == '_success') {
                    window.location.reload();
                } else {
                    window.location.reload();
                }
            },
            error: function(err) {
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
    })
    $(document).on('click', '#btn-change-info', function() {
        $("#frm-change-info").validate({
         submitHandler: function() {
            let action = $("#frm-change-info").attr('action');
            let method = $("#frm-change-info").attr('method');
            let formData = $("#frm-change-info").serialize();
            $.ajax({
              url: action,
              type: method,
              dataType: 'JSON',
              data: formData,
              headers: {
               'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
              },
              success: function(data){
               if (data.status == '_success') {
                notify('top', 'right', 'success', data.msg);
               }
               else{
                notify('top', 'right', 'error', data.msg);
               }
              },
              error:function(error){
               console.log(error);
              }
            });
         }
        });
    });
    $(document).on('click', '#btn-turn-on-all', function() {
        let id = $(this).data('id');
        $.ajax({
          url: "{{route('manager.stalls.changeAllStatusOnProduct')}}",
          type: "POST",
          dataType: 'JSON',
          data: {id: id},
          headers: {
           'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
          },
          success: function(data){
           if (data.status == '_success') {
            $(".status-web").each(function(key, val){
                $(this).bootstrapToggle('on');
            })
            notify('top', 'right', 'success', data.msg);
           }
           else{
            notify('top', 'right', 'error', data.msg);
           }
          },
          error:function(error){
           console.log(error);
          }
        });
    });
    $(document).on('click', '#btn-turn-off-all', function() {
            let id = $(this).data('id');
            $.ajax({
              url: "{{route('manager.stalls.changeAllStatusOffProduct')}}",
              type: "POST",
              dataType: 'JSON',
              data: {id: id},
              headers: {
               'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
              },
              success: function(data){
               if (data.status == '_success') {
                $(".status-web").each(function(key, val){
                    $(this).bootstrapToggle('off');
                })
                notify('top', 'right', 'success', data.msg);
               }
               else{
                notify('top', 'right', 'error', data.msg);
               }
              },
              error:function(error){
               console.log(error);
              }
            });
    });
    $(document).ready(function () {
        $(".status-web").each(function(key, val){
            if($(this).prop('checked')) {
                $(val).bootstrapToggle('on');
            } else {
                $(val).bootstrapToggle('off');
            }
        });
        $('#tablePro').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "order": [],
            "columnDefs": [ {
            "targets"  : [2],
            "orderable": false,
            }],
            "language": {
                "lengthMenu": "Hiển thị _MENU_ bản ghi",
                "zeroRecords": "Không tìm thấy - sorry",
                "info": "Hiển thị _PAGE_ of _PAGES_",
                "infoEmpty": "Khồn có kết quả",
                "infoFiltered": "(đang lọc từ _MAX_ tổng số bản ghi)",
                "search": "Tìm kiếm:",
                "paginate": {
                    "previous": "Trước",
                    "next": "Sau",
                }
            },
            "fnDrawCallback": function( oSettings ) {
                $('.status-web').bootstrapToggle();
            }
        });
        $(document).on("change", ".status-web", function() {
            let id = $(this).data('id')
            $.ajax({
                    url: "{{ route('manager.stalls.changeStatusOne') }}",
                    type: 'POST',
                    data: { id: id, status:  $(this).prop('checked')  },
                    dataType: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                    },
                    success: function(data) {
                        if (data.status == '_success') {
                            notify('top', 'right', 'success', data.msg);
                        } else {
                            notify('top', 'right', 'error', data.msg);
                        }
                    },
                    error: function(err) {
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
        })
    })
</script>
@endsection
