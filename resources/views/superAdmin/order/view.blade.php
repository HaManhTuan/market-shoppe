@extends('layouts.superAdmin.app')
@section('content')
<link rel="stylesheet" href="{{ asset('admin/dropify.css') }}">
<style>
    .error{
        color: brown;
        font-size: 14px;
        padding: 5px;
    }
</style>
<link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap-4.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/css/animate.css') }}">
<style>
    .rd-add:hover{
        cursor: pointer;
    }
    .custom-load{
        display: none;
        float: right;
        margin: 0px 8px;
        border: 3px solid transparent;
        border-top: 3px solid #5969ff;
        border-left: 3px solid #5969ff;
        -webkit-animation: 1s spin linear infinite;
        animation: 2s spin linear infinite;
    }
    .spinner-custom{
        width: 26px;
        height: 26px
    }
</style>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Đơn hàng
            </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Chi tiết đơn hàng</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
        <div class="card">
            <div class="card-header">
               <h5 class="card-title">Trạng thái đơn hàng
               @if($orderDetail->order_status == 1)
               <span class="label label-success" style="margin-left: 10px;display:inline-block;">Mới</span>
               @elseif($orderDetail->order_status == 2)
               <span class="label label-primary" style="margin-left: 10px;display:inline-block;">Đang xử lý</span>
               @elseif($orderDetail->order_status == 3)
               <span class="label label-warning" style="margin-left: 10px;display:inline-block;">Đang chuyển</span>
               @elseif($orderDetail->order_status == 4)
               <span class="label label-info" style="margin-left: 10px;display:inline-block;">Đã chuyển</span>
               @elseif($orderDetail->order_status == 5)
               <span class="label label-danger" style="margin-left: 10px;display:inline-block;">Đã hủy</span>
               @endif
               </h5>
            </div>
          <div class="card-body">
            <table class="table table-bordered ">
                  <tr>
                     <th scope="col">Ngày tạo</th>
                     <th scope="col">{{ date('d/m/Y h:i:s',strtotime($orderDetail->created_at)) }}</th>
                  </tr>
                  <tr>
                     <th scope="col">Tổng tiền</th>
                     <th scope="col">{{ number_format($orderDetail->total_price) }}</th>
                  </tr>
                  @if ($orderDetail->origin_price > $orderDetail->total_price)
                    <tr>
                        <th scope="col">Tổng tiền ban đầu</th>
                        <th scope="col">{{ number_format($orderDetail->origin_price) }}</th>
                    </tr>
                  @endif
                  <tr>
                     <th scope="col">Hình thức thanh toán</th>
                     <th scope="col">{{ ($orderDetail->order_method) }}</th>
                  </tr>
                  <tr>
                     <th scope="col">Chú ý </th>
                     <th scope="col">{{ ($orderDetail->note) }}</th>
                  </tr>
              </table>
          </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
        <div class="card">
            <div class="card-header">
               <h5 class="card-title">Thông tin hóa đơn</h5>
            </div>
          <div class="card-body">
            <table class="table table-bordered ">
                <tr>
                   <th scope="col">Họ tên:</th>
                   <th scope="col">{{ $orderDetail->customer->name }}</th>
                </tr>
                <tr>
                   <th scope="col">Số điện thoại</th>
                   <th scope="col">
                    {{ $orderDetail->customer->phone }}
                   </th>
                </tr>
                <tr>
                   <th scope="col">Email</th>
                   <th scope="col">
                    {{ $orderDetail->customer->email }}
                   </th>
                </tr>
                <tr>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">
                        {{ $orderDetail->customer->address }}
                    </th>
                 </tr>
             </table>
          </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
        <div class="card">
            <div class="card-header">
               <h5 class="card-title">Khách hàng
               </h5>
            </div>
          <div class="card-body">
            <table class="table table-bordered ">
              <tr>
                 <th scope="col">Họ tên:</th>
                 <th scope="col">{{ $orderDetail->name }}</th>
              </tr>
              <tr>
                 <th scope="col">Số điện thoại</th>
                 <th scope="col">
                    {{ $orderDetail->phone }}
                 </th>
              </tr>
              <tr>
                 <th scope="col">Email</th>
                 <th scope="col">
                    {{ $orderDetail->email }}
                 </th>
              </tr>
           </table>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
               <h5 class="card-title">Chi tiết</h5>
            </div>
            <div class="card-body">
                <table id="order-table" class="table table-bordered table-hover">
                        <thead>
                           <tr>
                              <th>Tên sản phẩm</th>
                              <th>Giá</th>
                              <th style="width: 200px;">Ảnh</th>
                              <th>Số lượng</th>
                              <th>Tổng tiền</th>
                           </tr>
                        </thead>
                        <tbody>
                           @php $total_amount = 0; @endphp
                           @foreach($orderDetail->orders as $value)
                           <tr onclick="window.open('{{ url('manager/san-pham/') }}','_blank')">
                              <td>{{ $value->product_name }}</td>
                              <td>{{ number_format($value->price) }}</td>
                              <td>
                                  <img src="{{ asset('uploads/images/products/'.$value->product->image) }}" style="max-width: 25%;" alt="">
                              </td>
                              <td>{{ $value->quantity }}</td>
                              <td>{{ number_format($value->price*$value->quantity) }} {{ $orderDetail->origin_price > $orderDetail->total_price ? '(-'.(($orderDetail->origin_price / $orderDetail->total_price)).'%)' : ''}}</td>
                           </tr>
                           <?php $total_amount = $total_amount+($value->quantity*$value->price);?>
                           @endforeach
                           <tr>
                               <td colspan="4">Tổng tiền:</td>
                               <td style="color:brown;font-weight: bold; width: 142px;">{{ number_format($total_amount) }}</td>
                           </tr>
                           <tr>
                                <td colspan="4">Tổng tiền ban đầu:</td>
                                <td style="color:brown;font-weight: bold; width: 142px;">{{ number_format($orderDetail->origin_price) }}</td>
                            </tr>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
    table th {
        font-weight: normal;
    }
</style>
@endsection
