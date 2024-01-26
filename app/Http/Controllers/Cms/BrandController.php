<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BrandController extends Controller
{
    //
    public function index(Request $request)
    {
        $list = Brand::latest()->get();
        if ($request->ajax()) {
            $data = Brand::latest()->get();
            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProperty">Sửa</a>';
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
        return view('admin/pages/brand/list-brand',compact('list'));
    }
    public function store(BrandRequest $request)
    {

        Brand::updateOrCreate(['id' => $request->property_id],
            ['name' => $request->name, 'status' =>  $request->status,'desc' => $request['desc']]);

        return back()->with('message', 'Tạo bản ghi thành công');
    }
    public function edit($id)
    {
        //
        $property = Brand::find($id);
        return response()->json($property);
    }
    public function update(Request $request)
    {
        //
        $config = Brand::find($request->id);
        $config->name = $request->name;
        $config->status = $request->status;
        $config->desc = $request['desc'];

        $config->save();

        return response()->json(['message'=>'Cập nhật bản ghi thành công.']);
    }
    public function delete($id)
    {
        //
        Brand::find($id)->delete();

        return back()->with('message', 'Xóa bản ghi thành công');
    }
}
