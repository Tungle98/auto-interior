<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PermissionController extends Controller
{
    //
    public function index(Request $request)
    {
        $list = Permission::latest()->get();
        if ($request->ajax()) {
            $data = Permission::latest()->get();
            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProperty">Sửa</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProperty">Xóa</a>';

                    return $btn;
                })
                ->addColumn('created_at', function ($row) {
                    $createTime = Carbon::parse($row->created_at)->toDateTimeString();
                    return $createTime;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin/pages/permission/list-permission',compact('list'));
    }
    public function store(Request $request)
    {
        Permission::updateOrCreate(['id' => $request->property_id],
            ['name' => $request->name,'guard_name' => 'web']);

        return back()->with('message', 'Tạo bản ghi thành công');

    }
    public function edit($id)
    {
        //
        $property = Permission::find($id);
        return response()->json($property);
    }
    public function update(Request $request)
    {
        //
        $config = Permission::find($request->id);
        $config->name = $request->name;

        $config->save();

        return response()->json(['message'=>'Cập nhật bản ghi thành công.']);
    }
    public function delete($id)
    {
        //
        Permission::find($id)->delete();

        return back()->with('message', 'Xóa bản ghi thành công');
    }
}
