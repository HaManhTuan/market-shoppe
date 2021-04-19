@extends('layouts.admin.admin')
@section('content')
<link rel="stylesheet" href="{{ asset('public/admin/dropify.css') }}">
<style>
    .error{
        color: brown;
        font-size: 14px;
        padding: 5px;
    }
</style>
<link rel="stylesheet" href="{{ asset('public/admin/assets/css/bootstrap-4.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/assets/css/animate.css') }}">
<script src="{{ asset('public/admin/assets/js/plugins/notify.js')}}"></script>
@if(Session::has('flash_message_success'))
<script>
  $(document).ready(function() {
      $(".breadcrumb").notify("{{ Session::get('flash_message_success') }}", "success");
  });
</script>
 @endif
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
            <h2 class="pageheader-title">List Landing Page
            </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Landing Page</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                @can('add_landing')
                <div class="card-header"><span class="badge badge-primary rd-add" style="padding: 8px 15px;"
                    ><i class="mdi mdi-plus" ></i> Thêm mới</span>
                    <span class="dashboard-spinner spinner-custom custom-load"></span>
                </div>
                @endcan
            </div>
            <div class="card-body">
               @if ($dataLanding->count() > 0)
                <table class="table table-striped table-bordered" id="brand-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên Website</th>
                                <th style="width: 200px;">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $stt = 1;
                            @endphp
                            @foreach ($dataLanding as $element)
                                <tr class="tr-item" id="tr-item-{{ $element->id}}">
                                    <td>{{$stt++}}</td>
                                    <td>{{$element->name}}</td>
                                    
                                    <td>
                                        @can('edit_landing')
                                        <button class="btn btn-primary" onclick="window.location.href='{{ url('admin/landingpage/edit-landing/'.$element->id) }}'" data-toggle="tooltip" data-placement="top" title="Sửa Landing Page">Sửa</button>
                                        @endcan
                                        @can('delete_landing')
                                        <button class="btn btn-danger btn-del" data-id="{{ $element->id }}" data-toggle="tooltip" data-placement="top" title="Xóa Landing Page">Xóa</button>
                                        @endcan
                                    </td>                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                 <p align="center" style="font-weight:bold">Không có dữ liệu</p>   
                @endif 
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/admin/assets/js/js-custom/myjs.js') }}"></script>
<script src="{{ asset('public/admin/assets/js/plugins/jquery.validate.min.js')}}"></script>
<script src="{{ asset('public/admin/assets/js/plugins/sweetalert2.all.js')}}"></script>
<script src="{{ asset('public/admin/dropify.js') }}"></script>
@endsection