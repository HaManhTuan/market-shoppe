@extends('layouts.superAdmin.app')
@section('content')
    <!-- sweet alert framework -->
    <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/bower_components/sweetalert/css/sweetalert.css') }}">
<!-- Notification.css -->
<link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/assets/pages/notification/notification.css') }}">
  <!-- animation nifty modal window effects css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/assets/css/component.css') }}">
     <!-- Switch component css -->
     <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/bower_components/switchery/css/switchery.min.css') }}">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Danh sách người bán - Khách hành đăng kí</h4>
                    <span>Quản lý khách hàng đăng kí gian hàng</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('manager.dashboard') }}">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Gian hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="simpletable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th style="width:20px;">STT</th>
                                <th>Tên</th>
                                <th>Tỉnh thành</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if (count($user) > 0)
                                @foreach ($user as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->province ? $item->province->name : '-' }}
                                        </td>
                                        <td>
                                            @if ($item->admin == 1)
                                            <label class="label label-success"> Đã kích hoạt</label>
                                            @else
                                            <label class="label label-danger">  Chưa kích hoạt</label>
                                            @endif</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary waves-effect">
                                           <i class="fa fa-eye"></i></button>
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
@endsection
