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

    </div>
</div>
<div class="ecommerce-widget">
    <div class="row">
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-muted">Tổng doanh thu</h5>
                    <div class="metric-value d-inline-block">
                        <h4 class="mb-1"></h4>
                    </div>
                    <div class="metric-label d-inline-block float-right text-success font-weight-bold">

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
                        <h4 class="mb-1"></h4>
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
                       <h4 class="mb-1"></h4>
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
        <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"> Tổng doanh thu</h5>
                </div>
                <div class="card-body">
                    <div id="morris_totalrevenue"></div>
                </div>
                <div class="card-footer">


                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end product sales  -->
        <!-- ============================================================== -->
        <div class="col-xl-4 col-lg-12 col-md-6 col-sm-12 col-12">
            <!-- ============================================================== -->
            <!-- top perfomimg  -->
            <!-- ============================================================== -->
            <div class="card">
                <h5 class="card-header">Top Khách Hàng Mua Nhiều</h5>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table no-wrap p-table">
                            <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0">Tên</th>
                                    <th class="border-0">Đơn hàng</th>
                                    <th class="border-0">Tổng tiền</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end top perfomimg  -->
            <!-- ============================================================== -->
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

