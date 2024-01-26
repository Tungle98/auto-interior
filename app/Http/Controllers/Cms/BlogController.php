<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TraitController\BaseController;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\Cms\PromotionRequest;
use App\Models\Blog;
use App\Traits\HandleUploadImage;
use Illuminate\Http\Request;
use Illuminate\Http\ResponseTrait;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    use  ResponseTrait, BaseController, HandleUploadImage;

    //
    public function index(Request $request)
    {
        $list = Blog::latest()->get();
        if ($request->ajax()) {
            $data = Blog::latest()->get();
            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a data-id="' . $row->id . '" href="' . route('cms.blog.create-edit', $row->id) . '" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Sửa">Sửa</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProperty">Xóa</a>';

                    return $btn;
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == 0) {
                        return 'Không hiển thị';
                    } elseif ($row->status == 1) {
                        return 'Hiển thị';
                    } else {
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
        return view('admin/pages/blog/list-blog', compact('list'));
    }

    public function createOrEdit($id = null)
    {
        if ($id != null) {
            $query = Blog::getDetail($id);
            if ($query == null) {
                return back()->with('errors', 'Not Found!');
            }
            return view('admin/pages/blog/store-edit', compact('query'));
        }
        return view('admin/pages/blog/store-edit');
    }

    public function edit($id)
    {
        $build = Blog::find($id);
        return response()->json($build);
    }

    public function store(BlogRequest $request)
    {
//        dd($request->all());
        $params = $request->all();
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
        $params["slug"] = Str::slug($request->title);

        Blog::storeOrUpdate($params);
        return back()->with('message', 'Tạo bài viết thành công!');

    }

    public function update(BlogRequest $request, $id)
    {
        //
        $params = $request->all();
        $params['id'] = $id;
        if ($request->file('image')) {
            $image = $request->file('image');

            $name = Str::slug($request->input('name')).'_'.time();
            $folder = '/uploads/images/';
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/images/'), $filePath);
            $params['image'] = $filePath;
        }
        $params["slug"] = Str::slug($request->title);
        Blog::storeOrUpdate($params);

        return back()->with('message', 'Cập nhật bài viết thành công!');
    }

    public function delete($id)
    {
        //
        Blog::query()->find($id)->delete();
        return back()->with('success', 'Delete Success!');
    }
}
