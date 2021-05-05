<?php

namespace App\Providers;

use App\Model\Category;
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
            $cart_data = Cart::getContent();
            $count_cart = $cart_data->count();
            $cart_subtotal = Cart::getSubTotal();
            $cateParent = Category::where('parent_id', 0)->where('draff', 0)->where('status', 1)->where('status_cus', 1)->where('status', 1)->get();
            $data_send = [
                'cateParent' => $cateParent,
                'cart_data' => $cart_data,
                'count_cart' => $count_cart,
                'cart_subtotal' => $cart_subtotal
            ];

            if(count($cateParent)) {
                $view->with($data_send);
            }
        });
    }
}
