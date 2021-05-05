<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use App\Model\Product;
class CartController extends Controller
{
  public function add(Request $req){
    //print_r($req->all());
     $stock = Product::where('id', $req->product_id)->value('stock');
     if ($stock >= $req->qty && $stock > 0) {
        Cart::add(
          [
            'id'   => $req->product_id,
            'name' => $req->product_name,
            'price' => $req->price,
            'quantity' =>  $req->qty,
            'attributes' => ['avatar' =>$req->avatar,'url' =>$req->url,'product_id' =>$req->product_id]
          ]);
            $cart_data = Cart::getContent();
            $cart_subtotal = Cart::getSubTotal();
            $count_cart = $cart_data->count();
            $cartblock = '<a title="My cart" href="'.url('/view-cart').'">Giỏ hàng</a>
                    <span class="notify notify-right">'.$cart_data->count().'</span>
                    <div class="cart-block">
                        <div class="cart-block-content">
                            <h5 class="cart-title">'.$cart_data->count().' sản phẩm trong giỏ hàng</h5>
                            <div class="cart-block-list">
                              <ul>';
                        foreach ($cart_data as $value) {
                            $cartblock .= '<li class="product-info">
                                    <div class="p-left">
                                        <a href="#" class="remove_link"></a>
                                        <a href="#">
                                        <img class="img-responsive" src="'.asset('uploads/images/products/').'/'.''.$value->attributes->avatar.'" alt="p10">
                                        </a>
                                    </div>
                                    <div class="p-right">
                                        <p class="p-name">'.$value['name'].'</p>
                                        <p class="p-rice">'.number_format($value['price']).'</p>
                                        <p>SL: '.$value['quantity'].'</p>
                                    </div>
                                </li>';}
                             $cartblock .= '</ul>
                            </div>
                            <div class="toal-cart">
                                <span>Tổng</span>
                                <span class="toal-price pull-right">'.number_format($cart_subtotal).'</span>
                            </div>
                            <div class="cart-buttons">
                                <a href="order.html" class="btn-check-out">Thanh toán</a>
                            </div>
                        </div>
                    </div>';
            $success = 'Bạn đã thêm '.$req->product_name.' vào giỏ hàng!';
            $error = "";
            $msg = [
            "status" =>"_success",
            "success"        => $success,
            "error"        => $error,
            "cartblock"        => $cartblock,
            "count_cart"        => $count_cart,
            ];
            return json_encode($msg);

     }
     else
     {
        if (($stock < $req->qty && $stock > 0)) {
          $msg = [
              'status' => '_error',
              'msg'    => 'Không đủ hàng. Vui lòng nhập lại số lượng'
          ];
          return response()->json($msg);
          }
     }
  }
  public function view(){
    return view('frontend.cart');
  }
  public function removeCart(Request $req){

    if (Cart::remove($req->id)) {
        $cart_subtotal = Cart::getSubTotal();
      $msg = [
              'status' => '_success',
              'msg'    => 'Đã xóa sản phẩm khỏi giỏ hàng',
              'cart_subtotal'    => $cart_subtotal
          ];
          return response()->json($msg);
    }
    else{
      $msg = [
              'status' => '_error',
              'msg'    => 'Có lỗi xảy ra. Vui lòng thử lại'
          ];
          return response()->json($msg);
    }
  }
  public function updateCart(Request $req){
      $stock = Product::where('id',$req->product_id)->value('stock');

     if ($stock > $req->qty && $stock > 0) {
          Cart::update($req->product_id,['quantity' => array(
            'relative' => false,
            'value' => $req->qty
          )]);
          $msg = [
                'status' => '_success',
                'msg'    => 'Cập nhật thành công'
          ];
        return response($msg);
     }
      else {
        $msg = [
                'status' => '_error',
                'qty_old' => $req->qty,
                'msg'    => 'Số lượng lớn quá. Hãy giảm số lượng'
            ];
        return response($msg);
      }
  }
}
