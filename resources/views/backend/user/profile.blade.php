@extends('layouts.admin.admin')
@section('content')
<style>
    .error{
        color: brown;
        font-size: 14px;
        padding: 5px;
    }
</style>
<link rel="stylesheet" href="{{ asset('admin/assets/css/animate.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap-4.css') }}">
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h3 class="mb-2">Thông tin tài khoản</h3>
            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản trị</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thông tin tài khoản</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="user-avatar text-center d-block">
                    <img src="{{ asset('admin/assets/images/avatar-1.jpg') }}" alt="User Avatar" class="rounded-circle user-avatar-xxl">
                </div>
                <div class="text-center">
                    <h2 class="font-24 mb-0">{{ $dataUser->name }}</h2>
                    <p>Tên hiện thị: {{ $dataUser->name_display }}</p>
                    <button type="button" name="" id="" class="btn btn-success" data-toggle="modal" data-target="#myModal">Change Password</button>
                </div>
            </div>
            <div class="card-body border-top">
                <h3 class="font-16">Thông tin liên hệ</h3>
                <div class="">
                    <ul class="list-unstyled mb-0">
                    <li class="mb-2"><i class="fas fa-fw fa-envelope mr-2"></i>{{ $dataUser->email }}m</li>
                    <li class="mb-2"><i class="fas fa-fw fa-phone mr-2"></i>{{ $dataUser->phone }}</li>
                    <li class="mb-2"><i class="fas fa-fw fa-child mr-2"></i>{{ $dataUser->born }}</li>
                    <li class="mb-0"><i class="fas fa-fw fa-address-card mr-2"></i>{{ $dataUser->address }}</li>
                </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-lg-9 col-md-7 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h3>Thay đổi thông tin</h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/post-profile')}}" method="POST" id="frm-edit-profile">
                    @csrf
                    <input id="user_id" type="hidden" class="form-control" name="user_id" value="{{ $dataUser->id }}">
                    <div class="form-group">
                        <label for="name" class="col-form-label">Tên hiển thị</label>
                        <input id="name" type="text" class="form-control" name="name_display" value="{{ $dataUser->name_display }}" data-rule-required="true"  data-msg-required="Trường này không đươc để trống">
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Tên</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ $dataUser->name }}" data-rule-required="true"  data-msg-required="Trường này không đươc để trống">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" readonly="" placeholder="name@example.com" class="form-control" value="{{ $dataUser->email }}" data-rule-required="true"  data-msg-required="Trường này không đươc để trống">
                    </div>
                    <div class="form-group">
                        <label for="inpuborntText4" class="col-form-label">Số điện thoại</label>
                        <input id="phone" type="text" name="phone"  class="form-control" placeholder="19001100" value="{{ $dataUser->phone }}" >
                    </div>
                    <div class="form-group">
                        <label for="inpuborntText4" class="col-form-label">Ngày sinh</label>
                        <input id="born" type="date" name="born"  class="form-control" placeholder="10/02/1998" value="{{ $dataUser->born }}" >
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <textarea class="form-control" name="address" id="address" rows="3" data-rule-required="true"  data-msg-required="Trường này không đươc để trống">{{ $dataUser->address  }}</textarea>
                    </div>
                    <button class="btn btn-primary" type="submit" id="edit_profile">Thay đổi</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog animated bounceIn" role="document"  >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Đổi mật khẩu</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></a>
            </div>
            <form action="{{ url('admin/changepassword')}}" method="post" id="change-password-form" class="changepassword" role="form" onsubmit="return false;" enctype='multipart/form-data'>
                @csrf
            <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $dataUser->id }}">
                    <div class="form-group">
                        <label for="new-pwd">Mật khẩu mới</label>
                        <input type="password" id="new-pwd" name="newPwd" class="form-control" placeholder="Nhập mật khẩu mới" data-rule-required="true" data-msg-required="Vui lòng nhập mật khẩu mới" />
                    </div>
                    <div class="form-group">
                        <label for="retype-new-pwd">Nhập lại mật khẩu</label>
                        <input type="password" id="retype-new-pwd" name="retypeNewPwd" class="form-control" placeholder="Nhập lại mật khẩu" data-rule-required="true" data-msg-required="Vui lòng nhập lại mật khẩu" data-rule-equalto="#new-pwd" data-msg-equalto="Mật khẩu không khớp" />
                    </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary" data-dismiss="modal">Đóng</a>
                <button type="submit" class="btn btn-primary" id="btn-save-new-pwd">Lưu</button>
            </div>
        </form>
        </div>
    </div>
</div>
<script src="{{ asset('admin/assets/js/plugins/jquery.validate.min.js')}}"></script>
<script src="{{ asset('admin/assets/js/plugins/sweetalert2.all.js')}}"></script>
<script src="{{ asset('admin/assets/js/changePassword.js')}}"></script>
<script>
    $(document).ready(function() {
    $("#edit_profile").click(function() {
        let form = $("#frm-edit-profile");
        form.validate({
            submitHandler: function() {
                let action, method, formData;
                action = form.attr('action');
                method = form.attr('method');
                formData = form.serialize();
                $.ajax({
                    url: action,
                    type: method,
                    data: formData,
                    success: function(data) {
                        //console.log(data);
                        if (data.status == '_error') {
                            Swal({
                                title: data.msg,
                                showCancelButton: false,
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                type: 'error'
                            });
                        } else {
                            Swal({
                                title: data.msg,
                                showCancelButton: false,
                                showConfirmButton: false,
                                type: 'success',
                                timer: 2000
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
        });
    })

});
</script>
@endsection
