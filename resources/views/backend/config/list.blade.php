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
            <h2 class="pageheader-title">Danh sách nội dung
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
                <form id="user-form" action="{{ url('admin/config/edit-config') }}" class="form-horizontal form-label-left"  method="post" enctype='multipart/form-data'>
                    @csrf
                    <fieldset>
                       <legend class="section">Thông tin web</legend>
                       <div class="form-group">
                          <label class="control-label col-sm-2" for="last-name">Logo <span class="required">*</span></ul></label>
                          <div class="col-sm-8">
                             
                             <input type="hidden" name="logo_old" value="{{ $config->logo }}">
                             <input type="file" id="logo" name="logo" class="form-control input-transparent dropify"
                             data-default-file="{{ asset('public/uploads/images/config/'.$config->logo) }}">
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="control-label col-sm-2" for="last-name">Icon <span class="required">*</span></ul></label>
                          <div class="col-sm-8">
                    
                             <input type="hidden" name="icon_old" value="{{ $config->icon }}">
                             <input type="file" id="icon" name="icon" class="form-control input-transparent dropify" 
                             data-default-file="{{ asset('public/uploads/images/config/'.$config->icon) }}">
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="control-label col-sm-2" for="last-name">Email <span class="required">*</span></ul></label>
                          <div class="col-sm-8">
                             <input type="email" id="email" name="email" class="form-control" value="{{ $config->email }}">
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="control-label col-sm-2" for="last-name">Số điện thoại <span class="required">*</span></ul></label>
                          <div class="col-sm-8">
                             <input type="text" id="phone" name="phone" class="form-control " value="{{ $config->phone }}">
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="control-label col-sm-2" for="last-name">Địa chỉ<span class="required">*</span></ul></label>
                          <div class="col-sm-8">
                             <input type="text" id="address" name="address" class="form-control " value="{{ $config->address }}">
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="control-label col-sm-2" for="last-name">Title<span class="required">*</span></ul></label>
                          <div class="col-sm-8">
                             <input type="text" id="title" name="title" class="form-control " value="{{ $config->title }}">
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="control-label col-sm-2" for="last-name">Description<span class="required">*</span></ul></label>
                          <div class="col-sm-8">
                             <textarea name="description" class="form-control" rows="4">{{ $config->description }}</textarea>
                          </div>
                       </div>
                    </fieldset>
                    <div class="form-actions">
                       <div class="row">
                          <div class="col-sm-8 col-sm-offset-2">
                              @can('edit_config')
                             <button type="submit" class="btn btn-primary" id="edit-user">Sửa</button>
                             @endcan
                          </div>
                       </div>
                    </div>
                 </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/admin/assets/js/plugins/jquery.validate.min.js')}}"></script>
<script src="{{ asset('public/admin/assets/js/plugins/sweetalert2.all.js')}}"></script>
<script src="{{ asset('public/admin/dropify.js') }}"></script>
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