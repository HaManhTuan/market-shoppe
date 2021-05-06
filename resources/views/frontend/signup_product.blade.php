@extends('layouts.frontend.app')
@section('content')
<style type="text/css" media="screen">
  .error{
    display: flex;
    color: red;
  }
</style>
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="{{ url('/') }}" title="Return to Home">Trang chủ</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Đăng kí gian hàng</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- page heading-->
        <h2 class="page-heading">
            <span class="page-heading-title2">Thông tin</span>
        </h2>
        <!-- ../page heading-->
        <div class="page-content">
            <div class="row">
                <div class="col-sm-6">
                    <div class="box-authentication">
                        <h3>Tạo 1 gian hàng</h3>
                        <p>Hãy điền đầy đủ thông tin.</p>
                        <form action="{{ url('/dang-ki-product') }}" method="POST" id="frm-register" onsubmit="return false;">
                          @csrf
                          <label for="name_register">Tên</label>
                          <input id="name_register" type="text" class="form-control" name="name_re" id="name" data-rule-required="true" data-msg-required="Vui lòng nhập tên." >
                          <label for="phone_register">Số điện thoại</label>
                          <input id="phone_register" type="text" class="form-control" name="phone" id="phone" data-rule-required="true" data-msg-required="Vui lòng nhập số điện thoại."  data-rule-minlength="10" data-msg-minlength="Số điện thoại phải 10 kí tự" data-rule-maxlength="10" data-msg-maxlength="Số điện thoại phải 10 kí tự" data-rule-number="true" data-msg-number="Số điện thoại phải là số">
                          <label for="emmail_register">Email</label>
                          <input id="emmail_register" type="email" class="form-control" name="email_re" data-rule-required="true" data-msg-required="Vui lòng nhập email." data-rule-email="true" data-msg-email="Vui lòng nhập đúng định dạng  email">
                          <label for="password_register">Mật khẩu</label>
                          <input id="password_register" type="password" class="form-control" name="password_re" id="password" data-rule-required="true" data-msg-required="Vui lòng nhập mật khẩu." data-rule-minlength="6" data-msg-minlength="Mật khẩu phải ít nhất từ 6 kí tự trở lên" >
                          <label for="address_register">Tỉnh</label>
                          <select name="province_id" class="form-control" id="province" data-rule-required="true" data-msg-required="Vui lòng chọn tỉnh thành." >
                            <option value="" selected disabled>--Chọn tỉnh thành--</option>
                            @if ($provine)
                                @foreach ($provine as $item)
                                 <option value="{{  (string)$item->id }}">{{ $item->name  }}</option>
                                @endforeach
                            @endif
                          </select>
                          <label for="address_register">Quận/Huyện</label>
                          <select name="district_id" class="form-control" id="district" data-rule-required="true" data-msg-required="Vui lòng chọn Quận/Huyện." ></select>
                          <label for="address_register">Phường</label>
                          <select name="ward_id" class="form-control" id="ward" data-rule-required="true" data-msg-required="Vui lòng chọn Phường/Xã." ></select>
                          <label for="address_register">Địa chỉ</label>
                          <textarea class="form-control" name="address" id="parent_id" data-rule-required="true" data-msg-required="Vui lòng nhập địa chỉ" ></textarea>
                          <button type="submit" class="button" id="btn-register"><i class="fa fa-user"></i> Tạo gian hàng</button>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="box-authentication">
                        <h3>Nếu bạn đã có tài khoản ?</h3>
                        <form action="{{ url('/admin/dang-nhap') }}" method="POST" id="frm-login" onsubmit="return false;">
                          @csrf
                        <label for="emmail_login">Email</label>
                        <input id="emmail_login" name="email" type="text" class="form-control"  data-rule-required="true" data-msg-required="Vui lòng nhập email." data-rule-email="true" data-msg-email="Vui lòng nhập đúng định dạng  email">
                        <label for="password_login">Mật khẩu</label>
                        <input id="password_login" type="password" name="password" class="form-control" id="password" data-rule-required="true" data-msg-required="Vui lòng nhập mật khẩu." data-rule-minlength="6" data-msg-minlength="Mật khẩu phải ít nhất từ 6 kí tự trở lên">
                        <button type="submit" class="button" id="btn-login"><i class="fa fa-lock"></i> Đăng nhập</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('frontend/assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/notify.js') }}"></script>
@if(Session::has('flash_ms_error'))
<script>
   $.notify("{!! session('flash_ms_error') !!}","error");
</script>
@endif
<script>
  $(document).on('click', '#btn-register', function() {
   $("#frm-register").validate({
    submitHandler: function() {
       let action = $("#frm-register").attr('action');
       let method = $("#frm-register").attr('method');
       let formData = $("#frm-register").serialize();
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
            $.notify(data.msg,'success');
            $("#frm-register")[0].reset();
            $('html, body').animate({
              scrollTop: 2000
            }, 2000);
          }
          else{
            $('#emmail_register').notify(data.msg,'error');
            $("#emmail_register").val('');
          }
         },
         error:function(error){
          console.log(error);
         }
       });
    }
   });
  });
  $(document).on('click', '#btn-login', function() {
   $("#frm-login").validate({
    submitHandler: function() {
       let action = $("#frm-login").attr('action');
       let method = $("#frm-login").attr('method');
       let formData = $("#frm-login").serialize();
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
            $.notify(data.msg,'success');
            $("#frm-login")[0].reset();
            $("#btn-login").html("Đang đăng nhập ....")
            setTimeout(function(){ window.location.href="{{ url('/admin/dashboard') }}"}, 2500);
          }
          else{
            $('html, body').animate({
              scrollTop: 0
            }, 2000)
            $.notify(data.msg,'error');
            $("#frm-login")[0].reset();
          }
         },
         error:function(error){
          console.log(error);
         }
       });
    }
   });
  });
</script>
<script>
    function onlyNumberKey(evt) {
        // Only ASCII charactar in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>
<script>
  jQuery(document).ready(function($) {
    var length = $("#phone_register").val().length;
    $("body").removeClass('home');
    $("body").addClass('page-category');
    });
    $('#province').change(function (e) {
        e.preventDefault();
        let provine_id = $(this).val()
        $.ajax({
         url: "{{ url('/get-district') }}"+'/'+provine_id,
         type: "GET",
         dataType: 'JSON',
         headers: {
          'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
         },
         success: function(data){
            $("#district").html(data.body);
         },
         error:function(error){
          console.log(error);
         }
       });
       $('#district').change(function (e) {
            e.preventDefault();
            let district_id = $(this).val()
            $.ajax({
                url: "{{ url('/get-ward') }}"+'/'+district_id,
                type: "GET",
                dataType: 'JSON',
                headers: {
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                },
                success: function(data){
                    $("#ward").html(data.body);
                },
                error:function(error){
                console.log(error);
                }
            });
       })
    });
  </script>
@endsection
