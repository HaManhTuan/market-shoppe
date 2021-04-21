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
        return view('backend.dashboard');
    }
}
