@extends('layouts.superAdmin.app')
@section('content')
<!-- Notification.css -->
<link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/assets/pages/notification/notification.css') }}">
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Danh mục sản phẩm</h4>
                    <span>Quản lý danh mục sản phẩm của bạn - {{  $data->name }}</span>
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
                    <li class="breadcrumb-item"><a href="#!">{{  $data->name }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('manager.category.editPost') }}" method="POST" class="frm-edit">
               @csrf
                <input type="hidden" name="id" value="{{ $data->id }}">
                <div class="form-group">
                    <label class="col-md-12 col-form-label">Danh mục</label>
                    <div class="col-md-4">
                        <select name="parent_id" class="form-control">
                            <option value="0" selected>---Không---</option>
                            @if (count($select_cate) > 0)
                            @foreach ($select_cate as $item)
                                <option value="{{ $item->id }}">  {{ $item->name }}</option>
                                    @if(count($item->categories))
                                        @foreach ($item->categories as $child)
                                         <option value="{{ $child->id }}" {{ $data->parent_id == $item->id ? 'selected="selected"':'' }}> |-- {{ $child->name }}</option>
                                        @endforeach
                                    @endif
                            @endforeach
                        @endif
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-12 col-form-label">Tên danh mục</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="name" value="{{ $data->name }}" data-rule-required="true" data-msg-required="Vui lòng nhập tên danh mục.">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-12 col-form-label">Mô tả danh mục</label>
                    <div class="col-sm-8">
                        <textarea name="description" class="form-control" cols="30" rows="4">{{ $data->description }}</textarea>
                    </div>
                </div>
                <div class="form-group border-checkbox-section row">
                    <div class="col-sm-4 col-xl-4 col-form-label">
                        <h4 class="sub-title">Trạng thái Website</h4>
                        <div class="border-checkbox-group border-checkbox-group-primary">
                            <input class="border-checkbox" type="checkbox" {{ $data->status == 1 ? 'checked' : ''}} name="status" id="checkbox1">
                            <label class="border-checkbox-label" id="label1" for="checkbox1">Hiện</label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4 border-checkbox-section col-form-label">
                        <h4 class="sub-title">Trạng thái gian hàng</h4>
                        <div class="border-checkbox-group border-checkbox-group-primary">
                            <input class="border-checkbox" type="checkbox" {{ $data->status_cus == 1 ? 'checked' : ''}} name="status_cus" id="checkbox2">
                            <label class="border-checkbox-label"  id="label2" for="checkbox2">Hiện</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Sửa danh mục</button>
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
        $(".frm-edit").validate({
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
@endsection
