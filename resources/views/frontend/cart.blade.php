@extends('layouts.frontend.app')
@section('content')
<style type="text/css" media="screen">
    .removeCart{
        cursor: pointer;
    }
</style>
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="#" title="Return to Home">Home</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Your shopping cart</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- page heading-->
        <h2 class="page-heading no-line">
            <span class="page-heading-title2">Shopping Cart Summary</span>
        </h2>
        <!-- ../page heading-->
        <div class="page-content page-order">
            <ul class="step">
                 @if (Auth::guard('customers')->check())
                  <li class="current-step" style="width: 33.33%"><span>01. Tổng quan</span></li>
                  <li style="width: 33.33%"><span>02. Địa chỉ hóa đơn</span></li>
                  <li style="width: 33.33%"><span>03. Hình thức thanh toán</span></li>
                @else
                <li class="current-step" style="width: 25%"><span>01. Tổng quan</span></li>
                <li style="width: 25%;"><span>02. Đăng nhập</span></li>
                <li style="width: 25%;"><span>03. Địa chỉ hóa đơn</span></li>
                <li style="width: 25%;"><span>04. Hình thức thanh toán</span></li>
                @endif
            </ul>
            <div class="heading-counter warning">Giỏ hàng của bạn có:
                <span>{{ $count_cart}} sản phẩm</span>
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
                                <a href="#"><img src="{{ asset('uploads/images/products/'.$element->attributes->avatar) }}" alt="Product"></a>
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
                            <td colspan="6"><strong>Tổng tiền: </strong></td>
                            <td class="total-price-td"><strong>{{ number_format($cart_subtotal )}}</strong></td>
                        </tr>
                    </tfoot>
                </table>
                @else
                <h4 align="center">Giỏ hàng của bạn đang trống</h4>
                <script>
                    $(document).ready(function() {
                        window.location.href='{{ url('/')}}';
                    });
                </script>                @endif
                <div class="cart_navigation">
                    <a class="prev-btn" href="{{ url('/') }}">Tiếp tục mua hàng</a>
                     @if ($count_cart > 0)
                    <a class="next-btn" href="{{ url('cart/step/') }}">Tiến hành thanh toán</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('\admin/notify.js') }}"></script>
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
