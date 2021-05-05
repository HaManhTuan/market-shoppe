<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Model\Customer;
use App\Model\Order;
class ProfileController extends Controller
{
  public function account()
  {
    if (Auth::guard('customers')->check()) {
      $customer_id = Auth::guard('customers')->user()->id;
    $order       = Order::with('orders')->where('customer_id', $customer_id)->orderBy('id', 'DESC')->get();
    return view('frontend.account', compact('order',$order));
    }
    else{
      return redirect('/dang-nhap');
    }
  }
  public function updateaccount(Request $req)
  {
    $customers = Customer::where('id',$req->customer_id)->first();
    $customers->name = $req->name;
    $customers->phone = $req->phone;
    $customers->address = $req->address;
    if ($customers->save()) {
      $msg = [
        'status' => '_success',
        'msg'    => 'Thay đổi thông tin thành công
        '
      ];
      return response()->json($msg);
    } else {
      $msg = [
        'status' => '_error',
        'msg'    => 'Lỗi
        '
      ];
      return response()->json($msg);
    }
  }
  public function editpass(Request $req)
  {
    $pwd        = $req->retypeNewPwd;
    $pwd_bcrypt = Hash::make($pwd);
    $id         = $req->id;
    $query      = Customer::where("id", $id)->update(['password' => $pwd_bcrypt]);
    if (!$query || $query == false) {
      $msg = [
        'status' => '_error',
        'msg'    => 'Có lỗi xảy ra. Vui lòng thử lại'
      ];
      return response()->json($msg);
    } else {
      Auth::guard('customers')->logout();
      $msg = [
        'status' => '_success',
        'msg'    => 'Mật khẩu đã được thay đổi thành công'
      ];
      return response()->json($msg);
    }
  }
}
