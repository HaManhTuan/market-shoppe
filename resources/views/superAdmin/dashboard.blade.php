@extends('layouts.superAdmin.app')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<div class="page-body">
    <div class="row">
        <!-- task, page, download counter  start -->
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h5 class="text-c-yellow">{{ number_format($allEngine) }} đ</h5>
                            <h6 class="text-muted m-b-0">Thu nhập</h6>
                        </div>
                        <div class="col-4 text-right">
                            <i class="feather icon-bar-chart f-28"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-yellow">
                    <div class="row align-items-center">

                        <div class="col-3 text-right">
                            <i class="feather icon-trending-up text-white f-16"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h5 class="text-c-green f-w-600">{{ number_format($allView) }}+</h5>
                            <h6 class="text-muted m-b-0">Lượt xem</h6>
                        </div>
                        <div class="col-4 text-right">
                            <i class="feather icon-file-text f-28"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-green">
                    <div class="row align-items-center">
                        <div class="col-3 text-right">
                            <i class="feather icon-trending-up text-white f-16"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h5 class="text-c-pink f-w-600">{{ count($allOrder) }}</h5>
                            <h6 class="text-muted m-b-0">Đơn hàng</h6>
                        </div>
                        <div class="col-4 text-right">
                            <i class="feather icon-calendar f-28"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-pink">
                    <div class="row align-items-center">
                        <div class="col-3 text-right">
                            <i class="feather icon-trending-up text-white f-16"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h5 class="text-c-blue f-w-600">{{ count($allUser) }}</h5>
                            <h6 class="text-muted m-b-0">Gian hàng</h6>
                        </div>
                        <div class="col-4 text-right">
                            <i class="feather icon-download f-28"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-blue">
                    <div class="row align-items-center">
                        <div class="col-3 text-right">
                            <i class="feather icon-trending-up text-white f-16"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-md-6">
            <div class="card table-card">
                <div class="card-header">
                    <h5>Doanh thu tuần này</h5>
                </div>
                <div class="card-block">
                    <canvas id="chartjs_bar"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6">
            <div class="card table-card">
                <div class="card-header">
                    <h5>Doanh thu 4 tháng gần nhất</h5>
                </div>
                <div class="card-block">
                    <canvas id="chartjs_bar_months"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- sale start -->
        <div class="col-xl-5 col-md-12">
            <div class="card table-card">
                <div class="card-header">
                    <h5>Top gian hàng bán chạy</h5>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table table-hover table-borderless">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Gian hàng</th>
                                <th>Lượt bán</th>
                                <th class="text-right">Doanh Thu</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($allOrderOfUser && count($allOrderOfUser) > 0)
                                @foreach ($allOrderOfUser as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name_display }}</td>
                                        @foreach ($item->product as $vale)
                                            <td>{{ $vale->sum_buy }}</td>
                                        @endforeach

                                        @foreach ($item->order_user as $value1)
                                        <td>{{ number_format($value1->sum_total_price) }} đ</td>
                                        @endforeach

                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-7 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Sản phẩm bán chạy</h5>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table table-hover table-borderless">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên sản phẩm</th>
                                <th>Gian hàng</th>
                                <th>Lượt bán</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if ($productCoutBuy && count($productCoutBuy) > 0)
                                @foreach ($productCoutBuy as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->user->name_display }}</td>
                                        <td>{{ ($item->buy_count) }}</td>

                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-md-12">
            <div class="card table-card">
                <div class="card-header">
                    <h5>Đơn hàng mới</h5>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        @if ($ordersNews->count() > 0)
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
                                <tr class='clickable-row' onclick="location.href='{{ url('manager/orders/view-orderdetail/'.$item->id) }}'">

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
    </div>
    </div>
</div>
<script>
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
    if ($('#chartjs_bar').length) {
        var ctx = document.getElementById("chartjs_bar").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: days,
                datasets: [{
                    label: 'Doanh thu',
                    data: total_user,
                    backgroundColor: "rgb(254, 147, 101)",
                    borderColor: "rgb(254, 147, 101)",
                }]
            },
            options: {
            scales: {
                xAxes: [{
                    ticks: {
                        fontSize: 14,
                        fontFamily: 'Circular Std Book',
                        fontColor: '#fe9365',
                    }
                }],
                yAxes: [{
                    ticks: {
                        fontSize: 14,
                        fontFamily: 'Circular Std Book',
                        fontColor: '#fe9365',
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
                    backgroundColor: "rgb(10, 194, 130)",
                    borderColor: "rgb(10, 194, 130)",
                }]
            },
            options: {
            scales: {
                xAxes: [{
                    ticks: {
                        fontSize: 14,
                        fontFamily: 'Circular Std Book',
                        fontColor: '#eb3422',
                    }
                }],
                yAxes: [{
                    ticks: {
                        fontSize: 14,
                        fontFamily: 'Circular Std Book',
                        fontColor: '#eb3422',
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
</script>
@endsection
