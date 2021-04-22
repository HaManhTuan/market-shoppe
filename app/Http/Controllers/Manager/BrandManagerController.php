<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Model\Brand;
use Illuminate\Http\Request;

class BrandManagerController extends Controller
{
    public function index()
    {
        $brand = Brand::get();
        return view('superAdmin.brand.list')->with(['brand' => $brand]);
    }
    public function addView()
    {
        return view('superAdmin.brand.add');
    }

    public function add(BrandRequest $req)
    {
        $data = [
            'name' => $req->name,
            'icon' => ''
        ];
        $brand = Brand::create($data);
        if($brand) {
            return redirect('manager/them-thuong-hieu')->with('flash_success','Thêm thương hiệu thành công');
        } else {
            return redirect('manager/them-thuong-hieu')->with('flash_error','Lỗi ! Vui lòng thử lại');
        }
        //return view('superAdmin.brand.add');
    }

    public function delete(Request $req){
        $id         = $req->id;
		if (Brand::destroy($id)) {
			$msg = [
				'status' => '_success',
				'msg'    => 'Xóa thành công.'
			];
			return response()->json($msg);
		} else {
			$msg = [
				'status' => '_error',
				'msg'    => 'Error.'
			];
			return response()->json($msg);
		}
    }
}
