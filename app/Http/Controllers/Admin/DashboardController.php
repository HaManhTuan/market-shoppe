<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order;
use App\Model\Customer;
use App\Model\Product;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function index(){
        $total_revenue = Order::orderBy('id','ASC')->sum('total_price');
        //Chart1
        $revenueCurrentY = Order::whereYear('created_at',Carbon::now()->year)->sum('total_price');
        $revenueLastY = Order::whereYear('created_at',Carbon::now()->subYear(1))->sum('total_price');
        $revenueLastY1 = Order::whereYear('created_at',Carbon::now()->subYear(2))->sum('total_price');
        $revenueLastY2 = Order::whereYear('created_at',Carbon::now()->subYear(4))->sum('total_price');
        $revenueLastY3 = Order::whereYear('created_at',Carbon::now()->subYear(5))->sum('total_price');
        $perCurrrentY = ($revenueCurrentY/$revenueLastY)*100;
        //Chart2-Chart3
        $revenueCurrentM = Order::whereMonth('created_at',Carbon::now()->month)->whereYear('created_at',Carbon::now()->year)->sum('total_price');
        $revenueCurrentM1 = Order::whereMonth('created_at',Carbon::now()->subMonth(1))->sum('total_price');
        $revenueCurrentM2 = Order::whereMonth('created_at',Carbon::now()->subMonth(2))->sum('total_price');
        $revenueCurrentM3 = Order::whereMonth('created_at',Carbon::now()->subMonth(3))->sum('total_price');
        $revenueCurrentM4 = Order::whereMonth('created_at',Carbon::now()->subMonth(4))->sum('total_price');
        $revenueCurrentM5 = Order::whereMonth('created_at',Carbon::now()->subMonth(5))->sum('total_price');
        $revenueCurrentM6 = Order::whereMonth('created_at',Carbon::now()->subMonth(6))->sum('total_price');
        $revenueCurrentM7 = Order::whereMonth('created_at',Carbon::now()->subMonth(7))->sum('total_price');
        $revenueCurrentM8 = Order::whereMonth('created_at',Carbon::now()->subMonth(8))->sum('total_price');
        $revenueCurrentM9 = Order::whereMonth('created_at',Carbon::now()->subMonth(9))->sum('total_price');
        $revenueCurrentM10 = Order::whereMonth('created_at',Carbon::now()->subMonth(10))->sum('total_price');
        $revenueCurrentM11 = Order::whereMonth('created_at',Carbon::now()->subMonth(11))->sum('total_price');
        //Chart4
        $current_day_order_week = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->whereDay('created_at',Carbon::now()->day)->sum('total_price');

        $yesterday_day_order_week = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->whereDay('created_at',Carbon::now()->subDay(1))->sum('total_price');

        $yesterday_day_2_order_week = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->whereDay('created_at',Carbon::now()->subDay(2))->sum('total_price');

        $yesterday_day_3_order_week = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->whereDay('created_at',Carbon::now()->subDay(3))->sum('total_price');

        $yesterday_day_4_order_week = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->whereDay('created_at',Carbon::now()->subDay(4))->sum('total_price');

        $yesterday_day_5_order_week = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->whereDay('created_at',Carbon::now()->subDay(5))->sum('total_price');

        $yesterday_day_6_order_week = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->whereDay('created_at',Carbon::now()->subDay(6))->sum('total_price');

        $total7day = $current_day_order_week + $yesterday_day_order_week + $yesterday_day_2_order_week + $yesterday_day_3_order_week + $yesterday_day_4_order_week  + $yesterday_day_4_order_week + $yesterday_day_6_order_week;
        // print_r($current_day_order_week);
        // die;
        //OrderRecent
        $ordersNews = Order::with('orders')->where('order_status','!=',4)->get();
        //Top-Customer_Buy_count
        $customer = Customer::with('order')->get();
        $total_customer = Customer::get()->count();
        //Total_Pro
        $totalPro = Product::get()->count();
        //Total_Order_success 
        $totalOrderS = Order::where('order_status',4)->get()->count();
        //Total_Order
        $totalOrder = Order::get()->count();
        //CountViewPro
        $viewPro = Product::orderBy('count_view','ASC')->paginate(7);
        //CountBuyPro
        $buyPro = Product::orderBy('stock','ASC')->paginate(7);
        //dataPro
        $dataProExp = Product::where('stock','<',2)->get();
        $data_send = [
          'total_revenue' => $total_revenue,
          'revenueCurrentY' => $revenueCurrentY,
          'revenueLastY' => $revenueLastY,
          'revenueLastY1' => $revenueLastY1,
          'revenueLastY2' => $revenueLastY2,
          'revenueLastY3' => $revenueLastY3,
          'perCurrrentY' => $perCurrrentY,
          'revenueCurrentM' => $revenueCurrentM,
          'revenueCurrentM1' => $revenueCurrentM1,
          'revenueCurrentM2' => $revenueCurrentM2,
          'revenueCurrentM3' => $revenueCurrentM3,
          'revenueCurrentM4' => $revenueCurrentM4,
          'revenueCurrentM5' => $revenueCurrentM5,
          'revenueCurrentM6' => $revenueCurrentM6,
          'revenueCurrentM7' => $revenueCurrentM7,
          'revenueCurrentM8' => $revenueCurrentM8,
          'revenueCurrentM9' => $revenueCurrentM9,
          'revenueCurrentM10' => $revenueCurrentM10,
          'revenueCurrentM11' => $revenueCurrentM11,
          'current_day_order_week' => $current_day_order_week,
          'yesterday_day_order_week' => $yesterday_day_order_week,
          'yesterday_day_2_order_week' => $yesterday_day_2_order_week,
          'yesterday_day_3_order_week' => $yesterday_day_3_order_week,
          'yesterday_day_4_order_week' => $yesterday_day_4_order_week,
          'yesterday_day_5_order_week' => $yesterday_day_5_order_week,
          'yesterday_day_6_order_week' => $yesterday_day_6_order_week,
          'total7day' => $total7day,
          'ordersNews' => $ordersNews,
          'customer' => $customer,
          'totalPro' => $totalPro,
          'total_customer' => $total_customer,
          'totalOrderS' => $totalOrderS,
          'totalOrder' => $totalOrder,
          'viewPro' => $viewPro,
          'buyPro' => $buyPro,
          'dataProExp' => $dataProExp
        ];
        return view('backend.dashboard')->with($data_send);
    }
}
