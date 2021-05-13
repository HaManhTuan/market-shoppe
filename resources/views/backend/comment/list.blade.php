@extends('layouts.admin.admin')
@section('content')
<link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap-4.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/css/animate.css') }}">
<script src="{{ asset('admin/assets/js/plugins/notify.js')}}"></script>
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
            <h2 class="pageheader-title">Danh sách bình luận
            </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Danh mục</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách các các bình luận</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <table class="table table-striped table-bordered" id="simpletable">
            <thead>
                <tr>
                    <th scope="col">TT</th>
                    <th scope="col">Họ tên</th>
                    <th scope="col">Sản phẩm</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data_comment) > 0)
                    @foreach ($data_comment as $key => $element)
                        <tr class="tr-item">
                            <td>{{$key + 1}}</td>
                            <td>{{$element->customer->name}}</td>
                            <td>{{$element->product->name}}</td>
                            <td>{{$element->content}}</td>
                            <td>
                                <span class="badge {{ $element->status == 1 ? 'badge-success' : 'badge-danger' }}"
                                    onclick="window.location.href='{{ url('admin/comment/change/').'/'.$element->id }}'">
                                    {{ $element->status == 1 ? 'Hiện' : 'Ẩn' }}</span>
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
<script src="{{ asset('admin/assets/js/plugins/jquery.validate.min.js')}}"></script>
<script src="{{ asset('admin/assets/js/plugins/sweetalert2.all.js')}}"></script>
<script src="{{ asset('admin/dropify.js') }}"></script>

@endsection
