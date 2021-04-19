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
            <h2 class="pageheader-title">Sửa sản phẩm
            </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Sản phẩm</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sửa</li>
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
                <form  method="POST" id="addSlideForm" action="{{ url('admin/product/edit-pro/'.$product_detail->url) }}" enctype='multipart/form-data'>
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="normal-field" class="control-label">Tên sản phẩm:</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" id="name_pro" name="name" class="form-control @error('name') is-invalid @enderror" 
                                placeholder="Hãy nhập tên sản phẩm"   value="{{ $product_detail->name }}">
                                @error('name')
                                    <small class="text-danger font-16">{{ $message }}.</small>
                                @enderror
                            </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="hint-field" class="control-label">
                                Danh mục sản phẩm
                                </label>
                            </div>
                            <div class="col-sm-7">
                                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" >
                                    <option value="" disabled="disabled" selected="selected">--- Chọn danh mục ---</option>
                                    {!! $data_select !!}
                                </select>
                                @error('category_id')
                                    <small class="text-danger font-16">{{ $message }}.</small>
                                 @enderror
                            </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="hint-field" class="control-label">
                                Số lượng
                                </label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" id="stock" name="stock" 
                                class="form-control numbers @error('stock') is-invalid @enderror" 
                             placeholder="Hãy nhập số lượng" 
                            onkeyup="this.value = number_format(this.value,0,'','.');" 
                            onblur="this.value = number_format(this.value,0,'','.')" 
                            value="{{ $product_detail->stock }}">
                                @error('stock')
                                    <small class="text-danger font-16">{{ $message }}.</small>
                                @enderror
                            </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="hint-field" class="control-label">
                                Giá
                                </label>
                            </div>
                            <div class="col-sm-7">
                            <input type="text" id="price" name="price" class="form-control numbers @error('price') is-invalid @enderror" data-rule-required="true" data-msg-required="Vui lòng nhập giá." placeholder="Hãy nhập giá" 
                            value="{{ $product_detail->price }}"
                            onkeyup="this.value = number_format(this.value,0,'','.');" onblur="this.value = number_format(this.value,0,'','.')">
                            @error('price')
                                <small class="text-danger font-16">{{ $message }}.</small>
                            @enderror
                            </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="hint-field" class="control-label">
                                Giá khuyến mại
                                </label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" value="{{ $product_detail->promotional_price }}" id="promotional_price" name="promotional_price" class="form-control numbers" onkeyup="this.value = number_format(this.value,0,'','.');" onblur="this.value = number_format(this.value,0,'','.')" value="0">
                            </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label class="control-label" for="hint-field">Mô tả sản phẩm:</label>
                            </div>
                            <div class="col-sm-9">
                            <textarea name="description" id="description" class="form-control @error('description') 
                            is-invalid @enderror">
                            {{ $product_detail->description }}
                        </textarea>
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
                                <label class="control-label" for="hint-field">Chi tiết sản phẩm:</label>
                            </div>
                            <div class="col-sm-9">
                            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" >
                                {{ $product_detail->content }}</textarea>
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
                                <label class="control-label" for="description">Thương hiệu:</label>
                            </div>
                            <div class="col-sm-9">
                             <select class="form-control" name="brand_id" id="brand_id">
                                 <option selected="" disabled="">--Chọn--</option>
                                 @foreach ($dataBrand as $element)
                                     <option value="{{$element->id}}">{{$element->name}}</option>}
                                 @endforeach
                             </select>
                             @error('brand_id')
                             <small class="text-danger font-16">{{ $message }}.</small>
                            @enderror
                            </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label class="control-label" for="description">Ảnh đại diện sản phẩm:</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="hidden" name="old_file" value="{{ $product_detail->image }}">
                             <input type="file" name="file" id="file" class="dropify @error('file') is-invalid @enderror" 
                             accept="image/*" data-show-loader="true" data-default-file="{{ asset('public/uploads/images/products/'.$product_detail->image) }}"/>
                             @error('file')
                             <small class="text-danger font-16">{{ $message }}.</small>
                            @enderror
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
                                    <input type="checkbox" {{ $product_detail->status == "1" ? 'checked' : "" }}  class="custom-control-input" value="1" name="status">
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
<script>
     $('#brand_id option[value="{{$product_detail->brand_id}}"]').attr("selected", "selected");
</script>
<script src="{{ asset('public/admin/dropify.js') }}"></script>
<script src="{{ asset('public/admin/assets/js/plugins/jquery.validate.min.js')}}"></script>
<script>
    $(".dropify").dropify();
</script>
 @endsection