<!DOCTYPE html>
<html>
<head>
  <title>Hóa Đơn - {{ $id }}</title>
  <link rel="shortcut icon" href="{{ asset('public/admin/img/favicon.png')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="utf-8">
      <link href="{{ asset('public/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet">
      <style>
        .widget{
        padding: 12px 17px;
        margin-bottom: 30px;
        margin: 0 auto;
        width: 800px;
    }
    .invoice-logo {
        width: 253px;
        height: 70px;
    }
    img {
        vertical-align: middle;
    }
    img {
        border: 0;
    }
    blockquote.blockquote-sm {
        padding: 0 0 0 15px;
        font-size: 13px;
    }
    blockquote {
        padding: 9px 18px;
        margin: 0 0 18px;
        font-size: 16.25px;
        border-left: 5px solid
        rgba(51,51,51,0.4);
    }
    p{
      /* font-size:13px; */
      margin: 0 !important;
    }
      </style>
</head>
<body onLoad="window.print()">
<div class="container-fluid">
  <div class="row">
    <section class="widget">
            <div class="body no-margin">
                <div class="row">
                    <div class="col-sm-6 col-print-6">
                        <img src="{{ asset('public/uploads/images/config/'.$dataConfig->img_logo)}}" alt="Logo" class="invoice-logo">
                    </div>
                    <div class="col-sm-6 col-print-6">
                        <div class="invoice-number text-align-right">
                            #{{ $id }} / {{ date("d-m-Y",strtotime($orderDetail->updated_at)) }}
                            <div class="invoice-number-info text-align-right">
                             <strong><font size="+2">HÓA ĐƠN XUẤT HÀNG</font></strong>
                        </div>
                        </div>

                    </div>
                </div>
                <hr>
                <section class="invoice-info well">
                    <div class="row">
                        <div class="col-sm-6 col-print-6">
                            <h4 class="details-title">Thông tin siêu thị</h4>
                            <h3 class="company-name">
                                {{ $dataConfig->title }}
                            </h3>
                            <address>
                              <abbr >Địa chỉ:</abbr> {{ $dataConfig->address }}<br>
                                <abbr >e-mail:</abbr> {{ $dataConfig->email }}<br>
                                <abbr>Số điện thoại:</abbr> {{ $dataConfig->phone }}<br>
                            </address>
                        </div>
                        <div class="col-sm-6 col-print-6 client-details">
                            <h4 class="details-title">Thông tin khách hàng</h4>
                            <h3 class="client-name">
                                {{ $orderDetail->name }}
                            </h3>
                            <address>
                                <abbr >Địa chỉ:</abbr> {{ $orderDetail->address }}<br>
                                <abbr >e-mail:</abbr> {{ $orderDetail->email }}<br>
                                <abbr >Số điện thoại:</abbr>{{ $orderDetail->phone }}<br>
                                <div class="separator line"></div>
                                @if (isset($orderDetail->note) && $orderDetail->note !='' )
                                   <p class="margin-none"><strong>Ghi chú:</strong> {{ $orderDetail->note }}<br></p>
                                @endif

                            </address>
                        </div>
                    </div>
                </section>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Sản phẩm</th>
                        <th>SL</th>
                        <th>Giá</th>
                        <th>Tổng cộng</th>
                    </tr>
                    </thead>
                    <tbody>
                      @php
                        $stt = 1;
                      @endphp
                       @php $total_amount = 0; @endphp
                        @foreach($orderDetail->orders as $value)

                        <tr>
                            <td>{{ $stt++ }}</td>
                            <td>{{ $value->product_name }}
                            <td>{{ $value->quantity }}</td>
                            <td>{{ number_format($value->price) }}</td>
                            <td>{{ number_format($value->price*$value->quantity) }}</td>
                        </tr>
                        <?php $total_amount = $total_amount+($value->quantity*$value->price);?>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-7 col-print-7">
                        <blockquote class="blockquote-sm">
                            <strong>Chú ý:</strong> Hãy giữ hóa đơn lại. Để phòng khi có trường hợp cần thiết.
                        </blockquote>
                    </div>
                    <div class="col-sm-5 col-print-5 text-right">
                       @if(isset($orderDetail->coupon_amount) && $orderDetail->coupon_amount != 0)
            <p>Tổng cộng: {{ number_format($total_amount) }}</p>
            <p>Giảm giá: {{ number_format($orderDetail->coupon_amount) }}</p>
            <p>Thành tiền: {{ number_format($orderDetail->total_price - $orderDetail->coupon_amount) }}</p>
            @else
            <p>Tổng cộng: {{ number_format($total_amount) }}</p>
            @endif
                    </div>
                </div>
                <p class="text-right mt-lg mb-xs">
                    Người lập hóa đơn
                </p>
                <p class="text-right">
                    <span class="fw-semi-bold">{{ Auth::user()->name }}</span>
                </p>
            </div>
        </section>
  </div>
</div>
</body>
</html>
