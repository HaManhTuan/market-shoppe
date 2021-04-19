<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order;
use App\Model\Customer;
use App\Model\Log;
use App\Model\Config;
use Auth;
use DB;
use Mail;
class OrderController extends Controller
{
  public function view()
  {
   $orders = Order::with('orders')->orderBy('id','DESC')->get();
   return view('backend.order.list')->with(compact('orders'));
  }
  public function vieworder ($id)
  {
    if (!Gate::allows('view_order') || !Gate::allows('change_status_order'))
      {
          return view('backend.errors.401');
      }
    $orderDetail    = Order::with('orders')->with('customer')->find($id);
    $customerDetail = Customer::find($orderDetail->customer_id);
    $log = Log::where('order_id',$id)->first();
    $data_send = ['orderDetail' => $orderDetail, 'customerDetail' => $customerDetail, 'log' => $log];
    return view('backend.order.detail')->with($data_send);
  }
  public function changecustomer(Request $req)
  {
    
    $customer          = Customer::find($req->id_cus);
    $customer->name    = $req->name;
    $customer->phone   = $req->phone;
    $customer->address = $req->address;
    if ($customer->save()) {
      $msg = array(
        'status' => '_success',
        'msg'    => 'Bạn đã thay đổi thành công.',
      );
      return json_encode($msg);
    } else {
      $msg = array(
        'status' => '_error',
        'msg'    => 'Có lỗi xảy ra. Vui lòng thử lại.',
      );
      return json_encode($msg);
    }
  }
  public function changestatus(Request $req)
  {
    $orderStatus               = Order::with('orders')->find($req->order_id);
    $orderStatus->order_status = $req->status;
    switch ($req->status) {
      case '1':
        $content = 'Đã thay đổi trạng thái thành: Mới';
        break;
      case '2':
        $content = "Đã thay đổi trạng thái thành: Đang xử lý";
        break;
      case '3':
        $content = "Đã thay đổi trạng thái thành: Đang chuyển";
        break;
      case '4':
        $content = "Đã thay đổi trạng thái thành: Đã chuyển";
        break;
      case '5':
        $content = "Đã thay đổi trạng thái thành: Đã hủy";
        break;
    }
    if ($orderStatus->save()) {
      if ($orderStatus->order_status == 4) {
        $log = new Log();
        $log->user_id = Auth::user()->name;
        $log->order_id = $orderStatus->id;
        $log->meta = $content;
        $log->save();
        foreach ($orderStatus->orders as $value) {
          $incrementBuy = DB::table('product')->where(['id' => $value->product_id])->increment('buy_count',$value->quantity);
        }
        if ($incrementBuy) {
          $msg = array(
            'status' => '_success',
            'msg'    => 'Bạn đã thay đổi trạng thái thành công.',
          );
          return json_encode($msg);
        }
        else {
          $msg = array(
            'status' => '_error',
            'msg'    => 'Có lỗi xảy ra. Vui lòng thử lại.',
          );
          return json_encode($msg);
        }
      }
    }
    else {
      $msg = array(
        'status' => '_error',
        'msg'    => 'Có lỗi xảy ra. Vui lòng thử lại.',
      );
      return json_encode($msg);
    }
  }
  public function invoice($id)
  {
    $orderDetail = Order::with('orders')->find($id);
    $data_send =['id' => $id,'orderDetail'=>$orderDetail];
    return view("backend.order.invoice")->with($data_send);
  }
  public function sendEMail($id)
  {
        $orderDetail    = Order::with('orders')->with('customer')->find($id);
        $email = $orderDetail->email;
        $customerDetail = Customer::find($orderDetail->customer_id);
        $data = ['orderDetail' => $orderDetail,'customerDetail'=> $customerDetail,'email' =>$email];
        Mail::send('backend.mail.mail', $data, function($message) use($email){
            $message->to($email)->subject('Thông tin đơn hàng');
            $message->from('xyz@gmail.com','Đồ chơi ô tô');
        });
        if (Mail::failures()) {
          return redirect('admin/order/view-orderdetail/'.$id)->with('flash_message_error','Có lỗi. Vui lòng thử lại');
         }else{
          return redirect('admin/order/view-orderdetail/'.$id)->with('flash_message_success','Bạn đã gửi mail đến khách hàng');
  }
}
}
