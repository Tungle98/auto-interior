<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CustomerRequest;
use App\Models\Discount;
use App\Models\FeedBackVideo;
use App\Models\Product;
use App\Models\Slider;
use App\Notifications\EmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    //
    public function index()
    {
        $sliders = Slider::query()->latest()->where('status', 1)->take(4)->get();
        $blogs = Blog::query()->latest()->where('status', "1")->take(8)->get();
        $categoryProductHome = Category::query()->where('status', '=', 1)->with(['product' => function ($query) {
            $query->where('status', 1)->latest();
        }])->get();
        $brandProductZtech = Brand::query()->where('status', '=', 1)->with(['product' => function ($query) {
            $query->where('status', 1)->latest();
        }])->get();
        $videoFeedback = FeedBackVideo::query()->latest()->where('status', "1")->take(8)->get();
        $promotions = Discount::query()->where('status', 1)->latest()->take(2)->get();
        return view('frontend.pages.home', compact('sliders', 'blogs', 'categoryProductHome', 'promotions', 'brandProductZtech', 'videoFeedback'));
    }

    public function sendRequest(Request $request)
    {
        try {
            $data_create = CustomerRequest::query()->create([
                "email" => $request->post("email"),
                "name" => $request->post("name"),
                "phone" => $request->post("phone"),
                "content" => $request->post("content"),
                "address" => $request->post("address"),
            ]);
            return response(['data' => $data_create, 'message' => 'Gửi thông tin thành công', 'error_code' => 0], 200);
        } catch (\Exception $exception) {
            $message = "File: " . $exception->getFile() . " - Line: " . $exception->getLine() . " - Message: " . $exception->getMessage();
            return response(['message' => 'Có lỗi xảy ra', 'error_code' => 0], 500);
        }
    }
}
