<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use app\Model\Blog;
class StoreBlogPost extends FormRequest
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
            'name'=>'required|unique:blog,name',
            'description'=>'required',
            'content'=>'required',
            'file'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Tên tin tức không được để trống',
            'name.unique'=>'Tin tức này đã tồn tại',
            'description.required'=>'Vui lòng nhập mô tả tin tức',
            'content.required'=>'Vui lòng nhập chi tiết tin tức',
            'file.required'=>'Vui lòng chọn ảnh đại diện',
            'file.image'=>'File này không phải là ảnh',
            'file.max'=>'Ảnh không được vượt quá 2048 KB'
        ];
    }
}
