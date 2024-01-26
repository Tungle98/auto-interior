<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ConfigController extends Controller
{
    //
    public function index(Request $request)
    {
        $list = Config::latest()->get();
        if ($request->ajax()) {
            $data = Config::latest()->get();
            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProperty">Sửa</a>';
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
        return view('admin/pages/config-system/list-config', compact('list'));
    }

    public function store(Request $request)
    {
//dd($request->all());
        Config::updateOrCreate(['id' => $request->property_id],
            ['title' => $request->title, 'type' => 'config', 'content' => $request['content']]);

        return back()->with('message', 'Tạo bản ghi thành công');
    }
    public function edit($id)
    {
        //
        $property = Config::find($id);
        return response()->json($property);
    }
    public function update(Request $request)
    {
        //
        $config = Config::find($request->id);
        $config->title = $request->title;
        $config->type = $request->type;
        $config->content = $request['content'];

        $config->save();

        return response()->json(['message'=>'Cập nhật bản ghi thành công.']);
    }
    public function delete($id)
    {
        //
        Config::find($id)->delete();

        return back()->with('message', 'Xóa bản ghi thành công');
    }
}
