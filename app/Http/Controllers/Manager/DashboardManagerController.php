<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\OrderUser;
use App\Model\Product;
use App\User;
use DB;
use Illuminate\Http\Request;

class DashboardManagerController extends Controller
{
    public function index(){
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
