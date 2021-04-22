<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use app\Model\Brand;
class StoreBrandPost extends FormRequest
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
            'name'=>'required|unique:brand,name',
              'file'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Tên thương hiệu không được để trống',
            'name.unique'=>'Thương hiệu này đã tồn tại',
            'file.required'=>'Vui lòng chọn ảnh đại diện',
            'file.image'=>'File này không phải là ảnh',
            'file.max'=>'Ảnh không được vượt quá 2048 KB'
        ];
    }
}
