<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RoleController extends Controller
{

//    function __construct()
//
//    {
//
//        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
//
//        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
//
//        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
//
//        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
//
//    }

    //
    public function index(Request $request)
    {
        $list = Role::latest()->get();
        if ($request->ajax()) {
            $data = Role::latest()->get();
            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProperty">Sửa</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProperty">Xóa</a>';

                    return $btn;
                })
                ->addColumn('created_at', function ($row) {
                    $createTime = Carbon::parse($row->created_at)->toDateTimeString();
                    return $createTime;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin/pages/role/list-role', compact('list'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin/pages/role/create', compact('permissions'));
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',

        ]);
        $role = Role::create(['name' => $request->input('name'),'guard_name	' => 'web']);

        $role->syncPermissions($request->input('permission'));


        return redirect()->route('cms.role.index')
            ->with('success', 'Role created successfully');
    }

    public function delete($id)
    {
        //
        Role::find($id)->delete();

        return back()->with('message', 'Xóa bản ghi thành công');
    }
}
