@extends('layouts.frontend.app')
@section('content')
<style type="text/css" media="screen">
    .error{
    display: flex;
    color: red;
  }
  .page-order .cart_navigation button.next-btn {
    float: right;
    background: #ff3366;
    color: #fff;
    border: 1px solid #ff3366;
}
.page-order .cart_navigation button {
    padding: 10px 20px;
    border: 1px solid #eaeaea;
}
    #same-order:hover{
        cursor: pointer;
    }
    .container-checkbox {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 14px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container-checkbox input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 20px;
  width: 20px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container-checkbox:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container-checkbox input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container-checkbox input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container-checkbox .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="#" title="Return to Home">Trang chủ</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Địa chỉ hóa đơn</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- page heading-->

        <!-- ../page heading-->
        <div class="page-content page-order">
            <ul class="step">
                <li  style="width: 33.33%" ><span>01. Tổng quan</span></li>
                @if (Auth::guard('customers')->check())
                  <li style="width: 33.33%" class="current-step"><span>02. Địa chỉ hóa đơn</span></li>
                  <li style="width: 33.33%"><span>04. Hình thức thanh toán</span></li>
                @endif
            </ul>
         <div class="row">
                <div class="col-sm-6">
                    <div class="box-authentication">
                        <h3>Thông tin hóa đơn</h3>
                        <p>Hãy điền đầy đủ thông tin.</p>

                          <label for="name_register">Họ tên</label>
                          <input  type="text" class="form-control" name="name_order" id="name_order" data-rule-required="true" data-msg-required="Vui lòng nhập tên." value="{{ Auth::guard('customers')->user()->name }}">
                          <label for="phone_register">Số điện thoại</label>
                          <input  type="text" class="form-control" name="phone_order" id="phone_order" data-rule-required="true" data-msg-required="Vui lòng nhập số điện thoại."  data-rule-minlength="10" data-msg-minlength="Số điện thoại phải 10 kí tự" data-rule-maxlength="10" data-msg-maxlength="Số điện thoại phải 10 kí tự" data-rule-number="true" data-msg-number="Số điện thoại phải là số" value="{{ Auth::guard('customers')->user()->phone }}">
                          <label for="address_register">Địa chỉ</label>
                          <textarea class="form-control" name="address_order" id="address_order" data-rule-required="true" data-msg-required="Vui lòng nhập địa chỉ" >{{ Auth::guard('customers')->user()->address }}</textarea>


                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="box-authentication">
                        <h3>Thông tin người nhận</h3>
                        <p>Hãy điền đầy đủ thông tin.</p>
                        <form action="{{ url('cart/step-continue') }}" method="POST" id="frm-order">
                          @csrf
                          <label for="name_register">Họ tên</label>
                          <input  type="text" class="form-control" name="name_shipping" id="name_shipping" data-rule-required="true" data-msg-required="Vui lòng nhập tên." >
                          <label for="phone_register">Số điện thoại</label>
                          <input  type="text" class="form-control" name="phone_shipping" id="phone_shipping" data-rule-required="true" data-msg-required="Vui lòng nhập số điện thoại." data-rule-minlength="10" data-msg-minlength="Số điện thoại phải 10 kí tự" data-rule-maxlength="10" data-msg-maxlength="Số điện thoại phải 10 kí tự" data-rule-number="true" data-msg-number="Số điện thoại phải là số">
                          <label for="address_register">Địa chỉ</label>
                          <textarea class="form-control" name="address_shipping" id="address_shipping" data-rule-required="true" data-msg-required="Vui lòng nhập địa chỉ" ></textarea>
                        <label class="container-checkbox">Lấy thông tin từ thông tin khách hàng
                          <input type="checkbox" id="same-order">
                          <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="order-detail-content">
                @if ($count_cart > 0)
                <table class="table table-bordered table-responsive cart_summary">
                    <thead>
                        <tr>
                            <th class="cart_product">Ảnh</th>
                            <th>Mô tả</th>
                            <th>TT.</th>
                            <th>Giá</th>
                            <th>SL</th>
                            <th>Thành tiền</th>
                            <th class="action"><i class="fa fa-trash-o"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($cart_data as $element)
                          <tr id="dd-item-{{ $element->id }}">
                            <td class="cart_product">
                                <a href="#"><img src="{{ asset('public/uploads/images/products/'.$element->attributes->avatar) }}" alt="Product"></a>
                            </td>
                            <td class="cart_description">
                                <p class="product-name"><a href="#">{{ $element->name }} </a></p>
                            </td>
                            <td class="cart_avail" id="cart_{{$element->id}}"><span class="label label-success">Còn hàng</span></td>
                            <td class="price"><span>{{ number_format($element->price)}}</span></td>
                            <td class="qty">
                                <input class="form-control input-sm" type="text" value="{{ $element->quantity }}" onchange="updateCart('{{ $element->id}}','{{ $element->attributes->product_id }}',this.value)" name="qty">
                            </td>
                            <td class="price">
                                <span>{{ number_format($element->quantity*$element->price)}}</span>
                            </td>
                            <td class="action">
                                <a  class="removeCart" data-id="{{ $element->id }}">Xóa sản phẩm</a>
                            </td>
                        </tr>
                       @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="total-price">
                            <td colspan="4"><strong>Tổng tiền: </strong></td>
                            <td colspan="2" class="total-price-td"><strong>{{ number_format($cart_subtotal )}}</strong></td>
                        </tr>
                    </tfoot>
                </table>
                @else
                <h4 align="center">Giỏ hàng của bạn đang trống</h4>
                <script>
                    $(document).ready(function() {
                        window.location.href='{{ url('/')}}';
                    });
                </script>

                @endif
                <div class="cart_navigation">
                    <a class="prev-btn" href="{{ url('/view-cart') }}">Quay lại</a>
                     @if ($count_cart > 0)
                    <button class="next-btn" type="submit" id="btn-continue">Tiến hành thanh toán</button>
                    @endif
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/frontend/assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('public/admin/notify.js') }}"></script>
<script>
    function number_format(number, decimals, dec_point, thousands_sep) {
    // * example 1: number_format(1234.5678, 2, '.', '');
    // * returns 1: 1234.57
    number = number.toString().replace(/[(,)|(.)]/g, "");

    var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
    var d = dec_point == undefined ? "," : dec_point;
    var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;

    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    }
    jQuery(document).ready(function($) {
        $("body").removeClass('home');
        $("body").addClass('page-category');
         $("#frm-order").validate();
    });
    $('#same-order').click(function()
    {

      if (this.checked) {
        $('#name_shipping').val($('#name_order').val());
        $('#phone_shipping').val($('#phone_order').val());
        $('#address_shipping').val($('#address_order').val());
      }
      else
      {
        $('#name_shipping').val('');
        $('#phone_shipping').val('');
        $('#address_shipping').val('');
      }
    });
    function updateCart(id,product_id,qty){
      $.get(
         "{{ url('/updateCart')  }}",
         {id:id,qty:qty,product_id:product_id},
         function(data){
            console.log(data);
            if (data.status == '_success') {
                $.notify(data.msg,'success');
                location.reload();
            }
            else{
                 $.notify(data.msg,'error');
                 $(".next-btn").hide();
                 $("#cart_"+id).html('');
                 $("#cart_"+id).append('<span class="label label-danger">Hết hàng</span>')
                //setTimeout(function(){ location.reload(); }, 2000);
            }
        }
        );
     }
    $(".removeCart").click(function(){
      let id = $(this).data('id');
      $.ajax({
        url: "{{ url('/removeCart') }}",
        type: "POST",
        dataType:"JSON",
        data: {id: id},
          headers: {
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            },
        success: function(data){
            if(data.status == "_success"){
                $.notify(data.msg,'success');
                $("#dd-item-"+id).remove();
                $("tr.total-price td.total-price-td").html(number_format(data.cart_subtotal));
                if ($(".cart_summary tbody tr").length == 0) {location.reload();}
            }
            else{
                  $.notify(data.msg,'error');
            }
        },
        error:function(err) {
                console.log(err);
            }
      });
    });
</script>
@endsection
