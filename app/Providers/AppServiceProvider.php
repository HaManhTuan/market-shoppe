<?php

namespace App\Providers;

use App\Model\Category;
use App\Model\Config;
use Cart;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $dataConfig = Config::find(1);
            $cart_data = Cart::getContent();
            $count_cart = $cart_data->count();
            $cart_subtotal = Cart::getSubTotal();
            $cateRandom = Category::where('parent_id', 0)->where('draff', 0)->where('status', 1)->where('status_cus', 1)->where('status', 1)->get()->random(4);
            $cateParent = Category::where('parent_id', 0)->where('draff', 0)->where('status', 1)->where('status_cus', 1)->where('status', 1)->get();
            $data_send = [
                'cateParent' => $cateParent ? $cateParent : [],
                'cart_data' => $cart_data ? $cart_data : [],
                'count_cart' => $count_cart  ? $count_cart : 0,
                'cart_subtotal' => $cart_subtotal  ? $cart_subtotal : 0,
                'cateRandom' => $cateRandom  ? $cateRandom : [],
                'dataConfig' => $dataConfig  ? $dataConfig : []
            ];

            if(count($cateParent)) {
                $view->with($data_send);
            }
        });
    }
}
