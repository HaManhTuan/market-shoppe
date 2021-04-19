@extends('layouts.admin.admin')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/assets/vendor/datatables/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/assets/vendor/datatables/css/buttons.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/assets/vendor/datatables/css/fixedHeader.bootstrap4.css')}}">
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Danh sách đơn hàng
            </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Đơn hàng</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
          <div class="card-body">
            <table id="orders-table" class="table table-bordered table-hover">
                              <thead>
                                  <tr>
                                      <th>STT</th>
                                      <th>Thời gian</th>
                                      <th>Sản phẩm</th>
                                      <th>Giá</th>
                                      <th>TT</th>
                                      <th>Hành động</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @php
                                  $stt = 1;
                                @endphp
                                  @foreach($orders as $orders)
                                  <tr>
                                      <td>{{ $stt++ }}</td>
                                      <td>{{ $orders->created_at }}</td>
                                      <td>
                                          @foreach($orders->orders as $value)
                                          {{ $value->product_name }}<br>
                                          @endforeach
                                          ==============================<br>
                                          Khách hàng: {{ $orders->name }}
                                      </td>
                                      <td>{{ number_format($orders->total_price) }}</td>
                                      <td>@if($orders->order_status == 1)
                                          <span class="label label-success" style="margin-left: 10px">Mới</span>
                                          @elseif($orders->order_status == 2)
                                          <span class="label label-primary" style="margin-left: 10px">Đang xử lý</span>
                                          @elseif($orders->order_status == 3)
                                          <span class="label label-danger" style="margin-left: 10px">Đang chuyển</span>
                                          @elseif($orders->order_status == 4)
                                          <span class="label label-primary" style="margin-left: 10px">Đã chuyển</span>
                                          @elseif($orders->order_status == 5)
                                          <span class="label label-danger" style="margin-left: 10px">Đã hủy</span>
                                      @endif</td>
                                      <td>
                                        @can('view_order')
                                        <a href="{{ url('admin/order/view-orderdetail/'.$orders->id) }}">Chi tiết</a>
                                        @endcan
                                      </td>
                                  </tr>
                                  @endforeach
                              </tbody>
                      </table>
          </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/admin/assets/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('public/admin/assets/vendor/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('public/admin/assets/vendor/datatables/js/data-table.js')}}"></script>
<script>
  $('#orders-table').DataTable({
    "columnDefs": [
        { "orderable": false, "targets": 0 },
        { "orderable": false, "targets": 2 },
        { "orderable": false, "targets": 5 }
        ],
      "order": [],
  });
</script>
@endsection