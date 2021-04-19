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
            <h2 class="pageheader-title">List Category
            </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Category</a></li>
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
           @can('add_category')
            <div class="card-header">
                <button class="btn btn-primary" style="padding: 8px 15px;" data-toggle="modal" data-target="#AddModel"><i class="mdi mdi-plus" ></i> Add
                </button>
            </div>
           @endcan
            <div class="card-body">
                @if ($dataCate->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Child</th>
                                <th scope="col" class="text-center">Icon</th>
                                <th scope="col" style="text-align:center">ST</th>
                                <th style="width: 200px;">Action</th>
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
                                    <td>
                                        @foreach ($record->categories as $item)
                                           <span class="badge badge-success"> {{ $item->name }}</span>
                                        @endforeach 
                                    </td>
                                    <td align="center">
                                        @if(isset($record->icon) && $record->icon != "")
                                        <img src="{{ asset('public/uploads/images/category/'.$record->icon) }}">
                                        @endif
                                        
                                    </td>
                                    <td align="center">
                                        @if ($record['status'] == "1")
                                        <span class=" badge-dot badge-success mr-1"></span>
                                        @else
                                        <span class="badge-dot badge-brand mr-1"></span>
                                        @endif
                                    </td>
                                    <td>
                                        @can('edit_category')
                                        <button class="btn btn-primary btn-edit-category"  data-toggle="modal" data-target="#EditModel"
                                        data-id="{{ $record->id}}" data-action="{{ url('admin/category/edit-modal') }}">Edit</button>
                                        @endcan
                                        @can('delete_category')
                                        <button class="btn btn-danger btn-del-cate" data-id="{{ $record->id }}" 
                                            data-action="{{ url('admin/category/delete') }}">Delete</button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                 <p align="center" style="font-weight:bold">Data is empty</p>   
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
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></a>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title<font color="#a94442"> (*)</font></label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Math" data-rule-required="true" data-msg-required="Vui lòng nhập mật khẩu mới" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Select parent category<font color="#a94442"> (*)</font></label>
                            <select class="form-control custom-select" name="parent_id" id="parent_id" data-rule-required="true" data-msg-required="Vui lòng chọn danh mục." >
                                <option value="" disabled="disabled" selected="selected">--- Select ---</option>
                                <option value="0">None</option>
                                {!! $data_select !!}
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea rows="2" cols="2" name="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Icon</label>
                            <input type="file" id="input-file-now" class="dropify form-control" name="file">
                        </div>
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" checked="" class="custom-control-input" value="1" name="status">
                            <span class="custom-control-label">Active</span>
                        </label>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-primary" id="btn-add-cate">Save changes</button>
                </div>
            </div>
         </form>
    </div>
</div>
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog animated bounce" role="document">
         <form method="POST" action="{{ url('admin/category/edit') }}" id="frm-edit-cate" onsubmit="return false;" enctype='multipart/form-data'>
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></a>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-primary" id="btn-edit-save">Save changes</button>
                </div>
            </div>
         </form>
    </div>
</div>
<script src="{{ asset('public/admin/assets/js/plugins/jquery.validate.min.js')}}"></script>
<script src="{{ asset('public/admin/assets/js/plugins/sweetalert2.all.js')}}"></script>
<script src="{{ asset('public/admin/assets/js/cate.js') }}"></script>
<script src="{{ asset('public/admin/dropify.js') }}"></script>
<script>
    $('.dropify').dropify();
</script>
@endsection
