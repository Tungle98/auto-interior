<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CustomerRequestController extends Controller
{
    //
    public function index(Request $request)
    {
        $list = CustomerRequest::latest()->get();
        if ($request->ajax()) {
            $data = CustomerRequest::latest()->get();
            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
//                    $btn = '<a data-id="' . $row->id . '" href="' . route('cms.promotion.create-edit', $row->id) . '" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Sửa">Sửa</a>';
                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProperty">Xóa</a>';

                    return $btn;
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == 0) {
                        return 'Chưa xử lý';
                    } elseif ($row->status == 1) {
                        return 'Đã xử lý TT';
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
        return view('admin/pages/customer/list-request',compact('list'));
    }
}
