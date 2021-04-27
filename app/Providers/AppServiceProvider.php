<?php

namespace App\Providers;

use App\Model\Category;
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
            $cateParent = Category::where('parent_id', 0)->where('draff', 0)->where('status', 1)->where('status_cus', 1)->where('status', 1)->get();
            if(count($cateParent)) {
                $view->with(['cateParent' => $cateParent]);
            }
        });
    }
}
