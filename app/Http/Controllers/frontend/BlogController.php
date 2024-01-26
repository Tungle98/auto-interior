<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function index()
    {
        $blogs = Blog::query()->latest()->simplePaginate(9);
        return view('frontend.pages.blog.list-blog', compact('blogs'));

    }

    public function detailBlog($slug)
    {
        $detail = Blog::query()->where('slug', $slug)->first();;
        return view('frontend/pages/blog/detail-blog', compact('detail'));
    }

    public function searchBlog(Request $request){
        $name = $request->key;
        $result = Blog::where('title', 'LIKE', '%' . $name . '%')
            ->get();
        return view('frontend/pages/blog/result-search-blog', compact('result'));
    }
}
