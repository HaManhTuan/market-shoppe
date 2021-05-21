@extends('layouts.superAdmin.app')
@section('content')
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Thông tin tài khoản</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="{{ route('manager.dashboard') }}"> <i class="feather icon-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Thông tin tài khoản</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page-body start -->
<div class="page-body">
    <!--profile cover start-->
    <div class="row">
        <div class="col-lg-12">
            <div class="cover-profile">
                <div class="profile-bg-img">
                    <img class="profile-bg-img img-fluid" src="http://localhost/market-shoppe/public/superAdmin/assets/images/user-profile/bg-img1.jpg" alt="bg-img">
                    <div class="card-block user-info">
                        <div class="col-md-12">
                            <div class="media-left">
                                <a href="#" class="profile-image">
                                    <img class="user-img img-radius" src="http://localhost/market-shoppe/public/superAdmin/assets/images/avatar-4.jpg" alt="user-img">
                                </a>
                            </div>
                            <div class="media-body row">
                                <div class="col-lg-12">
                                    <div class="user-title">
                                        @if (Auth::guard('admins')->check())
                                        <h2>{{ Auth::guard('admins')->user()->name }}</h2>
                                        <span class="text-white">SuperAdmin</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--profile cover end-->
    <div class="row">
        <div class="col-lg-12">
            <!-- tab header start -->
            <div class="tab-header card">
                <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Thông tin tài khoản</a>
                        <div class="slide"></div>
                    </li>
                </ul>
            </div>
            <!-- tab header end -->
            <!-- tab content start -->
            <div class="tab-content">
                <!-- tab panel personal start -->
                <div class="tab-pane active" id="personal" role="tabpanel">
                    <!-- personal card start -->
                    <div class="card">
                        <div class="card-block">
                            <div class="view-info">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="general-info">
                                            <div class="row">
                                                <div class="col-lg-12 col-xl-6">
                                                    <div class="table-responsive">
                                                        <table class="table m-0">
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row">Tên</th>
                                                                    <td>{{$admin->name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Email</th>
                                                                    <td>{{$admin->email}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Số điện thoại</th>
                                                                    <td>{{$admin->phone}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Địa chỉ</th>
                                                                    <td>{{$admin->address}}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- end of table col-lg-6 -->
                                                <div class="col-lg-12 col-xl-6">
                                                    <div class="">
                                                        <form action="{{ route('manager.account.update') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{$admin->id}}">
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Tên</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="name" value="{{$admin->name}}" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Email</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="email" value="{{$admin->email}}" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Mật khẩu</label>
                                                                <div class="col-sm-10">
                                                                    <input type="password" name="password" class="form-control" placeholder="**************">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Số điện thoại</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="phone" value="{{$admin->phone}}" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Địa chỉ</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="address" value="{{$admin->address}}" class="form-control">
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Lưu</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- end of table col-lg-6 -->
                                            </div>
                                            <!-- end of row -->
                                        </div>
                                        <!-- end of general info -->
                                    </div>
                                    <!-- end of col-lg-12 -->
                                </div>
                                <!-- end of row -->
                            </div>
                            <!-- end of view-info -->
                            <!-- end of edit-info -->
                        </div>
                        <!-- end of card-block -->
                    </div>
                    <!-- personal card end-->
                </div>
            </div>
            <!-- tab content end -->
        </div>
    </div>
</div>
@endsection
