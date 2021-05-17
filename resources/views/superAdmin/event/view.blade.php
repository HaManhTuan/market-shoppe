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
  <!-- Data Table Css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('superAdmin/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
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
            <h2 class="pageheader-title">Danh sách khuyễn mại
            </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Khuyễn mại</a></li>
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
                <div class="btn-add">
                    <button type="button" class="btn btn-warning waves-effect" data-toggle="modal" data-target="#default-Modal">Thêm mới</button>
                </div>
                <table class="table table-striped table-bordered" id="simpletable">
                        <thead>
                            <tr>
                                <th scope="col">TT</th>
                                <th scope="col">Nội dung</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Giảm giá(%)</th>
                                <th scope="col">Ngày bắt đầu</th>
                                <th scope="col">Ngày kết thúc</th>
                                <th scope="col">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $stt = 1;
                            @endphp
                            @if (count($data_event) > 0)
                                @foreach ($data_event as $element)
                                    <tr class="tr-item">
                                        <td>{{$stt++}}</td>
                                        <td>{{$element->description}}</td>
                                        <td>{{isset($element->category->name) ? $element->category->name : 'Tất cả sản phẩm'}}</td>
                                        <td>{{$element->discount}}</td>
                                        <td>{{$element->start_date}}</td>
                                        <td>{{$element->end_date}}</td>
                                        <td>
                                            <span class="badge {{ $element->status == 1 ? 'badge-success' : 'badge-danger' }}"
                                                onclick="window.location.href='{{ url('manager/events/change-events/').'/'.$element->id }}'">
                                                {{ $element->status == 1 ? 'Hiện' : 'Ẩn' }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Danh mục</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('manager.events.add') }}" method="POST" onsubmit="return false;" class="frm-add" enctype='multipart/form-data'>
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label">Nội dung</label>
                        <div class="col-sm-12">
                            <textarea name="description" class="form-control" cols="30" rows="4"  data-rule-required="true" data-msg-required="Vui lòng nhập nội dung."></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label">Danh mục</label>
                        <div class="col-sm-12 select_cate">
                            <select name="parent_id" class="form-control"  data-rule-required="true" data-msg-required="Vui lòng chọn danh mục.">
                                <option value="all">Tất cả sản phẩm</option>
                                {!! $categoryData !!}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label">Giảm giá(%):</label>
                        <div class="col-sm-12">
                            <input type="number" name="discount" class="form-control"  data-rule-required="true" data-msg-required="Vui lòng nhập % số giảm giá .">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label">Ngày bắt đầu</label>
                        <div class="col-sm-12">
                            <input type="date" name="start_date" class="form-control"  data-rule-required="true" data-msg-required="Vui lòng chọn ngày bắt đầu.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label">Ngày kết thúc</label>
                        <div class="col-sm-12">
                            <input type="date" name="end_date" class="form-control"  data-rule-required="true" data-msg-required="Vui lòng chọn ngày kết thúc.">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light ">Lưu</button>
            </div>
        </form>
        </div>
    </div>
</div>
<script src="{{ asset('admin/assets/js/js-custom/myjs.js') }}"></script>
<script src="{{ asset('admin/assets/js/plugins/jquery.validate.min.js')}}"></script>
<script src="{{ asset('admin/assets/js/plugins/sweetalert2.all.js')}}"></script>
<script src="{{ asset('admin/dropify.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#simpletable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "order": [],
            "columnDefs": [ {
            "targets"  : [0, 4],
            "orderable": false,
            }],
            "language": {
                "lengthMenu": "Hiển thị _MENU_ bản ghi",
                "zeroRecords": "Không tìm thấy - sorry",
                "info": "Hiển thị _PAGE_ of _PAGES_",
                "infoEmpty": "Không có kết quả",
                "infoFiltered": "(đang lọc từ _MAX_ tổng số bản ghi)",
                "search": "Tìm kiếm:",
                "paginate": {
                    "previous": "Trước",
                    "next": "Sau",
                }
            }
        });
    });
    $(document).ready(function() {
        $(".frm-add").validate({
            submitHandler: function(form) {
                form.submit();
            }
        });
    })
</script>
@endsection
