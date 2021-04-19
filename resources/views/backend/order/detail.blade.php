@extends('layouts.admin.admin')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/bootstrap-4.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/toastr.min.css') }}">
<script src="{{ asset('public/admin/assets/js/plugins/notify.js')}}"></script>
@if(Session::has('flash_message_success'))
<script>
  $(document).ready(function() {
      $.notify("{{ Session::get('flash_message_success') }}", "success");
  });
</script>
 @endif
 @if(Session::has('flash_message_error'))
<script>
  $(document).ready(function() {
      $.notify("{{ Session::get('flash_message_error') }}", "error");
  });
</script>
 @endif
<style type="text/css" media="screen">
    .change-label:hover{
        cursor: pointer;
    }
    .btn-send-mail:hover{
      cursor: pointer;
    }
</style>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Chi tiết đơn hàng
            </h2>
            <div class="page-breadcrumb" style="display: flex;justify-content: space-between;">
            <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Đơn hàng</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
                    </ol>
                </nav>
                 <button type="button" class="btn btn-danger pull-right" id="invice" onclick='window.location.href="{{ url('admin/order/invoice/'.$orderDetail->id) }}"'>Hóa đơn</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
        <div class="card">
            <div class="card-header">
               <h5 class="card-title">Trạng thái đơn hàng
               @if($orderDetail->order_status == 1)
               <span class="label label-success" style="margin-left: 10px">Mới</span>
               @elseif($orderDetail->order_status == 2)
               <span class="label label-primary" style="margin-left: 10px">Đang xử lý</span>
               @elseif($orderDetail->order_status == 3)
               <span class="label label-warning" style="margin-left: 10px">Đang chuyển</span>
               @elseif($orderDetail->order_status == 4)
               <span class="label label-info" style="margin-left: 10px">Đã chuyển</span>
               @elseif($orderDetail->order_status == 5)
               <span class="label label-danger" style="margin-left: 10px">Đã hủy</span>
               @endif
               </h5>
            </div>
          <div class="card-body">
            <table class="table table-bordered ">
                  <tr>
                     <th scope="col">Ngày tạo</th>
                     <th scope="col">{{ date('d/m/Y h:i:s',strtotime($orderDetail->created_at)) }}</th>
                  </tr>
                  <tr>
                     <th scope="col">Tổng tiền</th>
                     <th scope="col">{{ number_format($orderDetail->total_price) }}</th>
                  </tr>
                  <tr>
                     <th scope="col">Hình thức thanh toán</th>
                     <th scope="col">{{ ($orderDetail->order_method) }}</th>
                  </tr>
                  <tr>
                     <th scope="col">Chú ý </th>
                     <th scope="col">{{ ($orderDetail->note) }}</th>
                  </tr>
              </table>
          </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
        <div class="card">
            <div class="card-header">
               <h5 class="card-title">Khách hàng
                  <span class="label label-primary btn-send-mail" style="margin-left: 10px" onclick='window.location.href="{{ url('admin/order/send-mail/'.$orderDetail->id) }}"'>Gửi Mail</span>
               </h5>
            </div>
          <div class="card-body">
            <table class="table table-bordered ">
              <tr>
                 <th scope="col">Họ tên:</th>
                 <th scope="col">{{ $orderDetail->name }}</th>
              </tr>
              <tr>
                 <th scope="col">Số điện thoại</th>
                 <th scope="col">
                    {{ $orderDetail->phone }}
                 </th>
              </tr>
              <tr>
                 <th scope="col">Email</th>
                 <th scope="col">
                    {{ $orderDetail->email }}
                 </th>
              </tr>
           </table>
          </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
        <div class="card">
            <div class="card-header">
               <h5 class="card-title">Thông tin hóa đơn
                 <span class="label label-primary change-label" style="margin-left: 10px" data-toggle="modal" data-target="#edituser">Thay đổi</span>
               </h5>
            </div>
          <div class="card-body">
            <div class="list-order" style="margin-top: 10px; margin-bottom: 30px; ">
                  <p>Họ tên: {{ $customerDetail->name }}</p>
                  <p>SĐT: {{ $customerDetail->phone }} </p>
                  <p>Email: {{ $customerDetail->email }} </p>
                  <p>Địa chỉ: {{ $customerDetail->address }} </p>
            </div>
          </div>
        </div>
    </div>
    @can('change_status_order')
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
        <div class="card">
            <div class="card-header">
               <h5 class="card-title">Trạng thái đơn hàng
                <input type="hidden" name="order_id" id="order_id" value="{{ $orderDetail->id }}">
            <input type="hidden" name="customer_id" id="customer_id" value="{{ $customerDetail->id }}">
             <select name="order_status" id="order_status" class="form-control" style="width: 180px;margin-left: 50px;display: inline-block;"> 
                @if ($orderDetail->order_status == 4)
                     <option value="4" selected="" disabled="">Đã chuyển</option>
                @else
                  <option value="1">Mới</option>
                  <option value="2">Đang chờ xử lý</option>
                  <option value="3">Đang chuyển</option>
                  <option value="4">Đã chuyển</option>
                  <option value="5">Đã hủy</option>
                @endif    
           </select>
               </h5>
            </div>
         <div class="card-body">
          @if (isset($log) && $log != "")
              
       {{ $log->user_id }} | {{ $log->meta }} | {{ $log->created_at}}<br> 
          @endif
         
         </div>
        </div>
    </div>
    @endcan
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="card">
        <div class="card-header">
           <h5 class="card-title">Chi tiết</h5>
        </div>
        <div class="card-body">
            <table id="order-table" class="table table-bordered table-hover">
                    <thead>
                       <tr>
                          <th>Tên sản phẩm</th>
                          <th>Giá</th>
                          <th>Số lượng</th>
                          <th>Tổng tiền</th>
                       </tr>
                    </thead>
                    <tbody>
                       @php $total_amount = 0; @endphp
                       @foreach($orderDetail->orders as $value)
                       <tr>
                          <td>{{ $value->product_name }}</td>
                          <td>{{ number_format($value->price) }}</td>
                          <td>{{ $value->quantity }}</td>
                          <td>{{ number_format($value->price*$value->quantity) }}</td>
                       </tr>
                       <?php $total_amount = $total_amount+($value->quantity*$value->price);?>
                       @endforeach
                    </tbody>
            </table>
            <table class="table table-bordered">
                  <thead>
                     <tr>
                        <th>Tổng tiền</th>
                        <th style="color:brown;font-weight: bold; width: 142px;">{{ number_format($total_amount) }}</th>
                     </tr>
                  </thead>
               </table>
        </div>
    </div>
</div>
</div>


<div id="edituser" class="modal fade" tabindex="-1" role="dialog"
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog bounceInDown animated">
      <div class="modal-content">
         <form action="{{ url('admin/order/change-customer') }}" method="post" id="id-edit-cus" class="add-size" role="form" onsubmit="return false;" enctype='multipart/form-data'>
            @csrf
            <div class="modal-header">
               <h4 class="modal-title">Chỉnh sửa hóa đơn khách hàng số  &quot;
                  <span data-ajax="edit" data-field="html">{{ $orderDetail->id }}</span>&quot;
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <input type="hidden" class="form-control" name="id_cus" id="id_cus" value="{{ $customerDetail->id }}">
            <div class="modal-body">
               <div class="form-group">
                  <label for="category_name_input" class="control-label">Họ tên:<font color="#a94442">(*)</font></label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ $customerDetail->name }}"
                     data-rule-required="true" data-msg-required="Vui lòng nhập tên.">
               </div>
               <div class="form-group">
                  <label for="category_name_input" class="control-label">Số điện thoại:<font color="#a94442">(*)</font></label>
                  <input type="text" class="form-control" name="phone" id="phone" value="{{ $customerDetail->phone }}"
                     data-rule-required="true" data-msg-required="Vui lòng nhập số điện thoại.">
               </div>
               <div class="form-group">
                  <label for="category_name_input" class="control-label">Địa chỉ:<font color="#a94442">(*)</font></label>
                  <textarea name="address" class="form-control" id="address" cols="30" rows="4" data-rule-required="true" data-msg-required="Vui lòng nhập địa chỉ.">{{ $customerDetail->address }}</textarea>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Hủy bỏ</button>
               <button type="submit" class="btn btn-success waves-effect waves-light" id="btn-save-cus"> Sửa</button>
            </div>
         </form>
      </div>
   </div>
</div>
<script>
  $('select#order_status option[value="' + {{ $orderDetail->order_status }} +'"]').prop("selected", true)
</script>
<script src="{{ asset('public/admin/assets/js/plugins/jquery.validate.min.js')}}"></script>
<script src="{{ asset('public/admin/sweetalert2.all.js')}}"></script>
<script src="{{ asset('public/admin/toastr.min.js')}}"></script>
<script>
    $(document).ready(function() {
       const Toast = Swal.mixin({
           toast: true,
           position: 'top-end',
           showConfirmButton: false,
           timer: 2000
       });
        $('select#order_status').change(function() {
               var status = $(this).val();
               var order_id = $("#order_id").val();
               var customer_id = $("#customer_id").val();
               $.ajax({
                   url: "{{ url('admin/order/change-status') }}",
                   type: "POST",
                   dataType: "JSON",
                   data: {status: status, order_id: order_id,customer_id: customer_id  },
                   headers: {
                       'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                   },
                   success: function(data){
                       console.log(data);
                       if(data.status == '_success') {
                        Toast.fire({
                            type: 'success',
                            title: data.msg
                        }).then(() => {
                            location.reload();
                        });
                       } else {
                        Toast.fire({
                            type: 'error',
                            title: data.msg
                        })
                       }
                   },
                   error: function(err){
                       console.log(err);
                   }
               });
       });
   });
    $(document).on("click","#btn-save-cus",function() {
       $("#id-edit-cus").validate({
           submitHandler: function() {
               let action = $("#id-edit-cus").attr('action');
               let method = $("#id-edit-cus").attr('method');
               let form = $("#id-edit-cus").serialize();
               $.ajax({
                   url: action,
                   type: method,
                   data: form,
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
                               $("#id-edit-cus")[0].reset();
                               window.location.reload();
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