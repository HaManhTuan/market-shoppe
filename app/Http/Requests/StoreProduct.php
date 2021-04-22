<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use app\Model\Product;
class StoreProduct extends FormRequest
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
            'name'=>'required|unique:product,name',
            'category_id'=>'required',
            'stock'=>'required|min:1',
            'price'=>'required',
            'description'=>'required',
            'content'=>'required',
            'file'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Tên sản phẩm không được để trống',
            'name.unique'=>'Sản phẩm này đã tồn tại',
            'category_id.required'=>'Vui lòng chọn danh mục',
            'stock.required'=>'Vui lòng nhập số lượng',
            'stock.min'=>'Số lượng phải lớn hơn 0',
            'price.required'=>'Vui lòng nhập giá',
            'description.required'=>'Vui lòng nhập mô tả sản phẩm',
            'content.required'=>'Vui lòng nhập chi tiết sản phẩm',
            'file.required'=>'Vui lòng chọn ảnh đại diện',
            'file.image'=>'File này không phải là ảnh',
            'file.max'=>'Ảnh không được vượt quá 2048 KB'
            
        ];
    }
}
