<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>   
</head>
<body style="margin:0; padding:0; background-color:#F2F2F2;">
  <h3>Cảm ơn bạn đã mua hàng tại Đồ Chơi Ô Tô</h3>
  <h4>Chúng tôi xin gửi bạn thông tin đơn hàng</h4>
  <p>Họ tên: {{$orderDetail->name}}</p>
  <p>Số điện thoại: {{$orderDetail->phone}}</p>
  <p>Địa chỉ: {{$orderDetail->address}}</p>
  <p>Ngày đặt: {{ date("d-m-Y",strtotime($orderDetail->created_at))}}</p>
  <p>Đơn hàng của bạn đang được vận chuyển và sẽ giao trong 2 tới 3 ngày tới</p>
 <table width="100%" cellpadding="0" cellspacing="0" border="1" class="wrapper" bgcolor="#FFFFFF">
  <tr>
    <td align="center" valign="top">
        TT
    </td>
    <td align="center" valign="top">
        Tên sản phẩm
    </td>
    <td align="center" valign="top">
        Số lượng
    </td>
    <td align="center" valign="top">
          Giá
      </td>
    <td align="center" valign="top">
        Thành tiền
    </td>
  </tr>
  @php
    $stt = 1;
  @endphp
  @foreach ($orderDetail->orders as $value)
     <tr>
      <td align="center" valign="top">
         {{ $stt++}}
      </td>
      <td align="center" valign="top">
          {{ $value->product_name }}
      </td>
      <td align="center" valign="top">
           {{ $value->quantity }}
      </td>
      <td align="center" valign="top">
          {{ number_format($value->price) }}
      </td>
      <td align="center" valign="top">
          {{ number_format($value->price*$value->quantity) }}
      </td>
    </tr>
  @endforeach
</table>
<p style="float: right;">Tổng tiền: {{ number_format($orderDetail->total_price) }}</p>
</body>
</html>