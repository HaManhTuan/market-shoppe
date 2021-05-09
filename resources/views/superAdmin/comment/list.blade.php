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
                <table class="table table-striped table-bordered" id="simpletable">
                        <thead>
                            <tr>
                                <th scope="col">TT</th>
                                <th scope="col">Họ tên</th>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Nội dung</th>
                                <th scope="col">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $stt = 1;
                            @endphp
                            @if (count($data_comment) > 0)
                                @foreach ($data_comment as $element)
                                    <tr class="tr-item">
                                        <td>{{$stt++}}</td>
                                        <td>{{$element->customer->name}}</td>
                                        <td>{{$element->product->name}}</td>
                                        <td>{{$element->content}}</td>
                                        <td>
                                            <span class="badge {{ $element->status == 1 ? 'badge-success' : 'badge-danger' }}"
                                                onclick="window.location.href='{{ url('manager/comment/change-comment/').'/'.$element->id }}'">
                                                {{ $element->status == 1 ? 'Hiện' : 'Ẩn' }}</span>
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

</script>
@endsection
