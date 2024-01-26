<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FeedBackVideo;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class FeedBackVideoController extends Controller
{
    //
    public function index(Request $request)
    {
        $list = FeedBackVideo::latest()->get();
        if ($request->ajax()) {
            $data = FeedBackVideo::latest()->get();
            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a data-id="' . $row->id . '" href="' . route('cms.feedback-video.create-edit', $row->id) . '" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Sửa">Sửa</a>';

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
        return view('admin/pages/feedback/list-feedback-video',compact('list'));
    }
    public function createOrEdit($id = null)
    {
        if ($id != null) {
            $query = FeedBackVideo::getDetail($id);
            if ($query == null) {
                return back()->with('errors', 'Not Found!');
            }
            return view('admin/pages/feedback/store-edit', compact('query'));
        }
        return view('admin/pages/feedback/store-edit');
    }
    public function store(Request $request)
    {

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
        FeedBackVideo::storeOrUpdate($params);
        return back()->with('message', 'Tạo video feedback thành công!');

    }
    public function edit($id)
    {
        //
        $property = FeedBackVideo::find($id);
        return response()->json($property);
    }
    public function update(Request $request, $id)
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
        FeedBackVideo::storeOrUpdate($params);

        return Redirect::route('cms.feedback-video.index')->with('message', 'Cập nhật slider thành công!');
    }
    public function delete($id)
    {
        //
        FeedBackVideo::find($id)->delete();

        return back()->with('message', 'Xóa bản ghi thành công');
    }
}
