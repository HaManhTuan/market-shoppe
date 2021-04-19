<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;

class AdminController extends Controller
{
    public function pagenotfound(){
        return view('backend.errors.404');
    }
    public function login(){
        return view('backend.login');
    }
    public function dangnhap(Request $req){
        $data = $req->all();
        if (Auth::attempt(['email' =>$data['email'], 'password' => $data['password'], 'admin' => '1'])) {
              $msg = [
                  'status' => '_success',
                  'msg'    => 'Loading ...'
              ];
              return response()->json($msg);
        }
        else {
                $msg = [
                  'status' => '_error',
                  'msg'    => 'Tài khoản hoặc mật khẩu sai
                  '
              ];
              return response()->json($msg);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}
