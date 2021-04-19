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
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Media</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
        <div class="section-block">
            <h5 class="section-title">Danh sách các hình ảnh </h5>
            <p>Nếu thay đổi nó thì bên ngoài giao diện chinh cũng thay đổi theo</p>
        </div>
        <div class="tab-vertical">
            <ul class="nav nav-tabs" id="myTab3" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" id="home-vertical-tab" data-toggle="tab" href="#home-vertical" role="tab" aria-controls="home" aria-selected="true">Slider <span style="display: block;
                        margin-left: -4px;">Vị trí: 1</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-vertical-tab" data-toggle="tab" href="#profile-vertical" role="tab" aria-controls="profile" aria-selected="false">Hình ảnh <span style="display: block;
                        margin-left: -4px;">Vị trí: 2</span></a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent3">
                <div class="tab-pane fade active show" id="home-vertical" role="tabpanel" aria-labelledby="home-vertical-tab">
                    <p class="lead"> Đây là phần hình ảnh chạy tự động ở ngay trên đầu trang.</p><p></p> Bạn nên để kích thước là 880 x 500 px và vị trí là 1 </p>
                    @can('add_media') 
                    <a id="btn-add" class="btn btn-primary mb-2" href="{{ url('admin/media/add-media') }}" role="button">Thêm mới</a>
                    @endcan
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th style="width: 300px">Image</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $stt1 = 1;
                            @endphp
                            @foreach ($dataMePos1 as $item)
                                <tr>
                                    <td scope="row">{{ $stt1++ }}</td>
                                    <td><img src="{{ asset('public/uploads/images/media/'.$item->image) }}" style="max-width: 50%;"></td>
                                    <td>
                                        @can('edit_media') 
                                        <button  class="btn btn-primary btn-edit"  role="button" data-id="{{ $item->id}}">Sửa</button>
                                        @endcan
                                        @can('delete_media') 
                                        <button  class="btn btn-danger btn-del"  role="button" data-id="{{ $item->id}}">Xóa</button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="profile-vertical" role="tabpanel" aria-labelledby="profile-vertical-tab">
                    <h3>Đây là hình ảnh phía bên trái trang</h3>
                    <p> Bạn nên chọn kích thước 280 x 310 px và vị trí chọn 2</p>  
                    @can('add_media') 
                    <a id="btn-add" class="btn btn-primary mb-2" href="{{ url('admin/media/add-media') }}" role="button">Thêm mới</a>
                    @endcan
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th style="width: 300px">Image</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $stt2 = 1;
                            @endphp
                            @foreach ($dataMePos2 as $item)
                                <tr>
                                    <td scope="row">{{ $stt2++ }}</td>
                                    <td><img src="{{ asset('public/uploads/images/media/'.$item->image) }}" style="max-width: 50%;"></td>
                                    <td>
                                        @can('edit_media') 
                                        <button  class="btn btn-primary btn-edit"  role="button" data-id="{{ $item->id}}">Sửa</button>
                                        @endcan
                                        @can('delete_media') 
                                        <button  class="btn btn-danger btn-del"  role="button" data-id="{{ $item->id}}">Xóa</button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modals sửa category -->
<div id="edit-media-modal" class="modal fade" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{url('admin/media/edit-media')}}" method="post" id="editSliderForm" role="form" onsubmit="return false;" enctype='multipart/form-data'>
        <div class="modal-header">
          <h4 class="modal-title">Sửa slide  &quot;
            <span data-ajax="edit" data-field="html"></span>&quot;
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Hủy bỏ</button>
          <button type="submit" class="btn btn-primary waves-effect waves-light btn-edit-save"><small class="ti-pencil-alt mr-2"></small>Cập nhật</button>
        </div>
      </form>
    </div>
  </div>
</div>  
<script src="{{ asset('public/admin/assets/js/plugins/jquery.validate.min.js')}}"></script>
<script src="{{ asset('public/admin/assets/js/plugins/sweetalert2.all.js')}}"></script>
<script src="{{ asset('public/admin/dropify.js') }}"></script>
<script>
	  $(document).on("click", ".btn-edit", function() {
      let id = $(this).attr('data-id');
      $.ajax({
        url: '{{url("admin/media/edit-modal")}}',
        type: 'POST',
        data: {id: id},
        dataType: 'JSON',
        headers: {
          'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        },
        success:function(data) {
          $("#edit-media-modal .modal-body").html(data.body);
          $('#position option[value="' + data.position + '"]').attr("selected", "selected");
          $('[data-ajax="edit"]').html(data.position);
          $(".dropify").dropify();
          $("#edit-media-modal").modal('show');
        },
        error: function(err) {
          console.log(err);
          Swal({
            title: "Error " + err.status,
            text: err.responseText,
            showCancelButton: false,
            showConfirmButton: true,
            confirmButtonText: 'OK',
            type: 'error'
          });
        }
      });
      return false;
    });
    $(document).on('click', ".btn-edit-save", function() {
      let action = $("#editSliderForm").attr('action');
      let method = $("#editSliderForm").attr('method');
      let form = document.querySelector("#editSliderForm");
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
          //console.log(data);
          if (data.status == '_error') {
            Swal({
              title: data.msg,
              type: 'error',
              showCancelButton: false,
              showConfirmButton: true,
              confirmButtonText: 'OK'
            });
          } else {
            Swal({
              title: data.msg,
              type: 'success',
              showCancelButton: false,
              showConfirmButton: false,
              timer: 2000
            }).then(() => {
              window.location.href = '{{url("admin/media/view-media")}}';
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
    });
    $(".btn-del").on('click',function() {
      let id = $(this).attr('data-id');
      Swal({
        title: 'Xác nhận xóa?',
        type: 'error',
        html: '<p>Bạn sắp xóa 1 slide ảnh.</p><p>Bạn có chắn chắn muốn xóa?</p>',
        showConfirmButton: true,
        confirmButtonText: '<i class="ti-check" style="margin-right:5px"></i>Đồng ý',
        confirmButtonColor: '#ef5350',
        cancelButtonText: '<i class="ti-close" style="margin-right:5px"></i> Hủy bỏ',
        showCancelButton: true,
        focusConfirm: false,
        reverseButtons: true
      }).then((result) => {
        if (result.value == true) {
          $.ajax({
            url: '{{ url('admin/media/delete') }}',
            type: 'POST',
            data: {id: id, length: '1'},
            dataType: 'JSON',
            headers: {
              'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            },
            success: function(data) {
                            //console.log(data);
                            if(data.status == '_success') {
                              Swal({
                                title: data.msg,
                                showCancelButton: false,
                                showConfirmButton: false,
                                type: 'success',
                                timer: 2000
                              }).then(() => {
                                location.reload();
                              });
                            } else {
                              Swal({
                                title: data.msg,
                                showCancelButton: false,
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                type: 'error'
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
        return false;
      });
      return false;
    });
</script>
@endsection