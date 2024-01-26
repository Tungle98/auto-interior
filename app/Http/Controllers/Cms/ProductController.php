<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    //
    public function index(Request $request)
    {
        $list = Product::latest()->get();
        if ($request->ajax()) {
            $data = Product::latest()->get();
            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a data-id="' . $row->id . '" href="' . route('cms.product.create-edit', $row->id) . '" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Sửa">Sửa</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProperty">Xóa</a>';

                    return $btn;
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == 0) {
                        return 'Không hiển thị';
                    } elseif ($row->status == 1) {
                        return 'Hiển thị';
                    }
                    else {
                        return ``;
                    }
                })
                ->addColumn('created_at', function ($row) {
                    $createTime = Carbon::parse($row->created_at)->toDateTimeString();
                    return $createTime;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin/pages/product/list-product',compact('list'));
    }

    public function createOrEdit($id = null){
        $categories = Category::query()->where('status','=',1)->get();
        $brands = Brand::query()->where('status','=',1)->get();
        if ($id != null) {
            $query = Product::getDetail($id);
            if ($query == null) {
                return back()->with('errors', 'Not Found!');
            }
            return view('admin/pages/product/store-edit', compact('query','categories','brands'));
        }

        return view('admin/pages/product/store-edit',compact('categories', 'brands'));
    }

    public function store(ProductRequest $request)
    {
        $params = $request->all();
        $params['price']= str_replace(',','',$request->price);
        $params['price_discount']= str_replace(',','',$request->price_discount);
        $request->validate([
            'image' => 'required|max:2048'
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $name = Str::slug($request->input('name')).'_'.time();
            $folder = '/uploads/images/';
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/images/'), $filePath);
            $params['image'] = $filePath;
        }
        $params["slug"] = Str::slug($request->name);
         Product::storeOrUpdate($params);
        return Redirect::route('cms.product.index')->with('message', 'Tạo mới sản phẩm thành công!');

    }
    public function update(ProductRequest $request, $id)
    {
        //
        $params = $request->all();
        $params['id'] = $id;
        $params['price']= str_replace(',','',$request->price);
        $params['price_discount']= str_replace(',','',$request->price_discount);
        if ($request->file('image')) {
            $image = $request->file('image');

            $name = Str::slug($request->input('name')).'_'.time();
            $folder = '/uploads/images/';
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/images/'), $filePath);
            $params['image'] = $filePath;
        }
        $params["slug"] = Str::slug($request->name);
        Product::storeOrUpdate($params);

        return back()->with('message', 'Cập nhật sản phẩm thành công!');
    }
    public function delete($id)
    {
        //
         Product::query()->find($id)->delete();
        return back()->with('success', 'Delete Success!');
    }

}
