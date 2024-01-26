<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromotionRequest extends FormRequest
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
            'status'=>'required|integer',
            'image'=> 'required'
        ];
    }

    public function messages()
    {
        return[
            'name.required'=>'Tiêu đề là bắt buộc',
            'name.min'=>'Tiêu đề tối thiểu 5 kí tự',
            'desc.required'=>'Mô tả là bắt buộc',
            'image.required' =>'Hình ảnh là bắt buộc',
            'status.integer'=>'Trạng thái là bắt buộc',
        ];
    }
}
