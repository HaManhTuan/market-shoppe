@extends('layouts.admin.admin')
@section('content')
<style type="text/css" media="screen">
    .tr-link:hover{
        cursor: pointer;
    }
</style>
    <!-- chart chartist js -->
    <script src="{{ asset('admin/assets/vendor/charts/chartist-bundle/chartist.min.js')}}"></script>
    <!-- morris js -->
    <script src="{{ asset('admin/assets/vendor/charts/morris-bundle/raphael.min.js')}}"></script>
    <script src="{{ asset('admin/assets/vendor/charts/morris-bundle/morris.js')}}"></script>
    <!-- sparkline js -->
<script src="{{ asset('admin/assets/vendor/charts/sparkline/jquery.sparkline.js')}}"></script>
<!-- chart c3 js -->
<script src="{{ asset('admin/assets/vendor/charts/c3charts/c3.min.js')}}"></script>
<script src="{{ asset('admin/assets/vendor/charts/c3charts/d3-5.4.0.min.js')}}"></script>
<script src="{{ asset('admin/assets/vendor/charts/c3charts/C3chartjs.js')}}"></script>
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
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-muted">Doanh thu hôm nay</h5>
                    <div class="metric-value d-inline-block">
                        <h4 class="mb-1">{{ isset($total_revenue_now) ? number_format($total_revenue_now) : ''}}</h4>
                    </div>
                    <div class="metric-label d-inline-block float-right text-success font-weight-bold">

                    </div>
                    <div id="sparkline-revenue">

                    </div>
                </div>
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
                                <tr class="clickable-row" onclick="location.href='{{ url('admin/order/view-orderdetail/'.$item->id) }}'">
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
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
            <h5 class="card-header">Thống kê doanh thu tuần này</h5>
            <div class="card-body">
            <canvas id="chartjs_bar"></canvas>
            </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
            <h5 class="card-header">Thống kê doanh thu 4 tháng gần nhất</h5>
            <div class="card-body">
            <canvas id="chartjs_bar_months"></canvas>
            </div>
            </div>
        </div>
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
                <h5 class="card-header">Tổng doanh thu so với năm trước </h5>
                <div class="card-body">
                    <div id="morris_totalrevenue"></div>
                </div>
                <div class="card-footer">
                    <p class="display-7 font-weight-bold"><span class="text-primary d-inline-block">{{number_format($total_revenue)}}</span><span class="text-success float-right">{{ $perCurrrentY > 0 ? "+" : "-"}} {{number_format($perCurrrentY)}}%</span></p>
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
<script src="{{ asset('admin/assets/vendor/charts/sparkline/jquery.sparkline.js')}}"></script>
<script>
    $("#sparkline-revenue").sparkline([{{ $revenueLastY3 }}, {{ $revenueLastY2 }}, {{ $revenueLastY1 }},{{ $revenueLastY }},{{ $revenueCurrentY }}], {
        type: 'line',
        width: '99.5%',
        height: '100',
        lineColor: '#5969ff',
        fillColor: '#dbdeff',
        lineWidth: 2,
        spotColor: '#dbdeff',
        minSpotColor: '#f08000 ',
        maxSpotColor: '#f08000 ',
        highlightSpotColor: '#5969ff',
        highlightLineColor: '#5969ff',
        resize: true
    });
    $("#sparkline-revenue2").sparkline([{{ $revenueCurrentM11}},{{ $revenueCurrentM10}},{{ $revenueCurrentM9}},{{ $revenueCurrentM8}},{{ $revenueCurrentM7}},{{ $revenueCurrentM6}},{{ $revenueCurrentM5}},{{ $revenueCurrentM4}},{{ $revenueCurrentM3}},{{ $revenueCurrentM2}},{{ $revenueCurrentM1}},{{ $revenueCurrentM}}], {
        type: 'line',
        width: '99.5%',
        height: '100',
        lineColor: '#ff407b',
        fillColor: '#ffdbe6',
        lineWidth: 2,
        spotColor: undefined,
        minSpotColor: undefined,
        maxSpotColor: undefined,
        highlightSpotColor: undefined,
        highlightLineColor: undefined,
        resize: true
    });
    $("#sparkline-revenue3").sparkline([{{ $revenueCurrentM11}},{{ $revenueCurrentM10}},{{ $revenueCurrentM9}},{{ $revenueCurrentM8}},{{ $revenueCurrentM7}},{{ $revenueCurrentM6}},{{ $revenueCurrentM5}},{{ $revenueCurrentM4}},{{ $revenueCurrentM3}},{{ $revenueCurrentM2}},{{ $revenueCurrentM1}},{{ $revenueCurrentM}}], {
        type: 'line',
        width: '99.5%',
        height: '100',
        lineColor: '#25d5f2',
        fillColor: '#dffaff',
        lineWidth: 2,
        spotColor: undefined,
        minSpotColor: undefined,
        maxSpotColor: undefined,
        highlightSpotColor: undefined,
        highlightLineColor: undefined,
        resize: true
    });
    $("#sparkline-revenue4").sparkline([{{ $yesterday_day_6_order_week }},{{ $yesterday_day_5_order_week }},{{ $yesterday_day_4_order_week }},{{ $yesterday_day_3_order_week }},{{ $yesterday_day_2_order_week }},{{$yesterday_day_order_week}},{{$current_day_order_week}}], {
        type: 'line',
        width: '99.5%',
        height: '100',
        lineColor: '#fec957',
        fillColor: '#fff2d5',
        lineWidth: 2,
        spotColor: undefined,
        minSpotColor: undefined,
        maxSpotColor: undefined,
        highlightSpotColor: undefined,
        highlightLineColor: undefined,
        resize: true,
    });
</script>
<?php
$current_year = date('Y');
$last_year = date('Y',strtotime("-1 year"));
$last_to_last_year = date('Y',strtotime("-2 year"));
?>
<script>
    $(document).ready(function() {
        var currentDate = moment();
        var weekStart = currentDate.clone().startOf('isoWeek');
        var weekEnd = currentDate.clone().endOf('isoWeek');
        var monthStart = currentDate.clone().startOf('isoMonth');
        var monthEnd = currentDate.clone().endOf('isoMonth');
        var days = [];
        var months = [];
        for (var i = 0; i <= 6; i++) {
          days.push(moment(weekStart).add(i, 'days').format("DD/MM/y"));
        }
        for (var i = 0; i < 4; i++) {
            months.push(moment().subtract(i, 'months').format('MM/y'));
        }
        let total_user = JSON.parse('{!! json_encode($total_price_user) !!}')
        let total_user_month = JSON.parse('{!! json_encode($total_price_user_month) !!}')
        Morris.Area({
            element: 'morris_totalrevenue',
            behaveLikeLine: true,
            data: [
                { x: '{{$last_to_last_year}}', y: {{$revenueLastY1}}, },
                { x: '{{$last_year}}', y: {{$revenueLastY}}, },
                { x: '{{$current_year}} ',y: {{$revenueCurrentY}}, }
            ],
            xkey: 'x',
            ykeys: ['y'],
            labels: ['Y'],
            lineColors: ['#5969ff'],
            resize: true
        });
        if ($('#chartjs_bar').length) {
            var ctx = document.getElementById("chartjs_bar").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: days,
                    datasets: [{
                        label: 'Doanh thu',
                        data: total_user,
                        backgroundColor: "rgba(89, 105, 255,0.5)",
                        borderColor: "rgba(89, 105, 255,0.7)",
                    }]
                },
                options: {
                scales: {
                    xAxes: [{
                        ticks: {
                            fontSize: 14,
                            fontFamily: 'Circular Std Book',
                            fontColor: '#71748d',
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            fontSize: 14,
                            fontFamily: 'Circular Std Book',
                            fontColor: '#71748d',
                            callback: function (value, index, values) {
                              // add comma as thousand separator
                              return number_format(value) + 'đ'
                            },
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return number_format(tooltipItem.yLabel) + 'đ';
                        }
                    }
                }
            }
            });
        }
        if ($('#chartjs_bar_months').length) {
            var ctx = document.getElementById("chartjs_bar_months").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [...months].reverse(),
                    datasets: [{
                        label: 'Doanh thu',
                        data: total_user_month,
                        backgroundColor: "rgba(89, 105, 255,0.5)",
                        borderColor: "rgba(89, 105, 255,0.7)",
                    }]
                },
                options: {
                scales: {
                    xAxes: [{
                        ticks: {
                            fontSize: 14,
                            fontFamily: 'Circular Std Book',
                            fontColor: '#71748d',
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            fontSize: 14,
                            fontFamily: 'Circular Std Book',
                            fontColor: '#71748d',
                            callback: function (value, index, values) {
                              // add comma as thousand separator
                              return number_format(value) + 'đ'
                            },
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return number_format(tooltipItem.yLabel) + 'đ';
                        }
                    }
                }
            }
            });
        }
    });
</script>
@endsection

