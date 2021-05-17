<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use App\Model\Product;
use App\Model\Events;
use App\Model\Category;
use Illuminate\Support\Carbon;
class CartController extends Controller
{
  public function add(Request $req){
    //print_r($req->all());
     $stock = Product::where('id', $req->product_id)->value('stock');
     if ($stock >= $req->qty && $stock > 0) {
        $EventArray = Events::where('status', 1)->whereDate('start_date','>=',Carbon::now())->whereDate('end_date','>=',Carbon::now())
        ->pluck('category_id')->toArray();
        $del_val = 'all';
        if(count($EventArray) > 0) {
            if (in_array("all", $EventArray))
            {
                $EventAll = Events::where('status', 1)->whereDate('start_date','>=',Carbon::now())->whereDate('end_date','>=',Carbon::now())->where('category_id','all')->first();
                $discount = $EventAll->discount;
                $cate_data = Category::where('status', 1)->get();
                foreach($cate_data as $item){
                    $idin[]    = $item->id;
                }
                $dataPro = Product::where('id', $req->product_id)->first();
                $idCate = $dataPro->category_id;
                if(in_array( $idCate, $idin)) {
                    $price = ($req->price * $discount ) /100;
                }
            }
            else
            {
                $dataPro = Product::where('id', 1)->first();
                $idCate = $dataPro->category_id;
                if(in_array($idCate, $EventArray)) {
                    $checkEvent = Events::where('status', 1)->where('category_id', $idCate)->first();
                    if(isset($checkEvent) &&  $checkEvent->discount) {
                        $price = ($req->price * $checkEvent->discount ) /100;
                    }
                } else {
                    $checkCate = Category::where('id', $idCate)->first();
                    if($checkCate->parent_id != 0){
                        $parentCate = Category::where('id', $checkCate->parent_id)->first();
                        $checkEventParent = Events::where('status', 1)->where('category_id', $parentCate->id)->first();
                        if(isset($checkEventParent) &&  $checkEventParent->discount) {
                            $price = ($req->price * $checkEventParent->discount ) /100;
                        }
                    }
                }
            }
        } else {
            $price = $req->price;
        }
        Cart::add(
          [
            'id'   => $req->product_id,
            'name' => $req->product_name,
            'price' => $price,
            'quantity' =>  $req->qty,
            'attributes' => ['origin_price' => $req->price,'avatar' =>$req->avatar,'url' =>$req->url,'product_id' =>$req->product_id]
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
                                <a href="'.url('view-cart').'" class="btn-check-out">Thanh toán</a>
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
