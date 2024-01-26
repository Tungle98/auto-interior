<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionRequest;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class PromotionController extends Controller
{
    //
    public function index(Request $request)
    {
        $list = Discount::latest()->get();
        if ($request->ajax()) {
            $data = Discount::latest()->get();
            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a data-id="' . $row->id . '" href="' . route('cms.promotion.create-edit', $row->id) . '" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Sửa">Sửa</a>';

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
        return view('admin/pages/promotion/list-promotion',compact('list'));
    }
    public function createOrEdit($id = null)
    {
        if ($id != null) {
            $query = Discount::getDetail($id);
            if ($query == null) {
                return back()->with('errors', 'Not Found!');
            }
            return view('admin/pages/promotion/store-edit', compact('query'));
        }
        return view('admin/pages/promotion/store-edit');
    }
    public function store(PromotionRequest $request)
    {
        Discount::updateOrCreate(['id' => $request->property_id],
            ['name' => $request->name, 'status' =>  $request->status,'desc' => $request['desc'],'image'=>  $request->image]);

        return back()->with('message', 'Tạo bản ghi thành công');

    }

    public function update(PromotionRequest $request, $id)
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
        Discount::storeOrUpdate($params);

        return Redirect::route('cms.promotion.index')->with('message', 'Cập nhật khuyến mãi  thành công!');
    }
    public function delete($id)
    {
        //
        Discount::find($id)->delete();

        return back()->with('message', 'Xóa bản ghi thành công');
    }

}
