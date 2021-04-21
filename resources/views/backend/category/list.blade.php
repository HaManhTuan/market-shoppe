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
            <h2 class="pageheader-title">Danh sách danh mục sản phẩm
            </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Danh mục</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách các danh mục có sẵn</li>
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
                <button class="btn btn-primary" style="padding: 8px 15px;" data-toggle="modal" data-target="#AddModel"><i class="mdi mdi-plus" ></i> Đăng kí danh mục
                </button>
                <small>Nếu không có danh mục nào phù hợp với sản phẩm của bạn. Hãy đăng kí danh mục mới</small>
            </div>

            <div class="card-body">
                @if ($dataCate->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên</th>
                                <th scope="col" style="text-align:center">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $stt = 1;
                                $none="None";
                            @endphp
                            @foreach ($dataCate as $record)
                                <tr>
                                    <td>{{ $stt++ }}</td>
                                    <td>{{ $record->name }}</td>
                                    <td align="center">
                                        @if ($record['status'] == "1" && $record['status_cus'] == "1")
                                        <span class=" badge-dot badge-success mr-1"></span>
                                        @else
                                        <span class="badge-dot badge-brand mr-1"></span>
                                        @endif
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
<div class="modal fade" id="AddModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog animated bounce" role="document"  >
         <form method="POST" action="{{ url('admin/category/add') }}" id="frm-add-cate" onsubmit="return false;" enctype='multipart/form-data'>
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm danh mục</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></a>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Tên<font color="#a94442"> (*)</font></label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Tên danh mục" data-rule-required="true" data-msg-required="Vui lòng tên danh mục" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Danh mục gốc<font color="#a94442"> (*)</font></label>
                            <select class="form-control custom-select" name="parent_id" id="parent_id" data-rule-required="true" data-msg-required="Vui lòng chọn danh mục." >
                                <option value="" disabled="disabled">--- Select ---</option>
                                <option value="0" selected="selected">None</option>
                                {!! $data_select !!}
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Mô tả</label>
                            <textarea rows="2" cols="2" name="description" class="form-control"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Hủy</a>
                    <button type="submit" class="btn btn-primary" id="btn-add-cate">Lưu thay đổi</button>
                </div>
            </div>
         </form>
    </div>
</div>
<script src="{{ asset('admin/assets/js/plugins/jquery.validate.min.js')}}"></script>
<script src="{{ asset('admin/assets/js/plugins/sweetalert2.all.js')}}"></script>
<script src="{{ asset('admin/dropify.js') }}"></script>
<script>
    $('.dropify').dropify();
    $(document).on('click', '#btn-add-cate', function() {
    $("#frm-add-cate").validate({
        submitHandler: function() {
            let action = $("#frm-add-cate").attr('action');
            let method = $("#frm-add-cate").attr('method');
            let formData = $("#frm-add-cate").serialize();
            $.ajax({
                url: action,
                type: method,
                data: formData,
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                },
                success: function(data) {
                    if (data.status == '_success') {
                        $("#AddModel").modal('hide');
                        Swal({
                            title: data.msg,
                            showCancelButton: false,
                            showConfirmButton: false,
                            type: 'success',
                            timer: 2000
                        }).then(() => {
                            console.log(data);
                            location.reload();
                        });
                    } else {
                        Swal({
                            title: data.msg,
                            showCancelButton: false,
                            showConfirmButton: false,
                            type: 'error',
                            timer: 2000
                        });
                    }
                },
                error: function(err) {
                    //console.log(err);
                    Swal({
                        title: 'Error ' + err.status,
                        text: err.responseText,
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        type: 'error'
                    });
                }
            });


        }
    });
});
</script>
@endsection
