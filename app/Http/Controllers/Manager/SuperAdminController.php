<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function login(){
        return view('superAdmin.login');
    }
    public function dangnhap(Request $request) {
        $data = $request->all();
        if (Auth::guard('admins')->attempt(['email' =>$data['email'], 'password' => $data['password'], 'admin' => '1'])) {
            return redirect()->route('manager.dashboard');
        }
        else {
            return view('superAdmin.login')->with(['flash_err' => 'Sai tài khoản hoặc mật khẩu']);
        }
    }
}
