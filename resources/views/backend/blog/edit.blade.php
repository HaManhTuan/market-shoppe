@extends('layouts.admin.admin')
@section('content')
<link rel="stylesheet" href="{{ asset('public/admin/dropify.css') }}">
<style>
    .error{
        color: brown;
        font-size: 14px;
        padding: 5px;
    }
    .font-16{
        font-size:16px;
    }
</style>
<link rel="stylesheet" href="{{ asset('public/admin/assets/css/bootstrap-4.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/assets/css/animate.css') }}">
<script src="{{ asset('public/admin/assets/js/plugins/notify.js')}}"></script>

 <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Chỉnh sửa tin tức
            </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tin tức</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa</li>
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
                <form  method="POST" id="addSlideForm" action="{{ url('admin/blog/edit-blog/'.$dataBlog->id) }}" enctype='multipart/form-data'>
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="normal-field" class="control-label">Tiêu để tin tức:</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" id="name_pro" name="name" class="form-control" 
                                value="{{ $dataBlog->name }}">
                            </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label class="control-label" for="hint-field">Mô tả tin tức:</label>
                            </div>
                            <div class="col-sm-9">
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ $dataBlog->description }}</textarea>
                            <script>CKEDITOR.replace('description','', 'full')</script>
                            @error('description')
                                <small class="text-danger font-16">{{ $message }}.</small>
                            @enderror
                            </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label class="control-label" for="hint-field">Chi tiết tin tức:</label>
                            </div>
                            <div class="col-sm-9">
                            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" >
                                {{ $dataBlog->content }}</textarea>
                            <script>CKEDITOR.replace('content','', 'full')</script>
                            @error('content')
                                <small class="text-danger font-16">{{ $message }}.</small>
                            @enderror
                            </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label class="control-label" for="description">Ảnh đại diện tin tức:</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="hidden" name="old_file" value="{{ $dataBlog->image }}">
                             <input type="file" name="file" id="file" class="dropify" accept="image/*" data-show-loader="true" data-default-file="{{ asset('public/uploads/images/blog/'.$dataBlog->image) }}"/>
                            
                            </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label class="control-label" for="description">Trạng thái</label>:</label>
                            </div>
                            <div class="col-sm-9">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" {{ $dataBlog->status == "1" ? 'checked' : "" }} class="custom-control-input" value="1" name="status">
                                    <span class="custom-control-label">Active</span>
                                </label>
                            </div>
                     </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                            <div class="col-sm-9" style="margin-top: 15px;">
                                <button type="submit" class="btn btn-primary" id="btn-save" style="width:100%">Sửa</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/admin/dropify.js') }}"></script>
<script src="{{ asset('public/admin/assets/js/plugins/jquery.validate.min.js')}}"></script>
<script>
    $(".dropify").dropify();
</script>
 @endsection