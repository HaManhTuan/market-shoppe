@extends('layouts.admin.admin')
@section('content')
<link rel="stylesheet" href="{{ asset('public/frontend/css-custom/dropify.min.css') }}">
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
 <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Thêm mới Hình ảnh
            </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Hình ảnh</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
        <div class="card">
            <div class="card-body">
                <form action="" method="POST" id="addSlideForm" action="{{ url('admin/media/add-media') }}" enctype='multipart/form-data' onsubmit="return false;">
                    @csrf
                        <div class="form-group">
                            <label id="email-label" for="email" class="control-label col-sm-2">Slide <span class="required">*</span></label>
                            <div class="col-xs-12 col-sm-10">
                                <input type="file" id="input-file-now" name="image" class="dropify" data-rule-required="true" data-msg-required="Vui lòng chọn slide.">
                            </div>
                        </div>
                        <div class="form-group">
                            <label id="position-label" for="position" class="control-label col-sm-2">Vị trí <span class="required">*</span></label>
                            <div class="col-xs-12 col-sm-4">
                                <select name="position" id="position" class="form-control">
                                    <option value="" selected disabled>--Chọn--</option>
                                    <option value="1">Vị trí 1</option>
                                    <option value="2">Vị trí 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-8" style="margin-top: 15px;">
                                <button type="submit" class="btn btn-primary" id="btn-save">Thêm</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/frontend/js-custom/dropify.min.js') }}"></script>
<script src="{{ asset('public/admin/assets/js/plugins/jquery.validate.min.js')}}"></script>
<script>
    $(".dropify").dropify();
    $("#btn-save").click(function() {
        $("#addSlideForm").validate({
            submitHandler: function() {
                let action = $("#addSlideForm").attr('action');
                let method = $("#addSlideForm").attr('method');
                let form = document.querySelector("#addSlideForm");
                var formData = new FormData(form);
                $.ajax({
                    url: action,
                    type: method,
                    processData: false,
                    contentType: false,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        console.log(data);
                       if (data.status == '_error') {
                            Swal({
                                title: data.msg,
                                showCancelButton: false,
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                type: 'error'
                            });
                        } else {
                            Swal({
                                title: data.msg,
                                showCancelButton: false,
                                showConfirmButton: false,
                                confirmButtonText: 'OK',
                                type: 'success',
                                timer: 2000
                            }).then(() => {
                                window.location.href = "{{ url('admin/media/view-media') }}";
                            });
                        }
                    },
                    error: function(err) {
                        console.log(err);
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