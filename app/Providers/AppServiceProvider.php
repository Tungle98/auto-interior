<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Config;
use App\Models\Product;
use Illuminate\Support\Facades\View;
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
        //
        $categories = Category::query()->where('status','=',1)->take(8)->get();
        $productTop = Product::query()->where('status',1)->latest()->take(5)->get();
        $blogTop = Blog::query()->latest()->where('status',1)->where('is_top',1)->take(5)->get();
        $config = Config::whereIn('type', ['config'])->get();
        $arrayConfig = [];
        foreach ($config as $value) {
            $arrayConfig[$value->title] = $value->content;
        }
        View::share(['categories' => $categories, 'productTop' =>$productTop, 'blogTop' => $blogTop,'contact' => $arrayConfig]);
    }
}
