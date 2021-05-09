<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Mail\SendMailCart;
use Illuminate\Http\Request;
use Auth;
use Cart;
use DB;
use App\Model\Order;
use App\Model\Email;
use App\Model\OrderDetail;
use App\Model\OrderDetailUser;
use App\Model\Customer;
use App\Model\OrderUser;
use App\Model\Product;
use Mail;
use Illuminate\Mail\Mailable;

class CheckoutController extends Controller
{
    public function sendMail(Mailable $obj)
    {
        try {
            Mail::send($obj);
            return true;
        } catch (\Exception $e) {
            \Log::info('SEND MAIL ERROR: ' . $e->getMessage());
            return false;
        }
    }

  public function step(){
    if (Auth::guard('customers')->check()) {
      return view('frontend.step');
    }
    else{
      return redirect('/dang-nhap')->with('flash_ms_error','Bạn phải đăng nhập để mua hàng');
    }
  }
  public function stepcontinue(Request $req){

    $name_order = $req->name_shipping;
    $phone_order = $req->phone_shipping;
    $address_order = $req->address_shipping;

    $data_send = [
      'name_order' => $name_order,
      'phone_order' => $phone_order,
      'address_order' => $address_order
    ];
    //print_r($data_send);
    return view('frontend.step_continue')->with($data_send);
  }
  public function checkout(Request $req){
    $author_id = [];
    $cart_data = Cart::getContent();
    $cart_subtotal = Cart::getSubTotal();
    $order                = new Order();
    $order->customer_id   = Auth::guard('customers')->user()->id;
    $order->email         = Auth::guard('customers')->user()->email;
    $order->total_price   = $cart_subtotal;
    $order->name          = $req->name_order;
    $order->phone         = $req->phone_order;
    $order->note          = $req->note;
    $order->address       = $req->address_order;
    $order->order_status  = '1';
    $order->order_method  = $req->method_order;
     if ($order->save()) {
      $order_id     = DB::getPdo()->lastInsertId();
      foreach ($cart_data as $value) {
        $orderdetail               = new OrderDetail();
        $orderdetail->order_id     = $order_id;
        $orderdetail->product_id   = $value->attributes->product_id;
        $orderdetail->customer_id  = Auth::guard('customers')->user()->id;
        $orderdetail->product_name = $value->name;
        $orderdetail->price        = $value->price;
        $orderdetail->quantity     = $value->quantity;
        $getUserId = Product::where('id', $value->attributes->product_id)->first();
        if($getUserId){
            $orderdetail->user_id = $getUserId->author_id;
            array_push($author_id, $getUserId->author_id);
        }
        $query = $orderdetail->save();
      }
      if ($query) {
          //$dataOrderDetail = OrderDetail::where('order_id', $order_id)->pluck('user_id')->toArray();
            foreach(array_unique($author_id) as $value) {
                $order                = new OrderUser();
                $order->customer_id   = Auth::guard('customers')->user()->id;
                $order->email         = Auth::guard('customers')->user()->email;
                $order->total_price   = $cart_subtotal;
                $order->name          = $req->name_order;
                $order->phone         = $req->phone_order;
                $order->note          = $req->note;
                $order->address       = $req->address_order;
                $order->order_status  = '1';
                $order->order_method  = $req->method_order;
                $order->user_id  = $value;
                $query = $order->save();
                $order_user_id     = DB::getPdo()->lastInsertId();
                $dataOrderDetailCurrent = OrderDetail::where('order_id', $order_user_id)->where('user_id', $value)->get();
                if($dataOrderDetailCurrent) {
                    foreach($dataOrderDetailCurrent as $item){
                        $orderdetail               = new OrderDetailUser();
                        $orderdetail->order_user_id     = $order_user_id;
                        $orderdetail->product_id   = $item->product_id;
                        $orderdetail->customer_id  = $item->customer_id;
                        $orderdetail->product_name = $item->product_name;
                        $orderdetail->price        = $item->price;
                        $orderdetail->quantity     = $item->quantity;
                        $orderdetail->save();
                    }
                }
            }
        $checkMail = Email::find(1);
        $customer = Customer::where('id', Auth::guard('customers')->user()->id)->first();
        $orderDetail = OrderDetail::latest()->first();
        if($checkMail && $checkMail->is_send_mail_cart == 1 && $customer) {
            \Log::info("Start send mail cart");
            $this->sendMail(new SendMailCart($customer, $orderDetail));
            \Log::info("End send mail cart");
        }
         return redirect('cart/thanks');
      }
    }
  }
  public function thank()
  {
    Cart::clear();
    return view('frontend.thanks');
  }
}
