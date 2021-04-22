<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use app\Model\LandingPage;
class StoreLandingPost extends FormRequest
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
            'name'=>'required|unique:landingpage,name',
            'content'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Tên tin tức không được để trống',
            'name.unique'=>'Tin tức này đã tồn tại',
            'content.required'=>'Vui lòng nhập chi tiết trang web',
        ];
    }
}
