<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Frontend;
use App\Helpers\Frontend\Helper;
use DB;
use Illuminate\Support\Facades\Schema;

use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        view()->composer('*', function ($view) {

            $helper = new Helper();
            $favicon = DB::table('configs')->where('id', 1)->first();
            $logo = DB::table('configs')->where('id', 2)->first();
            $footer_logo = DB::table('configs')->where('id', 3)->first();
            $partners = DB::table('partners')->where('status', 0)->get();
            $total_amount = DB::table('orders')->sum('amount');
            $total_order = DB::table('orders')->count();
            $low_stock = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->where('products.stock', '<', 10)
                ->select('products.*', 'categories.name as category_name')
                ->get();
            $view->with('favicon', $favicon->flag_value);
            $view->with('logo', $logo->flag_value);
            $view->with('helper', $helper);
            $view->with('footer_logo', $logo->flag_value);
            $view->with('partners', $partners);
            $view->with('total_amount', $total_amount);
            $view->with('total_order', $total_order);
            $view->with('low_stock', $low_stock);
        });
    }
}
