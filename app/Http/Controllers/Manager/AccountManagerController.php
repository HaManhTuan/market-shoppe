<?php

namespace App\Http\Controllers\Manager;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;

class AccountManagerController extends Controller
{
    public function index()
    {
        if(Auth::guard('admins')->check()){
            $admin = Admin::where('id', Auth::guard('admins')->id())->first();
            return view('superAdmin.account.detail', compact('admin'));
        }
    }
    public function update(Request $req)
    {
        $id = $req->id;
        if($id) {
            $admin = Admin::where('id', $id)->first();
            $admin->name = $req->name;
            $admin->email = $req->email;
            $admin->phone = $req->phone;
            $admin->address = $req->address;
            if($req->password) {
                $admin->password = Hash::make($req->password);
            }
            $save = $admin->save();
            if($save) {
                return redirect('manager/tai-khoan');
            }
        } else {
            return redirect('manager/tai-khoan');
        }
    }
}
