<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\User;
use Illuminate\Http\Request;

class StallManagerController extends Controller
{
    public function index()
    {
        $user = User::orderBy('created_at', 'DESC')->with('province')->get();
        return view('superAdmin.stalls.list', compact('user'));
    }

    public function view($id)
    {
        $product = Product::where('author_id', $id)->orderby('created_at','DESC')->get();
        $user = User::where('id', $id)->with('province.district.ward')->first();
        if($product) {
            $products = $product;
        } else {
            $products = [];
        }
        return view('superAdmin.stalls.detail', compact('products','user'));
    }


    public function changeInfo(Request $req)
    {
        $id = $req->id;
        $checkUser = User::find($id);
        $checkUser->name = $req->name;
        $checkUser->name_display = $req->name_display;
        $checkUser->address = $req->address;
        $checkUser->phone = $req->phone;
        $checkUser->email = $req->email;
        $checkUser->description = $req->description;
        if($checkUser->save()) {
            $msg = [
                'status' => '_success',
                'msg'    => 'Thay đổi thành công
                '
              ];
              return response()->json($msg);
        }
    }

    public function changeStatus(Request $req)
    {
        $id = $req->id;
        $checkUser = User::find($id);
        if($checkUser->admin == 0) {
            User::where('id', $id)->update(['admin' => 1]);
            Product::where('author_id', $id)->update(['status' => 1]);
            $msg = [
                'status' => '_success',
                'msg'    => 'Thay đổi thành công'
              ];
              return response()->json($msg);
        } else {
            User::where('id', $id)->update(['admin' => 0]);
            Product::where('author_id', $id)->update(['status' => 0]);
            $msg = [
                'status' => '_success',
                'msg'    => 'Thay đổi thành công'
              ];
              return response()->json($msg);
        }

    }

    public function changeAllStatusOnProduct(Request $req)
    {
        $id = $req->id;
        $updatePro = Product::where('author_id', $id)->update(['status' => 1]);
        if($updatePro) {
            $msg = [
                'status' => '_success',
                'msg'    => 'Thay đổi thành công1'
              ];
              return response()->json($msg);
        } else {
            $msg = [
                'status' => '_error',
                'msg'    => 'Lỗi vui lòng thử lại'
              ];
              return response()->json($msg);
        }
    }

    public function changeAllStatusOffProduct(Request $req)
    {
        $id = $req->id;
        $updatePro = Product::where('author_id', $id)->update(['status' => 0]);
        if($updatePro) {
            $msg = [
                'status' => '_success',
                'msg'    => 'Thay đổi thành công'
              ];
              return response()->json($msg);
        } else {
            $msg = [
                'status' => '_error',
                'msg'    => 'Lỗi vui lòng thử lại'
              ];
              return response()->json($msg);
        }
    }

    public function changeStatusOne(Request $req)
    {
        $id         = $req->id;
        $status = $req->status === 'true' ? 1 : 0;
		if (Product::where('id',$id)->update(['status' => $status])) {
			$msg = [
				'status' => '_success',
				'msg'    => 'Thay đổi thành công.'
			];
			return response()->json($msg);
		} else {
			$msg = [
				'status' => '_error',
				'msg'    => 'Error.'
			];
			return response()->json($msg);
		}
    }

}
