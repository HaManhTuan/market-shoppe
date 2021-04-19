<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Model\Customer;
class CustomerController extends Controller
{
  public function view()
  {
    $customer = Customer::orderBy('created_at','asc')->get();
    $data_send=[
      'customer'=>$customer
    ];
    return view('backend.customer.list')->with($data_send);
  }
  public function viewmodal(Request $req)
  {
    $id            = $req->id;
    $cus_data = Customer::where('id', $id)->first();
    $data = '
      <div class="form-group mb-3">
        <label for="category_name_input" class="control-label">Tên khách hàng <font color="#a94442">(*)</font></label>
        <input type="text" class="form-control" id="name_edit" name="name" value="'.$cus_data->name.'" readonly/>
      </div>
      <div class="form-group mb-3">
        <label for="category_name_input" class="control-label">Email <font color="#a94442">(*)</font></label>
        <input type="text" class="form-control" id="name_edit" name="name" value="'.$cus_data->email.'" readonly/>
      </div>
      <div class="form-group mb-3">
        <label for="category_name_input" class="control-label">Địa chỉ <font color="#a94442">(*)</font></label>
        <input type="text" class="form-control" id="name_edit" name="name" value="'.$cus_data->address.'" readonly/>
      </div>
    ';
    $msg = array(
      'customer_name'  => $cus_data->name,
      'body'           => $data,
    );

    return json_encode($msg);
  }
}
