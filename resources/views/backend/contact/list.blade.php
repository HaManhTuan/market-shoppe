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
            <h2 class="pageheader-title">Danh sách liên hệ
            </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Liên hệ</a></li>
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
               @if ($dataContact->count() > 0)
                <table class="table table-striped table-bordered" id="brand-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Họ tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Xem</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $stt = 1;
                            @endphp
                            @foreach ($dataContact as $element)
                                <tr class="tr-item" id="tr-item-{{ $element->id}}">
                                    <td>{{$stt++}}</td>
                                    <td>{{$element->name}}</td>
                                    <td>{{$element->email}}</td>
                                    <td>{{$element->phone}}</td>
                                    <td>
                                        <button class="btn btn-primary btn-view-contact" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" data-toggle="modal" data-target="#ViewModel"
                                        data-id="{{ $element->id}}" data-action="{{ url('admin/contact/view-modal') }}">Xem</button>
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
<div class="modal fade" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog animated bounce" role="document">
         <form method="POST"  id="frm-edit-cate" onsubmit="return false;" enctype='multipart/form-data'>
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></a>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Đóng</a>
                </div>
            </div>
         </form>
    </div>
</div>
<script src="{{ asset('public/admin/assets/js/js-custom/myjs.js') }}"></script>
<script src="{{ asset('public/admin/assets/js/plugins/jquery.validate.min.js')}}"></script>
<script src="{{ asset('public/admin/assets/js/plugins/sweetalert2.all.js')}}"></script>
<script src="{{ asset('public/admin/dropify.js') }}"></script>
<script>
    $(document).on("click", ".btn-view-contact", function() {
    let id = $(this).attr('data-id');
    let action = $(this).attr('data-action');
    $.ajax({
        url: action,
        type: 'POST',
        data: { id: id },
        dataType: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        },
        success: function(data) {
            console.log(data);
            $("#ViewModal .modal-body").html(data.body);
            
            $("#ViewModal").modal('show');
        },
        error: function(err) {
            console.log(err);
            $.notify(err.status,'error');
        }
    });
    return false;
});
</script>
@endsection