@extends('layouts.frontend.app')
@section('content')
<style type="text/css" media="screen">
    .error{
        color: red;
    }
</style>
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="{{ url('/') }}" title="Return to Home">Home</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Liên hệ</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- page heading-->
        <h2 class="page-heading">
            <span class="page-heading-title2">Liên hệ với chúng tôi</span>
        </h2>
        <!-- ../page heading-->
        <div id="contact" class="page-content page-contact">
            <div id="message-box-conact"></div>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="page-subheading">Thông tin liên hệ</h3>
                    <div class="contact-form-box">
                      <form action="{{ url('/contact-post') }}" method="POST" id="frm-contact" onsubmit="return false;">
                        @csrf
                        <div class="form-selector">
                            <label>Họ tên</label>
                            <input type="text" name="name" class="form-control input-sm" id="name" data-rule-required="true" data-msg-required="Vui lòng nhập tên.">
                        </div>
                        <div class="form-selector">
                            <label>Số điện thoại</label>
                            <input type="text" name="phone" class="form-control input-sm" id="phone" data-rule-required="true" data-msg-required="Vui lòng nhập số điện thoại." data-number-required="true" data-msg-number="Số điện thoại phải là chữ" data-rule-minlength="10" data-rule-maxlength="10" data-msg-minlength="Số điện thoại ít nhất 10 số" data-msg-maxlength="Số điện thoại ít nhất 10 số">
                        </div>
                        <div class="form-selector">
                            <label>Email address</label>
                            <input type="email" name='email' class="form-control input-sm" id="email" data-rule-email="true" data-msg-email="Không đúng định dạng email" data-rule-required="true" data-msg-required="Vui lòng nhập email.">
                        </div>
                        <div class="form-selector">
                            <label>Nội dung</label>
                            <textarea class="form-control input-sm" rows="10" id="message" name="message" data-rule-required="true" data-msg-required="Vui lòng điền vào trường này."></textarea>
                        </div>
                        <div class="form-selector">
                            <button type="submit" class="btn btn-primary" id="btn-send">Gửi</button>
                        </div>
                      </form>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6" id="contact_form_map">
                    <h3 class="page-subheading">Thông tin</h3>
                    <p>Bạn muốn được tư vấn, phản ảnh, hoặc thắc mắc. Vui lòng điền thông tin rồi gửi cho chúng tôi..</p>
                    <br>
                    <ul class="store_info">
                        <li><i class="fa fa-home"></i>{{ $dataConfig->address}}</li>
                        <li><i class="fa fa-phone"></i><span>+ {{ $dataConfig->phone}}</span></li>
                        <li><i class="fa fa-envelope"></i>Email: <span><a href="#">{{ $dataConfig->email}}</a></span></li>
                    </ul>
                    </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('admin/assets/js/plugins/notify.js')}}"></script>
<script src="{{ asset('admin/assets/js/plugins/jquery.validate.min.js')}}"></script>
<script>
jQuery(document).ready(function($) {
    $("body").removeClass('home');
    $("body").addClass('page-category');
});
$(document).on('click','#btn-send', function(){
   $("#frm-contact").validate({
    submitHandler: function() {
       let action = $("#frm-contact").attr('action');
       let method = $("#frm-contact").attr('method');
       let formData = $("#frm-contact").serialize();
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
            $("#frm-contact")[0].reset();
            $('html, body').animate({
              scrollTop: 0
            }, 2000);
            setTimeout(function(){window.location.href="{{ url('/') }}"}, 2000)
          }
          else{
            $.notify(data.msg,'error');

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
@endsection
