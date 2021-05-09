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
                    <h4>Sản phẩm</h4>
                    <span>Quản lý sản phẩm của bạn</span>
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
                    <li class="breadcrumb-item"><a href="#!">Sản phẩm</a>
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

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .link-company:hover {
        cursor: pointer;
        color: #ef5f51;
    }
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
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "order": [],
            "columnDefs": [ {
            "targets"  : [2, 4],
            "orderable": false,
            }],
            "language": {
                "lengthMenu": "Hiển thị _MENU_ bản ghi",
                "zeroRecords": "Không tìm thấy - sorry",
                "info": "Hiển thị _PAGE_ of _PAGES_",
                "infoEmpty": "Không có kết quả",
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
