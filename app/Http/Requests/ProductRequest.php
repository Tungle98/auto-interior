<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5|max:191',
            'desc' => 'required|min:5',
            'content' => 'required|min:5',
            'status'=>'required|integer',
            'price' => 'required',
            'category_id' =>'required',
            'brand_id' => 'required',
            'image'=> 'required'
        ];
    }

    public function messages()
    {
        return[
            'name.required'=>'Tiêu đề là bắt buộc',
            'name.min'=>'Tiêu đề tối thiểu 5 kí tự',
            'desc.required'=>'Mô tả là bắt buộc',
            'content.required'=>'Nội dung là bắt buộc',
            'image.required' =>'Hình ảnh là bắt buộc',
            'price.required' =>'Giá là bắt buộc',
            'status.integer'=>'Trạng thái là bắt buộc',
            'category_id.required' =>'Danh mục là bắt buộc',
            'brand_id.required' =>'Nhãn hàng là bắt buộc',
        ];
    }
}
