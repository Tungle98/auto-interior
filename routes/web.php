<?php

use App\Http\Controllers\frontend\BlogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('logout','\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::get('/', [\App\Http\Controllers\frontend\HomeController::class, "index"])->name('home');
Route::get('/contact', function () {
    return view('frontend.pages.contact');
})->name('contact');
Route::get('/intro', function () {
    return view('frontend.pages.intro');
})->name('intro');
//blog
Route::get('/blogs', [\App\Http\Controllers\frontend\BlogController::class, "index"])->name('blogs');
Route::get('/blog/{slug}', [\App\Http\Controllers\frontend\BlogController::class, "detailBlog"])->name('blog');
Route::get('/blogs/search', [BlogController::class, 'searchBlog'])->name('search-blog');
//product
Route::get('/cua-hang', [\App\Http\Controllers\frontend\ProductController::class, "index"])->name('cua-hang');
Route::get('/san-pham/{slug}', [\App\Http\Controllers\frontend\ProductController::class, "detailProduct"])->name('san-pham');
Route::get('/brand/{slug}', [\App\Http\Controllers\frontend\ProductController::class, "brandProduct"])->name('brand');
Route::get('/danh-muc/{slug}', [\App\Http\Controllers\frontend\ProductController::class, "categoryProduct"])->name('danh-muc');
Route::get('/danh-muc/{slug}/{orderby?}', [\App\Http\Controllers\frontend\ProductController::class, "searchProduct"])->name('danh-muc');
Route::post('/send-request', [App\Http\Controllers\frontend\HomeController::class, 'sendRequest'])->name('send-request');
//cms route

Auth::routes();
Route::group([
    'prefix' => 'cms',
    'as' => 'cms.',
    'middleware' => 'auth'
], function () {
    Route::get('', [\App\Http\Controllers\Cms\HomeController::class, 'index']);
    Route::group([
        'prefix' => 'promotion',
        'as' => 'promotion.'
    ], function () {
        Route::get('', [\App\Http\Controllers\Cms\PromotionController::class, 'index'])->name('index');
        Route::get('getDataTable', [\App\Http\Controllers\Cms\PromotionController::class, 'getDataTable'])->name('getDataTable');
        Route::get('create-edit/{id?}', [\App\Http\Controllers\Cms\PromotionController::class, 'createOrEdit'])->name('create-edit');
        Route::post('store', [\App\Http\Controllers\Cms\PromotionController::class, 'store'])->name('store');
        Route::post('update/{id}', [\App\Http\Controllers\Cms\PromotionController::class, 'update'])->name('update');
        Route::POST('delete/{id}', [\App\Http\Controllers\Cms\PromotionController::class, 'delete'])->name('delete');
        Route::get('change-show/{id}', [\App\Http\Controllers\Cms\PromotionController::class, 'changeShow'])->name('change-show');
    });

    Route::group([
        'prefix' => 'customer-request',
        'as' => 'customer-request.'
    ], function () {
        Route::get('', [\App\Http\Controllers\Cms\CustomerRequestController::class, 'index'])->name('index');
        Route::post('/store', [\App\Http\Controllers\Cms\CustomerRequestController::class, 'store'])->name('store');
        Route::get('{id}/edit', [\App\Http\Controllers\Cms\CustomerRequestController::class, 'edit'])->name('edit');
    });

    Route::group([
        'prefix' => 'config-system',
        'as' => 'config-system.'
    ], function () {
        Route::get('', [\App\Http\Controllers\Cms\ConfigController::class, 'index'])->name('index');
        Route::post('/store', [\App\Http\Controllers\Cms\ConfigController::class, 'store'])->name('store');
        Route::post('/delete/{id}', [\App\Http\Controllers\Cms\ConfigController::class, 'delete'])->name('delete');
        Route::get('{id}/edit', [\App\Http\Controllers\Cms\ConfigController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [\App\Http\Controllers\Cms\ConfigController::class, 'update'])->name('update');
    });
    Route::group([
        'prefix' => 'feedback-video',
        'as' => 'feedback-video.'
    ], function () {
        Route::get('', [\App\Http\Controllers\Cms\FeedBackVideoController::class, 'index'])->name('index');
        Route::get('create-edit/{id?}', [\App\Http\Controllers\Cms\FeedBackVideoController::class, 'createOrEdit'])->name('create-edit');
        Route::post('/store', [\App\Http\Controllers\Cms\FeedBackVideoController::class, 'store'])->name('store');
        Route::post('/delete/{id}', [\App\Http\Controllers\Cms\FeedBackVideoController::class, 'delete'])->name('delete');
        Route::get('{id}/edit', [\App\Http\Controllers\Cms\FeedBackVideoController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [\App\Http\Controllers\Cms\FeedBackVideoController::class, 'update'])->name('update');
    });
    Route::group([
        'prefix' => 'product',
        'as' => 'product.'
    ], function () {
        Route::get('', [\App\Http\Controllers\Cms\ProductController::class, 'index'])->name('index');
        Route::get('create-edit/{id?}', [\App\Http\Controllers\Cms\ProductController::class, 'createOrEdit'])->name('create-edit');
        Route::post('store', [\App\Http\Controllers\Cms\ProductController::class, 'store'])->name('store');
        Route::post('update/{id}', [\App\Http\Controllers\Cms\ProductController::class, 'update'])->name('update');
        Route::post('delete/{id}', [\App\Http\Controllers\Cms\ProductController::class, 'delete'])->name('delete');
        Route::get('change-show/{id}', [\App\Http\Controllers\Cms\ProductController::class, 'changeShow'])->name('change-show');
    });

    Route::group([
        'prefix' => 'category',
        'as' => 'category.'
    ], function () {
        Route::get('', [\App\Http\Controllers\Cms\CategoryController::class, 'index'])->name('index');
        Route::post('update/{id}', [\App\Http\Controllers\Cms\CategoryController::class, 'update'])->name('update');
        Route::post('/store', [\App\Http\Controllers\Cms\CategoryController::class, 'store'])->name('store');
        Route::get('{id}/edit', [\App\Http\Controllers\Cms\CategoryController::class, 'edit'])->name('edit');
        Route::get('change-show/{id}', [\App\Http\Controllers\Cms\CategoryController::class, 'changeShow'])->name('change-show');
        Route::post('/delete/{id}', [\App\Http\Controllers\Cms\CategoryController::class, 'delete'])->name('delete');
    });

    Route::group([
        'prefix' => 'blog',
        'as' => 'blog.'
    ], function () {
        Route::get('', [\App\Http\Controllers\Cms\BlogController::class, 'index'])->name('index');
        Route::get('create-edit/{id?}', [\App\Http\Controllers\Cms\BlogController::class, 'createOrEdit'])->name('create-edit');
        Route::post('store', [\App\Http\Controllers\Cms\BlogController::class, 'store'])->name('store');
        Route::post('update/{id}', [\App\Http\Controllers\Cms\BlogController::class, 'update'])->name('update');
        Route::post('delete/{id}', [\App\Http\Controllers\Cms\BlogController::class, 'delete'])->name('delete');
        Route::get('change-show/{id}', [\App\Http\Controllers\Cms\BlogController::class, 'changeShow'])->name('change-show');
    });

    Route::group([
        'prefix' => 'brand',
        'as' => 'brand.'
    ], function () {
        Route::get('', [\App\Http\Controllers\Cms\BrandController::class, 'index'])->name('index');
        Route::post('update/{id}', [\App\Http\Controllers\Cms\BrandController::class, 'update'])->name('update');
        Route::post('/store', [\App\Http\Controllers\Cms\BrandController::class, 'store'])->name('store');
        Route::get('{id}/edit', [\App\Http\Controllers\Cms\BrandController::class, 'edit'])->name('edit');
        Route::get('change-show/{id}', [\App\Http\Controllers\Cms\BrandController::class, 'changeShow'])->name('change-show');
        Route::post('/delete/{id}', [\App\Http\Controllers\Cms\BrandController::class, 'delete'])->name('delete');
    });

    Route::group([
        'prefix' => 'slider',
        'as' => 'slider.'
    ], function () {
        Route::get('', [\App\Http\Controllers\Cms\SliderController::class, 'index'])->name('index');
        Route::get('create-edit/{id?}', [\App\Http\Controllers\Cms\SliderController::class, 'createOrEdit'])->name('create-edit');
        Route::post('update/{id}', [\App\Http\Controllers\Cms\SliderController::class, 'update'])->name('update');
        Route::post('/store', [\App\Http\Controllers\Cms\SliderController::class, 'store'])->name('store');
        Route::post('/delete/{id}', [\App\Http\Controllers\Cms\SliderController::class, 'delete'])->name('destroy');
        Route::get('{id}/edit', [\App\Http\Controllers\Cms\SliderController::class, 'edit'])->name('edit');
        Route::get('change-show/{id}', [\App\Http\Controllers\Cms\SliderController::class, 'changeShow'])->name('change-show');
    });
    Route::group([
        'prefix' => 'user',
        'as' => 'user.'
    ], function () {
        Route::get('', [\App\Http\Controllers\Cms\UserController::class, 'index'])->name('index');
        Route::post('/store', [\App\Http\Controllers\Cms\UserController::class, 'store'])->name('store');
        Route::post('/delete/{id}', [\App\Http\Controllers\Cms\UserController::class, 'delete'])->name('destroy');
        Route::get('{id}/edit', [\App\Http\Controllers\Cms\UserController::class, 'edit'])->name('edit');
    });

    Route::group([
        'prefix' => 'role',
        'as' => 'role.'
    ], function () {
        Route::get('', [\App\Http\Controllers\Cms\RoleController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Cms\RoleController::class, 'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Cms\RoleController::class, 'store'])->name('store');
        Route::post('/delete/{id}', [\App\Http\Controllers\Cms\RoleController::class, 'delete'])->name('destroy');
        Route::get('{id}/edit', [\App\Http\Controllers\Cms\RoleController::class, 'edit'])->name('edit');
    });

    Route::group([
        'prefix' => 'permission',
        'as' => 'permission.'
    ], function () {
        Route::get('', [\App\Http\Controllers\Cms\PermissionController::class, 'index'])->name('index');
        Route::post('/store', [\App\Http\Controllers\Cms\PermissionController::class, 'store'])->name('store');
        Route::post('/delete/{id}', [\App\Http\Controllers\Cms\PermissionController::class, 'delete'])->name('destroy');
        Route::get('{id}/edit', [\App\Http\Controllers\Cms\PermissionController::class, 'edit'])->name('edit');
    });
});



