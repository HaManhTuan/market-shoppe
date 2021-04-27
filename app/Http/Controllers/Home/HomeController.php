<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $recomendPro = Product::where('status', 1)->with('product_image')->orderBy('created_at','DESC')->get();
        return view('frontend.home')->with(['recomendPro' => $recomendPro]);
    }
}
