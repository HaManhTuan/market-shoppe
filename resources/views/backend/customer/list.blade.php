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
<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/assets/vendor/datatables/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/assets/vendor/datatables/css/buttons.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/assets/vendor/datatables/css/select.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/assets/vendor/datatables/css/fixedHeader.bootstrap4.css')}}">
<script src="{{ asset('public/admin/assets/js/plugins/notify.js')}}"></script>
@if(Session::has('flash_message_success'))
<script>
  $(document).ready(function() {
      $(".breadcrumb").notify("{{ Session::get('flash_message_success') }}", "success");
  });
</script>
 @endif
<style>
 table tr.tr-item-cus:hover{
    cursor: pointer;
 }
</style>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">List Customer
            </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Customer</a></li>
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
            <div class="card-body">
                @if ($customer->count() > 0) 
                    <table class="table table-bordered" id="customer_table">
                        <thead>
                            <tr>
                               <th>ID</th>
                               <th>Tên</th>
                               <th>SĐT</th>
                               <th>Email</th>
                               <th>Đơn hàng</th>
                               <th>Số tiền</th>
                             </tr>
                        </thead>
                        <tbody>
                            @php
                                $stt = 1;
                                $none="None";
                            @endphp
                           @foreach($customer as $customer)
                            <tr class="tr-item-cus" data-action="{{ url('admin/customer/view-modal') }}" data-id="{{$customer->id}}">
                              <td>{{  $stt++ }}</td>
                              <td>{{ $customer->name }}</td>
                              <td>
                                {{ $customer->phone }}
                              </td>
                              <td>
                                {{ $customer->email}}
                              </td>
                              <td>
                                @php
                                    $count = DB::table('order')->where('customer_id',$customer->id)->get();
                                @endphp
                                {{ count($count) }} đơn hàng
                              </td>
                              <td>
                                @php
                                    $total = DB::table('order')->where('customer_id',$customer->id)->sum('total_price');
                                    echo number_format($total);
                                @endphp
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
<!-- Modals sửa category -->
<div id="view-modal" class="modal fade" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
    <form  method="post" id="editCategoryForm" role="form" onsubmit="return false;">
        <div class="modal-header">
            <h4 class="modal-title">Thông tin khách hàng &quot;
                <span data-ajax="edit" data-field="html"></span>&quot;
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Đóng</button>
        </div>
    </form>
</div>
</div>
</div>
<script src="{{ asset('public/admin/assets/js/plugins/jquery.validate.min.js')}}"></script>
<script src="{{ asset('public/admin/assets/js/plugins/sweetalert2.all.js')}}"></script>
<script src="{{ asset('public/admin/assets/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('public/admin/assets/vendor/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('public/admin/assets/vendor/datatables/js/data-table.js')}}"></script>
<script>
  $('#customer_table').DataTable({
    "columnDefs": [
        { "orderable": false, "targets": 0 }
        ],
      "order": [],
  });
</script>
<script>
    //mở popup khah hang
$(document).on("click", ".tr-item-cus", function() {
    let id = $(this).attr('data-id');
    let action = $(this).attr('data-action');
    $.ajax({
        url: action,
        type: 'POST',
        data: { id: id },
        dataType: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        },
        success: function(data) {
            $("#view-modal .modal-body").html(data.body);
            $('[data-ajax="edit"]').html(data.customer_name);
            $("#view-modal").modal('show');
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
</script>
@endsection
