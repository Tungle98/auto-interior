<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        $list = User::latest()->get();
        if ($request->ajax()) {
            $data = User::latest()->get();
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
        return view('admin/pages/user/list-user',compact('list'));
    }

    public function store(Request $request)
    {
        User::updateOrCreate(['id' => $request->property_id],
            ['name' => $request->name, 'email' =>  $request->email,'password'=>  Hash::make($request->password)]);

        return back()->with('message', 'Tạo bản ghi thành công');

    }
    public function edit($id)
    {
        //
        $property = User::find($id);
        return response()->json($property);
    }
    public function update(Request $request)
    {
        //
        $config = User::find($request->id);
        $config->name = $request->name;
        $config->email = $request->email;
        $config->password = Hash::make($request->password);

        $config->save();

        return response()->json(['message'=>'Cập nhật bản ghi thành công.']);
    }
    public function delete($id)
    {
        //
        User::find($id)->delete();

        return back()->with('message', 'Xóa bản ghi thành công');
    }
}
