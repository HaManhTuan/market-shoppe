@extends('layouts.superAdmin.app')
@section('content')
<!-- Notification.css -->
<link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/assets/pages/notification/notification.css') }}">
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Thêm thương hiệu</h4>
                    <span>Quản lý thương hiệu của bạn</span>
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
                    <li class="breadcrumb-item"><a href="#!">Thêm thương hiệu</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('manager.brand.addPost') }}" method="POST" class="frm-add">
               @csrf
                <div class="form-group">
                    <label class="col-sm-12 col-form-label">Tên thương hiệu</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="name" value="" data-rule-required="true" data-msg-required="Vui lòng nhập tên thương hiệu.">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-12 col-form-label"></label>
                    <div class="col-sm-8">
                    <button type="submit" class="btn btn-success">Thêm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .error{
        color: red;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('admin/assets/js/plugins/jquery.validate.min.js')}}"></script>
 <!-- notification js -->
 <script type="text/javascript" src="{{ asset('superAdmin/assets/js/bootstrap-growl.min.js') }}"></script>
 <script type="text/javascript" src="{{ asset('superAdmin/assets/pages/notification/notification.js') }}"></script>
<script>
    $(document).ready(function() {
        $(".frm-add").validate({
            submitHandler: function(form) {
                form.submit();
            }
        });
    })
</script>
@if ($errors->any()))
<script>
    $(window).on('load',function(){
        function notify(from, align, icon, type, animIn, animOut){
        $.growl({
            icon: icon,
            title: '',
            message: "Thương hiệu này đã tồn tại",
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
@endsection
