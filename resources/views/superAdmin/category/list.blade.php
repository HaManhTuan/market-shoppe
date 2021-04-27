@extends('layouts.superAdmin.app')
@section('content')

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
                    <h4>Danh mục sản phẩm</h4>
                    <span>Quản lý danh mục sản phẩm của bạn</span>
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
                    <li class="breadcrumb-item"><a href="#!">Danh mục</a>
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
                <div class="btn-add">
                    <button type="button" class="btn btn-warning waves-effect" data-toggle="modal" data-target="#default-Modal">Thêm mới</button>
                </div>

                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="simpletable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th style="width:20px;">STT</th>
                                <th>Tên danh mục</th>
                                <th>Danh mục cha</th>
                                <th>Trạng thái</th>
                                <th style="width:110px;">###</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if (count($cate) > 0)
                                @foreach ($cate as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @if ($item->parent)
                                            {{ $item->parent->name }}
                                            @else
                                                Là danh mục gốc
                                            @endif</td>
                                        <td>
                                            <div class="box-status" style="margin-bottom: 3px;">
                                                <div class="label-name" style="width: 35%;display: inline-block;">Web:</div>
                                                <input type="checkbox" class="status-web" {{ $item->status == 1 ? 'checked' : '' }}  data-id={{ $item->id }} name="status_update_web"  data-toggle="toggle" data-onstyle="success"  style="width: 70%;display: inline-block;" data-size="xs">
                                            </div>
                                            <div class="box-status-cus">
                                                <div class="label-name" style="width: 35%;display: inline-block;">Customer:</div>
                                                <input type="checkbox" class="status-customer" {{ $item->status_cus == 1 ? 'checked' : '' }} data-id={{ $item->id }} name="status_update_cus" data-toggle="toggle" data-onstyle="danger" style="width: 70%;display: inline-block;" data-size="xs">

                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary waves-effect"
                                            onclick="location.href='{{ route('manager.category.edit', ['id' => $item->id]) }}'"><i class="fa fa-pencil-square-o"></i></button>
                                             <button type="button" class="btn btn-danger waves-effect  btn-del-cate" data-id="{{ $item->id }}"
                                                data-action="{{ route('manager.category.delete') }}"
                                            ><i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Danh mục</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('manager.category.add') }}" method="POST" onsubmit="return false;" class="frm-add" enctype='multipart/form-data'>
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label">Thêm mới danh mục</label>
                        <div class="col-sm-12 select_cate">
                            <select name="parent_id" class="form-control">
                                <option value="0" selected>---Không---</option>
                                @if (count($select_cate) > 0)
                                    @foreach ($select_cate as $item)
                                        <option value="{{ $item->id }}">  {{ $item->name }}</option>
                                            @if(count($item->categories))
                                                @foreach ($item->categories as $child)
                                                 <option value="{{ $child->id }}"> |-- {{ $child->name }}</option>
                                                @endforeach
                                            @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label">Tên danh mục</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="name" data-rule-required="true" data-msg-required="Vui lòng nhập tên danh mục.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label">Mô tả danh mục</label>
                        <div class="col-sm-12">
                            <textarea name="description" class="form-control" cols="30" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label">Ảnh đại diện</label>
                        <div class="col-sm-12">
                            <input type="file" name="file"  id="input-file-now" class="form-control dropify">
                        </div>
                    </div>
                    <div class="form-group border-checkbox-section row">
                        <div class="col-sm-6 col-xl-6 col-form-label">
                            <h4 class="sub-title">Trạng thái</h4>
                            <div class="border-checkbox-group border-checkbox-group-primary">
                                <input class="border-checkbox" type="checkbox" name="status" checked id="checkbox1">
                                <label class="border-checkbox-label"  id="label1" for="checkbox1">Hiện</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-6 border-checkbox-section col-form-label">
                            <h4 class="sub-title">Trạng thái người bán</h4>
                            <div class="border-checkbox-group border-checkbox-group-primary">
                                <input class="border-checkbox" type="checkbox" name="status_cus" checked id="checkbox2">
                                <label class="border-checkbox-label" id="label2" for="checkbox2">Hiện</label>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light ">Lưu</button>
            </div>
        </form>
        </div>
    </div>
</div>
<style>
    .btn-add{
        padding: 20px;
    }
    .btn-add button{
        float: right;
    }
    .error{
        color: red;
    }
    .btn i {
        margin-right: 0px !important;
    }
    .toggle-on.btn-xs{
        margin-top: 5px;
    }
    .toggle-off.btn-xs{
        margin-top: 5px;
    }
    .dropify-wrapper{
        height: 100px !important;
    }
</style>
<script>
    $(document).ready(function () {
        $("input[checkbox].status-web").each(function(){
            $(this).bootstrapToggle('state', $(this).prop('checked'));
        });
        $('#simpletable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "order": [],
            "columnDefs": [ {
            "targets"  : [4],
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
                $('.status-customer').bootstrapToggle();
            }
        });
        $(document).on("change", ".status-web", function() {
            let cate_id = $(this).data('id')
            $.ajax({
                    url: "{{ route('manager.category.updateStatus') }}",
                    type: 'POST',
                    data: { id: cate_id, status_web:  $(this).prop('checked')  },
                    dataType: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.status == '_success') {
                            Swal({
                                title: data.msg,
                                showCancelButton: false,
                                showConfirmButton: false,
                                type: 'success',
                                timer: 2000
                            }).then(() => {
                                //location.reload();
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
        $(document).on("change", ".status-customer", function() {
            let cate_id = $(this).data('id')
            $.ajax({
                    url: "{{ route('manager.category.updateStatusCus') }}",
                    type: 'POST',
                    data: { id: cate_id, status_cus:  $(this).prop('checked')  },
                    dataType: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.status == '_success') {
                            Swal({
                                title: data.msg,
                                showCancelButton: false,
                                showConfirmButton: false,
                                type: 'success',
                                timer: 2000
                            }).then(() => {
                                //location.reload();
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
    });
</script>
@if(Session::has('flash_success'))
<script>
    $(window).on('load',function(){
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

        var nFrom = 'top';
        var nAlign = 'right';
        var nType = 'success';
        var nMess = '{!! Session::get('flash_success') !!}';
        notify(nFrom, nAlign, nType, nMess);
    })
</script>
@endif
@if ($errors->any()))
<script>
    $(window).on('load',function(){
        function notify(from, align, icon, type, animIn, animOut){
        $.growl({
            icon: icon,
            title: '',
            message: "Danh mục này đã tồn tại",
            url: ''
        },{
            element: 'body',
            type: 'danger',
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
            animate: {
                enter: animIn,
                exit: animOut
            },
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

        var nFrom = 'top';
        var nAlign = 'right';
        var nType = 'danger';
        notify(nFrom, nAlign, nType);
    })
</script>
@endif
<script>
        $(document).on("click", ".btn-del-cate", function() {
        let id = $(this).attr('data-id');
        let action = $(this).attr('data-action');
        Swal({
            title: 'Bạn thực sự muốn xóa?',
            type: 'error',
            html: '<p>Nếu xóa !</p><p>Bạn sẽ không thể phục hồi lại?</p>',
            showConfirmButton: true,
            confirmButtonText: '<i class="ti-check" style="margin-right:5px"></i>OK',
            confirmButtonColor: '#ef5350',
            cancelButtonText: '<i class="ti-close" style="margin-right:5px"></i> Hủy',
            showCancelButton: true,
            focusConfirm: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value == true) {
                $.ajax({
                    url: action,
                    type: 'POST',
                    data: { id: id, length: 1 },
                    dataType: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.status == '_success') {
                            Swal({
                                title: data.msg,
                                showCancelButton: false,
                                showConfirmButton: false,
                                type: 'success',
                                timer: 2000
                            }).then(() => {
                                location.reload();
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
            }
            return false;
        });
        return false;
    });
    $(document).ready(function() {
        $(".frm-add").validate({
            submitHandler: function(form) {
                form.submit();
            }
        });
    })

</script>
<script>
    $('.dropify').dropify();
</script>
  <!-- Switch component js -->
  <script type="text/javascript" src="{{ asset('superAdmin/bower_components/switchery/js/switchery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('superAdmin/assets/pages/advance-elements/swithces.js') }}"></script>
@endsection
