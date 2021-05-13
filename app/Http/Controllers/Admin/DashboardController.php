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
            //Chart1
            $revenueCurrentY = OrderUser::whereYear('created_at',Carbon::now()->year)->sum('total_price');
            $revenueLastY = OrderUser::whereYear('created_at',Carbon::now()->subYear(1))->sum('total_price');
            $revenueLastY1 = OrderUser::whereYear('created_at',Carbon::now()->subYear(2))->sum('total_price');
            $revenueLastY2 = OrderUser::whereYear('created_at',Carbon::now()->subYear(4))->sum('total_price');
            $revenueLastY3 = OrderUser::whereYear('created_at',Carbon::now()->subYear(5))->sum('total_price');
            if($revenueLastY == 0){
                $perCurrrentY = ($revenueCurrentY/1)*100;
            } else {
                $perCurrrentY = ($revenueCurrentY/$revenueLastY)*100;
            }
            //Chart2-Chart3
            $revenueCurrentM = OrderUser::whereMonth('created_at',Carbon::now()->month)->whereYear('created_at',Carbon::now()->year)->sum('total_price');
            $revenueCurrentM1 = OrderUser::whereMonth('created_at',Carbon::now()->subMonth(1))->sum('total_price');
            $revenueCurrentM2 = OrderUser::whereMonth('created_at',Carbon::now()->subMonth(2))->sum('total_price');
            $revenueCurrentM3 = OrderUser::whereMonth('created_at',Carbon::now()->subMonth(3))->sum('total_price');
            $revenueCurrentM4 = OrderUser::whereMonth('created_at',Carbon::now()->subMonth(4))->sum('total_price');
            $revenueCurrentM5 = OrderUser::whereMonth('created_at',Carbon::now()->subMonth(5))->sum('total_price');
            $revenueCurrentM6 = OrderUser::whereMonth('created_at',Carbon::now()->subMonth(6))->sum('total_price');
            $revenueCurrentM7 = OrderUser::whereMonth('created_at',Carbon::now()->subMonth(7))->sum('total_price');
            $revenueCurrentM8 = OrderUser::whereMonth('created_at',Carbon::now()->subMonth(8))->sum('total_price');
            $revenueCurrentM9 = OrderUser::whereMonth('created_at',Carbon::now()->subMonth(9))->sum('total_price');
            $revenueCurrentM10 = OrderUser::whereMonth('created_at',Carbon::now()->subMonth(10))->sum('total_price');
            $revenueCurrentM11 = OrderUser::whereMonth('created_at',Carbon::now()->subMonth(11))->sum('total_price');
            //Chart4
            $current_day_order_week = OrderUser::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->whereDay('created_at',Carbon::now()->day)->sum('total_price');

            $yesterday_day_order_week = OrderUser::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->whereDay('created_at',Carbon::now()->subDay(1))->sum('total_price');

            $yesterday_day_2_order_week = OrderUser::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->whereDay('created_at',Carbon::now()->subDay(2))->sum('total_price');

            $yesterday_day_3_order_week = OrderUser::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->whereDay('created_at',Carbon::now()->subDay(3))->sum('total_price');

            $yesterday_day_4_order_week = OrderUser::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->whereDay('created_at',Carbon::now()->subDay(4))->sum('total_price');

            $yesterday_day_5_order_week = OrderUser::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->whereDay('created_at',Carbon::now()->subDay(5))->sum('total_price');

            $yesterday_day_6_order_week = OrderUser::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->whereDay('created_at',Carbon::now()->subDay(6))->sum('total_price');

            $total7day = $current_day_order_week + $yesterday_day_order_week + $yesterday_day_2_order_week + $yesterday_day_3_order_week + $yesterday_day_4_order_week  + $yesterday_day_4_order_week + $yesterday_day_6_order_week;

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
            'totalOrder' => $totalOrder,
            'revenueCurrentY' => $revenueCurrentY,
            'revenueLastY' => $revenueLastY,
            'revenueLastY1' => $revenueLastY1,
            'revenueLastY2' => $revenueLastY2,
            'revenueLastY3' => $revenueLastY3,
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
        ];
        return view('backend.dashboard')->with($data_send);
    }
}
