<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\OrderUser;
use App\Model\Customer;
use App\Model\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $total_revenue = OrderUser::where('user_id', Auth::id())->orderBy('id','ASC')->sum('total_price');
        $revenueCurrentY = OrderUser::where('user_id', Auth::id())->whereYear('created_at',Carbon::now()->year)->sum('total_price');
        $revenueLastY = OrderUser::where('user_id', Auth::id())->whereYear('created_at',Carbon::now()->subYear(1))->sum('total_price');
        if($revenueLastY != 0) {
            $perCurrrentY = ($revenueCurrentY/$revenueLastY)*100;
        } else {
            $perCurrrentY = '';
        }
        $revenueCurrentM = OrderUser::where('user_id', Auth::id())->whereMonth('created_at',Carbon::now()->month)->whereYear('created_at',Carbon::now()->year)->sum('total_price');
        $ordersNews = OrderUser::where('user_id', Auth::id())->with('orders')->where('order_status','!=',4)->get();
        $customer_id = OrderUser::where('user_id', Auth::id())->get('customer_id')->toArray();
        //Top-Customer_Buy_count
       $customer = Customer::whereIn('id', $customer_id)->with('order')->get();
       $total_customer = Customer::whereIn('id', $customer_id)->get()->count();
       //Total_Pro
       $totalPro = Product::where('author_id', Auth::id())->get()->count();
       //Total_Order_success
       $totalOrderS = OrderUser::where('user_id', Auth::id())->where('order_status',4)->get()->count();
       //Total_Order
       $totalOrder = OrderUser::where('user_id', Auth::id())->get()->count();
       //CountViewPro
       $viewPro = Product::where('author_id', Auth::id())->orderBy('count_view','ASC')->paginate(7);
       //CountBuyPro
       $buyPro = Product::where('author_id', Auth::id())->orderBy('stock','ASC')->paginate(7);
       //dataPro
       $dataProExp = Product::where('author_id', Auth::id())->where('stock','<',2)->get();
        $data_send = [
            'total_revenue' => $total_revenue,
            'perCurrrentY' => $perCurrrentY,
            'revenueCurrentY' => $revenueCurrentY,
            'revenueCurrentM' => $revenueCurrentM,
            'ordersNews' => $ordersNews,
            'total_customer' => $total_customer,
            'totalPro' => $totalPro,
            'totalOrderS' => $totalOrderS,
            'viewPro' => $viewPro,
            'buyPro' => $buyPro,
            'dataProExp' => $dataProExp,
            'totalOrder' => $totalOrder
        ];
        return view('backend.dashboard')->with($data_send);
    }
}
