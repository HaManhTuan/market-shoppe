<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Model\Order;
use Illuminate\Http\Request;

class OrderManagerController extends Controller
{
    public function index($id)
    {
        $orderDetail = Order::with('customer','orders')->where('id',$id)->first();
        return view('superAdmin.order.view', compact('orderDetail'));
    }
}
