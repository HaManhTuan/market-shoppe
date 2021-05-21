<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\OrderUser;
use App\Model\Product;
use App\User;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
class DashboardManagerController extends Controller
{
    public function index(){
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d');
        $monthStartDate = $now->startOfMonth()->format('Y-m');
        $carbaoDay = Carbon::createFromFormat('Y-m-d', $weekStartDate); //spesific day
        $week = [];
        $month = [];
        $year = [];
        $total_price_user = [];
        $total_price_user_month = [];
        for ($i=0; $i <7 ; $i++) {
            $week[] = $carbaoDay->startOfWeek()->addDay($i)->format('Y-m-d');//push the current day and plus the mount of $i
        }
        for ($i=0; $i <4 ; $i++) {
            $month[] = Carbon::now()->subMonth($i)->format('m');//push the current day and plus the mount of $i
            $year[] = Carbon::now()->subMonth($i)->format('Y');//push the current day and plus the mount of $i
        }
        foreach($week as $value) {
           $total_sum = Order::whereDate('updated_at',$value)->sum('total_price');
           array_push($total_price_user, $total_sum);
        }

        foreach($month as $value) {
            $total_sum_month = Order::whereMonth('updated_at',$value)->whereYear('updated_at',$year[0])->sum('total_price');
            array_push($total_price_user_month, $total_sum_month);
        }

        $allEngine = Order::sum('total_price');
        $allView = Product::sum('count_view');
        $allOrder = Product::orderBy('created_at', 'DESC')->get();
        $allUser = User::orderBy('created_at', 'DESC')->get();
        $allOrderOfUser = User::query()->with([
            'product' => function($q) {
                $q->selectRaw("SUM(buy_count) as sum_buy, author_id")->groupBy('author_id');
            },
            'order_user' => function($q) {
                $q->selectRaw("SUM(total_price) as sum_total_price, user_id")->where('order_status', 4)->groupBy('user_id');
            },
        ])->paginate(5);
        $productCoutBuy = Product::with('user')->orderBy('buy_count')->paginate(5);
        $ordersNews = Order::orderBy('created_at','DESC')->paginate(5);
        // echo "<pre>";
        // print_r($allOrderOfUser);
        // echo "</pre>";
        // die;
        $data_send = [
            'allEngine' => $allEngine,
            'allView' => $allView,
            'allOrder' => $allOrder,
            'allUser' => $allUser,
            'allOrderOfUser' => $allOrderOfUser,
            'productCoutBuy' => $productCoutBuy,
            'ordersNews' => $ordersNews,
            'total_price_user' => $total_price_user,
            'total_price_user_month' => $total_price_user_month
        ];
        return view('superAdmin.dashboard')->with($data_send);
    }
    // public function getPrice(){
    //     $data = Cate::selectRaw("YEAR(created_at) year, MONTH(created_at) month, count(id) as total, SUM(price) as price")
    //         ->where('status', 1)
    //         ->groupBy(['year', 'month'])
    //         ->orderBy('year', 'desc')
    //         ->orderBy('month', 'desc')
    //         ->get();
    //     return $data->map(function ($data) {
    //         return 'Tháng: '.$data->month;
    //     });
    // }
}
