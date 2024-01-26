<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::query()->latest()->simplePaginate('8');
        return view('frontend/pages/product/list-category', compact('products',));

    }

    public function categoryProduct($slug)
    {
        $categoryProduct = Category::query()->where('slug', $slug)->with('product')->get();
        return view('frontend/pages/product/list-category', compact('categoryProduct'));
    }
    public function brandProduct($slug){
        $brandProduct = Brand::query()->where('slug', $slug)->with('product')->first();
        $productCategory = $brandProduct->product;
//        if ($brandProduct) {
//            $brandProductZtech= $brandProduct->product()->where('status', 1)->pluck('category_id');
////            dd($brandProductZtech,$brandProduct);
//            $related_product = Product::whereHas('category', function ($q) use ($brandProductZtech) {
//                $q->whereIn('id', $brandProductZtech);
//
//            })->where('id', '<>', 1)
//                ->take(4)
//                ->get();
//        }

        return view('frontend/pages/product/list-brand', compact('productCategory'));
    }

    public function detailProduct($slug)
    {
        $product = Product::query()->where('slug', $slug)->with('category')->first();
//        dd($product);
        if ($product){
            $related_category_ids = $product->category()->where('status', 1)->pluck('id');
            $related_product = Product::whereHas('category', function ($q) use ($related_category_ids) {
                $q->whereIn('id', $related_category_ids);
            })->where('id', '<>', $product->id)
                ->take(4)
                ->get();
            return view('frontend/pages/product/product-detail', compact('product','related_product'));
        }
    }

}
