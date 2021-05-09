<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Model\Email;
use Illuminate\Http\Request;

class EmailManagerController extends Controller
{
    public function index()
    {
       $email = Email::all();
       if(count($email) == 0){
            Email::create([
                'is_send_mail_cart' => 0,
                'is_send_mail_product_expried' => 0
            ]);
       } else {
        $email = Email::find(1);
       }
       $email = Email::find(1);
       return view('superAdmin.email', compact('email'));
    }

    public function mailCart(Request $req)
    {

        $is_send_mail_cart = $req->mailCart == "true" ? 1 : 0;
        $email = Email::where('id', 1)->update(['is_send_mail_cart' => $is_send_mail_cart]);
        if($email) {
            $msg = [
				'status' => '_success',
				'msg'    => 'Thay thành công.'.$req->mailCart.$is_send_mail_cart
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

    public function mailPro(Request $req)
    {
        $is_send_mail_product_expried = $req->mailPro == "true" ? 1 : 0;
        $email = Email::where('id', 1)->update(['is_send_mail_product_expried' => $is_send_mail_product_expried]);
        if($email) {
            $msg = [
				'status' => '_success',
				'msg'    => 'Thay thành công.'
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
