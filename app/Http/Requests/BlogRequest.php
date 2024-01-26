<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'title' => 'required|min:10|max:191',
            'desc' => 'required|min:10',
            'content' => 'required|min:10',
            'status'=>'required|integer',
            'is_top'=>'required|integer',
            'image'=> 'required'
        ];
    }

    public function messages()
    {
        return[
            'title.required'=>'Tiêu đề là bắt buộc',
            'title.min'=>'Tiêu đề tối thiểu 10 kí tự',
            'desc.required'=>'Mô tả là bắt buộc',
            'content.required'=>'Nội dung là bắt buộc',
            'image.required' =>'Hình ảnh là bắt buộc',
            'status.integer'=>'Trạng thái là bắt buộc',
            'is_top.integer'=>'Trạng thái là bắt buộc',
        ];
    }
}
