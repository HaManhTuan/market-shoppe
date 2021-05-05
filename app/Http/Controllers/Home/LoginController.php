<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Model\Customer;
class LoginController extends Controller
{
  public function dangnhap(){
    return view('frontend.login');
  }
  public function dangkipost(Request $req){
    $checkEmail = Customer::where('email', $req->email)->count();
    if ($checkEmail > 0) {
      $msg = [
        'status' => '_error',
        'msg'    => 'Email này đã tồn tại. Vui lòng nhập email khác
        '
      ];
      return response()->json($msg);
    } else {
      $customer = new Customer();
      $customer->name = $req->name;
      $customer->address = $req->address;
      $customer->phone = $req->phone;
      $customer->email = $req->email;
      $customer->password = Hash::make($req->password);
      if ($customer->save()) {
        $msg = [
          'status' => '_success',
          'msg'    => 'Đăng kí tài khoản thành công
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
  }
  public function dangnhappost(Request $req){
    if (Auth::guard('customers')->attempt(['email' => $req->email_login, 'password' => $req->password_login])) {
      $msg = [
        'status' => '_success',
        'msg'    => 'Đang đăng nhập'

      ];
      return response()->json($msg);
    } else {
      $msg = [
        'status' => '_error',
        'msg'    => 'Tài khoản hoặc mật khẩu sai
        '
      ];
      return response()->json($msg);
    }
  }
  public function dangxuat(){
    Auth::guard('customers')->logout();
    return redirect('/');
  }
}
