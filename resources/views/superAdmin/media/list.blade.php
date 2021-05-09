@extends('layouts.superAdmin.app')
@section('content')
<link rel="stylesheet" href="{{ asset('admin/dropify.css') }}">
<style>
    .error{
        color: brown;
        font-size: 14px;
        padding: 5px;
    }
</style>
<link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap-4.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/css/animate.css') }}">
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
            <h2 class="pageheader-title">Cấu hình banner
            </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Danh sách</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Nội dung</li>
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
                <form id="user-form" action="{{ url('manager/media/edit-media') }}" class="form-horizontal form-label-left"  method="post" enctype='multipart/form-data'>
                    @csrf
                    <fieldset>
                       <legend class="section">Banner</legend>
                       <div class="form-group row">
                          <div class="col-sm-8">
                             <input type="hidden" name="image_1_old" value="{{ $media->image_1 }}">
                             <input type="file" id="image_1" name="image_1" class="form-control input-transparent dropify"
                             data-default-file="{{ asset('uploads/images/media/'.$media->image_1) }}">
                          </div>
                          <div class="col-sm-4">
                              <div>
                                <input type="hidden" name="image_2_old" value="{{ $media->image_2 }}">
                                <input type="file" id="image_2" name="image_2" class="form-control input-transparent dropify"
                                data-default-file="{{ asset('uploads/images/media/'.$media->image_2) }}">
                              </div>
                              <div>
                                <input type="hidden" name="image_3_old" value="{{ $media->image_3 }}">
                                <input type="file" id="image_3" name="image_3" class="form-control input-transparent dropify"
                                data-default-file="{{ asset('uploads/images/media/'.$media->image_3) }}">
                              </div>
                         </div>
                       </div>
                    </fieldset>
                    <div class="form-actions">
                       <div class="row">
                          <div class="col-sm-8 col-sm-offset-2">
                             <button type="submit" class="btn btn-primary" id="edit-user">Lưu</button>
                          </div>
                       </div>
                    </div>
                 </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('admin/assets/js/plugins/jquery.validate.min.js')}}"></script>
<script src="{{ asset('admin/assets/js/plugins/sweetalert2.all.js')}}"></script>
<script src="{{ asset('admin/dropify.js') }}"></script>
<script>
    $(".dropify").dropify();
</script>
@if(Session::has('flash_message_error'))
<script>
   $.notify("{!! session('flash_message_error') !!}","error");
</script>
@endif
@if(Session::has('flash_message_success'))
<script>
   $.notify("{!! session('flash_message_success') !!}","success");
</script>
@endif
@endsection
