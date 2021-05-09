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
                    <h4>Cấu hình gửi mail</h4>
                    <span></span>
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
                    <li class="breadcrumb-item"><a href="#!">Cấu hình</a>
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
                    <form action="">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gửi mail khi đặt hàng</label>
                                <div class="col-sm-6">
                                    <input type="checkbox" class="email-cart" {{ $email->is_send_mail_cart == 1 ? 'checked' : '' }}  name="is_send_mail_cart"  data-toggle="toggle" data-onstyle="success" data-size="xs">
                                </div>
                        </div>
                        {{-- <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gửi mail khi sản phẩm sắp hết hàng</label>
                                <div class="col-sm-6">
                                    <input type="checkbox" class="email-product" {{ $email->is_send_mail_product_expried == 1 ? 'checked' : '' }}  name="is_send_mail_product_expried"  data-toggle="toggle" data-onstyle="success" data-size="xs">
                                </div>
                        </div> --}}
                    </form>
                </div>
            </div>
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
    .dropify-wrapper{
        height: 100px !important;
    }
</style>
<script>

    $(document).ready(function () {
        $("input[checkbox]").each(function(){
            $(this).bootstrapToggle('state', $(this).prop('checked'));
        });
        $(document).on("change", ".email-cart", function() {
            $.ajax({
                    url: "{{ route('manager.email.mailCart') }}",
                    type: 'POST',
                    data: { mailCart:  $(this).prop('checked')  },
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
        $(document).on("change", ".email-product", function() {
            $.ajax({
                    url: "{{ route('manager.email.mailPro') }}",
                    type: 'POST',
                    data: { mailPro:  $(this).prop('checked')  },
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
