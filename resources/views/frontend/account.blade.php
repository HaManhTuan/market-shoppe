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
            <span class="navigation_page">Cập nhật thông tin</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- page heading-->
        <h2 class="page-heading">
            <span class="page-heading-title2">Thông tin tài khoản</span>
        </h2>
        <!-- ../page heading-->
        <div class="page-content">
            <div class="row">
                <div class="col-sm-4">
                    <div class="box-authentication">
                        <h3>Bạn có thể thay đổi thông tin</h3>
                        <form action="{{ url('/update-account') }}" method="POST" id="frm-update" onsubmit="return false;">
                          @csrf
                          <input type="hidden" name="customer_id" value="{{Auth::guard('customers')->user()->id}}">
                          <label for="name_register">Họ tên</label>
                          <input id="name_register" type="text" class="form-control" name="name" id="name" data-rule-required="true" data-msg-required="Vui lòng nhập tên." value="{{ Auth::guard('customers')->user()->name}}">
                          <label for="phone_register">Số điện thoại</label>
                          <input id="phone_register" type="text" class="form-control" name="phone" id="phone" data-rule-required="true" data-msg-required="Vui lòng nhập số điện thoại."  data-rule-minlength="10" data-msg-minlength="Số điện thoại phải 10 kí tự" data-rule-maxlength="10" data-msg-maxlength="Số điện thoại phải 10 kí tự" data-rule-number="true" data-msg-number="Số điện thoại phải là số" value="{{ Auth::guard('customers')->user()->phone}}" >
                         {{--  <label for="emmail_register">Email</label>
                          <input id="emmail_register" type="email" class="form-control" name="email" id="email" data-rule-required="true" data-msg-required="Vui lòng nhập email." data-rule-email="true" data-msg-email="Vui lòng nhập đúng định dạng  email" {{ Auth::guard('customers')->user()->email}}> --}}
                          <label for="address_register">Địa chỉ</label>
                          <textarea class="form-control" name="address" id="parent_id" data-rule-required="true" data-msg-required="Vui lòng nhập địa chỉ" >{{ Auth::guard('customers')->user()->address}}</textarea>
                          <button type="submit" class="button" id="btn-update"><i class="fa fa-user"></i> Thay đổi thông tin</button>
                           <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#Resetpass"><i class="fa fa-key" aria-hidden="true"></i> Đổi mật khẩu</button>
                        </form>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="box-authentication">
                      <h3>Lịch sử mua hàng</h3>
                        <table class="table table-bordered orderview">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Sản phẩm</th>
                              <th>Hình thức thanh toán</th>
                              <th>Tổng tiền</th>
                              <th>Ngày tạo</th>

                            </tr>
                          </thead>
                          <tbody>
                            @foreach($order as $order)
                            <tr>
                              <td>{{ $order->id }}</td>
                              <td>
                                @foreach($order->orders as $pro)
                                {{ $pro->product_name }}<br>
                                SL: {{ $pro->quantity }} x {{ number_format($pro->price)}} = {{ number_format($pro->price*$pro->quantity)}}
                                ============================== <br>
                                @endforeach
                              </td>
                              <td>COD</td>
                              <td>{{ number_format($order->total_price) }}</td>
                              <td>{{ $order->created_at }}</td>

                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="Resetpass" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg bounceInDown animated" style="max-width: 400px;">
    <div class="modal-content">
      <form action="{{ url('account/edit-password') }}" class="frm-password" method="POST" id="change-password-form" onsubmit="return false;">
        @csrf
        <div class="modal-header">
          <h4 class="modal-title">Đổi mật khẩu
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <input type="hidden" name="id" value="{{ Auth::guard('customers')->user()->id }}">
        <div class="modal-body">
          <div class="form-group">
            <label for="new-pwd">Mật khẩu mới</label>
            <input type="password" id="new-pwd" name="newPwd" class="form-control" placeholder="Nhập mật khẩu mới" data-rule-required="true" data-msg-required="Vui lòng nhập mật khẩu mới" data-rule-minlength="6" data-msg-minlength="Mật khẩu phải ít nhất từ 6 kí tự trở lên" />
          </div>
          <div class="form-group">
            <label for="retype-new-pwd">Nhập lại mật khẩu</label>
            <input type="password" id="retype-new-pwd" name="retypeNewPwd" class="form-control" placeholder="Nhập lại mật khẩu" data-rule-required="true" data-msg-required="Vui lòng nhập lại mật khẩu" data-rule-equalto="#new-pwd" data-msg-equalto="Mật khẩu không khớp" data-rule-minlength="6" data-msg-minlength="Mật khẩu phải ít nhất từ 6 kí tự trở lên"/>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Hủy bỏ</button>
          <button type="submit" class="btn btn-danger waves-effect waves-light btn-edit-save" id="btn-save-new-pwd"><small class="ti-save mr-2"></small>Lưu thay đổi</button>
        </div>
      </form>
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
  $(document).on('click', '#btn-update', function() {
   $("#frm-update").validate({
    submitHandler: function() {
       let action = $("#frm-update").attr('action');
       let method = $("#frm-update").attr('method');
       let formData = $("#frm-update").serialize();
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
            $(".page-heading-title2").notify(data.msg,'success');
            //$("#frm-update")[0].reset();
            $('html, body').animate({
              scrollTop: 0
            }, 2000);
          }
          else{
            $('.email-re').notify(data.msg,'error');
            $(".email-re").val('');
          }
         },
         error:function(error){
          console.log(error);
         }
       });
    }
   });
  });
    $(document).on("click","#btn-save-new-pwd",function() {
    $("#change-password-form").validate({
      submitHandler: function() {
        let action = $("#change-password-form").attr('action');
        let method = $("#change-password-form").attr('method');
        let form = $("#change-password-form").serialize();
        $.ajax({
          url: action,
          type: method,
          data: form,
          headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
          },
          dataType: 'JSON',
          success: function(data) {
            console.log(data);
            if (data.status == '_success') {
              $("html, body").animate({ scrollTop: 0 }, 600);
              $.notify(data.msg,'success');
              $("#change-password-form")[0].reset();
              $("#Resetpass").modal('hide');
              setTimeout(function(){ window.location.reload(); }, 2000);
            }
            else{
              $('.card-title').notify(data.msg,'error');
              $("#frm-account")[0].reset();
            }
          },
          error: function(err) {
            console.log(err);
          }
        });
      }
    })
  });
</script>
<script>
  jQuery(document).ready(function($) {
    var length = $("#phone_register").val().length;
    $("body").removeClass('home');
    $("body").addClass('page-category');
    });
  </script>
@endsection
