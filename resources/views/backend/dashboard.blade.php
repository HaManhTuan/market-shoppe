@extends('layouts.admin.admin')
@section('content')
<style type="text/css" media="screen">
    .tr-link:hover{
        cursor: pointer;
    }
</style>
    <!-- chart chartist js -->
    <script src="{{ asset('public/admin/assets/vendor/charts/chartist-bundle/chartist.min.js')}}"></script>
    <!-- morris js -->
    <script src="{{ asset('public/admin/assets/vendor/charts/morris-bundle/raphael.min.js')}}"></script>
    <script src="{{ asset('public/admin/assets/vendor/charts/morris-bundle/morris.js')}}"></script>
    <!-- sparkline js -->
<script src="{{ asset('public/admin/assets/vendor/charts/sparkline/jquery.sparkline.js')}}"></script>
<!-- chart c3 js -->
<script src="{{ asset('public/admin/assets/vendor/charts/c3charts/c3.min.js')}}"></script>
<script src="{{ asset('public/admin/assets/vendor/charts/c3charts/d3-5.4.0.min.js')}}"></script>
<script src="{{ asset('public/admin/assets/vendor/charts/c3charts/C3chartjs.js')}}"></script>
<style type="text/css" media="screen">
    .tab-header{
        margin: 5px;
    }
    .clickable-row:hover{
        cursor: pointer;
    }
</style>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Quản trị </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản trị</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Trang quản trị</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-lg-12">
        @if ($dataProExp->count() > 0)
       <div class="alert alert-danger alert-dismissible bounceInDown animated">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <h4><i class="icon fa fa-ban"></i> Thông báo sản phẩm sắp hết hàng!</h4>
         @foreach($dataProExp as $value)
             <span class="key">{{ $value->name }} - Còn lại: <span>{{ $value->stock }} </span> sản phẩm </span> <a href="{{ url('admin/product/edit-pro/'.$value->url) }}"><i class="fa fa-undo"></i> Nhập hàng</a><br>
         @endforeach
       </div>
        @endif
 </div>
</div>
<div class="ecommerce-widget">
    <div class="row">
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-muted">Tổng doanh thu</h5>
                    <div class="metric-value d-inline-block">
                        <h4 class="mb-1">{{ isset($total_revenue) ? number_format($total_revenue) : ''}}</h4>
                    </div>
                    <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                        <span><i class="{{ isset($perCurrrentY) && $perCurrrentY > 0 ? 'fa fa-fw fa-arrow-up' : 'fa fa-fw fa-arrow-down'}}"></i></span><span>
                            {{ isset($perCurrrentY) && $perCurrrentY > 0 ? number_format($perCurrrentY) : '' }}
                        %</span>
                    </div>
                    <div id="sparkline-revenue">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-muted">Tổng doanh thu năm nay</h5>
                    <div class="metric-value d-inline-block">
                        <h4 class="mb-1">{{ isset($revenueCurrentY) ? number_format($revenueCurrentY) : ''}}</h4>
                    </div>
                </div>
                <div id="sparkline-revenue2"></div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-muted">Doanh thu tháng này</h5>
                    <div class="metric-value d-inline-block">
                        <h4 class="mb-1">{{ isset($revenueCurrentM) ? number_format($revenueCurrentM) : ''}}</h4>
                    </div>
                    <div class="metric-label d-inline-block float-right text-primary font-weight-bold">
                        <span>N/A</span>
                    </div>
                </div>
                <div id="sparkline-revenue3"></div>
            </div>
        </div>
{{--         <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-muted">Doanh thu tuần này</h5>
                    <div class="metric-value d-inline-block">
                        <h4 class="mb-1">{{number_format($total7day)}}</h4>
                    </div>
                </div>
                <div id="sparkline-revenue4"></div>
            </div>
        </div> --}}
    </div>
    <div class="row">
        <!-- ============================================================== -->

        <!-- ============================================================== -->

        <!-- recent orders  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Đon hàng cần xử lý</h5>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        @if ($ordersNews->count() > 0)
                        <h5 class="tab-header"><i class="fa fa-star"></i> Danh sách đơn hàng - <a href="{{ url('admin/order/view') }}">Chi tiết</a></h5>
                        <table class="table table-bordered table-hover ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>SĐT</th>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ordersNews as $item)
                                <tr class='clickable-row'   onclick="location.href='{{ url('admin/order/view-orderdetail/'.$item->id) }}'"">

                                    <td>{{ $item->id  }}</td>
                                    <td>{{ $item->name  }}</td>
                                    <td>{{ $item->phone  }}</td>
                                    <td>
                                         @foreach($item->orders as $value)
                                        {{ $value->product_name }}
                                        @endforeach
                                    </td>
                                    <td>{{ number_format($item->total_price) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                      <h5 align="center">Không có đơn hàng nào mới</h5>
                      @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end recent orders  -->


        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- customer acquistion  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- end customer acquistion  -->
        <!-- ============================================================== -->
    </div>

    <div class="row">
        <!-- ============================================================== -->
        <!-- sales  -->
        <!-- ============================================================== -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Tổng số sản phẩm</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">{{ isset($totalPro) ? $totalPro : '' }}</h1>
                    </div>
                    {{-- <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                        <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5.86%</span>
                    </div> --}}
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end sales  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- new customer  -->
        <!-- ============================================================== -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Số lượng khách hàng</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">{{ isset($total_customer) ? $total_customer : '' }}</h1>
                    </div>
{{--                     <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                        <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">10%</span>
                    </div> --}}
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end new customer  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- visitor  -->
        <!-- ============================================================== -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Tổng số đơn hàng đã thanh toán</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">{{ isset($totalOrderS) ? $totalOrderS : ''}}</h1>
                    </div>
                    {{-- <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                        <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5%</span>
                    </div> --}}
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end visitor  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- total orders  -->
        <!-- ============================================================== -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Tổng số đơn hàng</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">{{ isset($totalOrder) ? $totalOrder : ''}}</h1>
                    </div>
                   {{--  <div class="metric-label d-inline-block float-right text-danger font-weight-bold">
                        <span class="icon-circle-small icon-box-xs text-danger bg-danger-light bg-danger-light "><i class="fa fa-fw fa-arrow-down"></i></span><span class="ml-1">4%</span>
                    </div> --}}
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end total orders  -->
        <!-- ============================================================== -->
    </div>
    <div class="row">
        <!-- ============================================================== -->
        <!-- total revenue  -->
        <!-- ============================================================== -->


        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- category revenue  -->
        <!-- ============================================================== -->
        <div class="col-xl65 col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Sản phẩm xem nhiều </h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table no-wrap p-table">
                            <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0">Tên</th>
                                    <th class="border-0">Lượt xem</th>
                                </tr>
                            </thead>
                            @if ($viewPro)
                            <tbody>
                                @foreach ($viewPro as $viewPro)
                                <tr>
                                    <td>{{$viewPro->name}}</td>
                                    <td>
                                        {{$viewPro->count_view}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end category revenue  -->
        <!-- ============================================================== -->

        <div class="col-xl65 col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Sản phẩm sắp hết hàng </h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table no-wrap p-table">
                            <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0">Tên</th>
                                    <th class="border-0">Còn</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($buyPro)
                                    @foreach ($buyPro as $buyPro)
                                    <tr class="clickable-row" data-href={{url('admin/product/edit-pro/'.$buyPro->url)}}>
                                        <td>{{$buyPro->name}}</td>
                                        <td>
                                            @if ($buyPro->stock == 0 )
                                                Hết hàng
                                            @else
                                                {{$buyPro->stock}}
                                            @endif

                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
       <!-- sparkline js -->
<script src="{{ asset('public/admin/assets/vendor/charts/sparkline/jquery.sparkline.js')}}"></script>
@endsection

