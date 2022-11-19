<?php

namespace App\Providers;
use App\Product;
use App\Post;
use App\Order;
use App\Customer;
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

        view() -> composer('*', function($view)
        {
        $app_product = Product::all()->count();
        $app_post = Post::all()->count();
        $app_order = Order::all()->count();
        $app_customer = Customer::all()->count();

        $product_views = Product::orderby('product_views','DESC')->take(15)->get();
        $post_views = Post::orderby('post_views','DESC')->take(15)->get();

        $view->with(compact('app_product','app_post','app_order','app_customer' ,'product_views','post_views'));
        // $view->with('product',$product)->with('post',$post)->with('order',$order)->with('customer',$customer);
    });
    }
}
