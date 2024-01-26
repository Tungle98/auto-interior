<?php

namespace App\Http\Controllers\TraitController;

use App\Http\Requests\Cms\SlideHomeRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

trait BaseController
{
//    public function index()
//    {
//        return view('admin/' . $this->slug . '/index');
//    }

    public function createOrEdit($id = null)
    {
        if ($id != null) {
            $query = $this->model::getDetail($id);
            if ($query == null) {
                return back()->with('errors', 'Not Found!');
            }
            return view('admin/' . $this->slug . '/create-edit', compact('query'));
        }
        return view('admin/' . $this->slug . '/create-edit');
    }

    public function delete($id)
    {
        $data = $this->model::query()->find($id)->delete();
        return back()->with('success', 'Delete Success!');
    }

    public function changeShow($id)
    {
        $query = $this->model::getDetail($id);
        if ($query == null) {
            return $this->ajaxErrorResponse(1, 'Not found!');
        }

        $params = [
            'id' => $id,
            'is_show' => $query->is_show == 0 ? 1 : 0
        ];
        $query = $this->model::storeOrUpdate($params);
        return $this->ajaxSuccessResponse($query, 'Change Success!');
    }

    public function helperStore($request)
    {
        $params = $request->all();
        $column = DB::getSchemaBuilder()->getColumnListing($this->tableName);
        if ($request->hasFile('image')) {
            $size = \Intervention\Image\Facades\Image::make($request['image'])->filesize();
            $url = $this->helperSaveImage($request['image']);
            $params['link_image'] = $url;
            if ($size > 1024000) {
                $params['link_image_average'] = $this->helperResizeImage($request['image'], 50, 'average');
            } else if ($size < 1024000 && $size > 700000) {
                $params['link_image_average'] = $this->helperResizeImage($request['image'], 70, 'average');
            } else {
                $params['link_image_average'] = $url;
            }
            $params['link_image_thumbnail'] = $this->helperResizeImage($request['image'], 25, 'average');
        }
        if ($request->hasFile('icon')) {
            $size = \Intervention\Image\Facades\Image::make($request['icon'])->filesize();
            $url = $this->helperSaveImage($request['icon']);
            $params['icon'] = $url;
            if ($size > 1024000) {
                $params['link_icon_average'] = $this->helperResizeImage($request['icon'], 50, 'average');
            } else if ($size < 1024000 && $size > 700000) {
                $params['link_icon_average'] = $this->helperResizeImage($request['icon'], 70, 'average');
            } else {
                $params['link_icon_average'] = $url;
            }
            $params['link_icon_thumbnail'] = $this->helperResizeImage($request['icon'], 25);
        }
        if ($request->hasFile('reason_choose_image')) {
            $size = \Intervention\Image\Facades\Image::make($request['reason_choose_image'])->filesize();
            $url = $this->helperSaveImage($request['reason_choose_image']);
            $params['reason_choose_image'] = $url;
            if ($size > 1024000) {
                $params['reason_choose_image'] = $this->helperResizeImage($request['reason_choose_image'], 50, 'average');
            } else if ($size < 1024000 && $size > 700000) {
                $params['reason_choose_image'] = $this->helperResizeImage($request['reason_choose_image'], 70, 'average');
            } else {
                $params['reason_choose_image'] = $url;
            }
            $params['reason_choose_image'] = $this->helperResizeImage($request['reason_choose_image'], 25);
        }

        if ($request->has('title')) {
            $params['slug'] = create_slug($params['title']);
        } elseif ($request->has('name')) {
            $params['slug'] = create_slug($params['name']);
        }
        if (in_array('slug', $column)) {
            if ($this->model::getFirstByWhere('slug', '=', $params['slug']) != null) {
                $params['slug'] = $params['slug'] . time();
            }
        }

        return $this->model::storeOrUpdate($params);
    }

    public function helperUpdate($request, $id)
    {
        $params = $request->all();
        $params['id'] = $id;
        $column = DB::getSchemaBuilder()->getColumnListing($this->tableName);

        if ($request->hasFile('image')) {
            $size = \Intervention\Image\Facades\Image::make($request['image'])->filesize();
            $url = $this->helperSaveImage($request['image']);
            $params['link_image'] = $url;
            if ($size > 1024000) {
                $params['link_image_average'] = $this->helperResizeImage($request['image'], 50, 'average');
            } else if ($size < 1024000 && $size > 700000) {
                $params['link_image_average'] = $this->helperResizeImage($request['image'], 70, 'average');
            } else {
                $params['link_image_average'] = $url;
            }
            $params['link_image_thumbnail'] = $this->helperResizeImage($request['image'], 25, 'average');
        }
        if ($request->hasFile('icon')) {
            $size = \Intervention\Image\Facades\Image::make($request['icon'])->filesize();
            $url = $this->helperSaveImage($request['icon']);
            $params['icon'] = $url;
            if ($size > 1024000) {
                $params['link_icon_average'] = $this->helperResizeImage($request['icon'], 50, 'average');
            } else if ($size < 1024000 && $size > 700000) {
                $params['link_icon_average'] = $this->helperResizeImage($request['icon'], 70, 'average');
            } else {
                $params['link_icon_average'] = $url;
            }
            $params['link_icon_thumbnail'] = $this->helperResizeImage($request['icon'], 25);
        }

        if ($request->hasFile('reason_choose_image')) {
            $size = \Intervention\Image\Facades\Image::make($request['reason_choose_image'])->filesize();
            if ($size > 1024000) {
                $params['reason_choose_image'] = $this->helperResizeImage($request['reason_choose_image'], 50, 'average');
            } else if ($size < 1024000 && $size > 700000) {
                $params['reason_choose_image'] = $this->helperResizeImage($request['reason_choose_image'], 70, 'average');
            } else {
                $url = $this->helperSaveImage($request['reason_choose_image']);
                $params['reason_choose_image'] = $url;
            }
        }

        if ($request->has('title')) {
            $params['slug'] = create_slug($params['title']);
        } elseif ($request->has('name')) {
            $params['slug'] = create_slug($params['name']);
        }
        if (in_array('slug', $column)) {
            if (!$this->model::getList(['*'], [], [['column' => 'slug', 'value' => $params['slug']], ['column' => 'id', 'operator' => '!=', 'value' => $id]])->isEmpty()) {
                $params['slug'] = $params['slug'] . time();
            }
        }

        return $this->model::storeOrUpdate($params);
    }

    public function helperSaveImage($image)
    {
        $extension = $image->extension();
        $name = time() . '-' . Auth::id() . '.' . $extension;

        Storage::disk('public')->putFileAs($this->slug . '/', $image, $name);
        return Storage::url('public/' . $this->slug . '/' . $name);
    }

    public function helperResizeImage($image, $scale, string $type = null)
    {
        $extension = $image->extension();
        if ($type == null) {
            $name = time() . '-' . Auth::id() . '.' . $extension;
        } else {
            $name = $type . '-' . time() . '-' . Auth::id() . '.' . $extension;
        }
        return convert_image($image, $this->slug, $name, null, null, $scale);
    }
}
