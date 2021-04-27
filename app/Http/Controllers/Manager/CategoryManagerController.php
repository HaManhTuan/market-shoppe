<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use App\Model\Category;
use App\User;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Boolean;

class CategoryManagerController extends Controller
{
     // Đệ quy tuyến tính menu đa cấp dạng droplist
     public function getDataSelect($parent_id = 0, $char = '', $current_id = '')
     {
         $category_data = Category::orderBy('id', 'asc')->get();
         $data_select = "";
         foreach ($category_data as $category_item)
         {
             if ($category_item['parent_id'] == $parent_id)
             {
                 if ($current_id != "")
                 {
                     if ($category_item['id'] == $current_id || $category_item['parent_id'] == $current_id)
                     {
                         $selected = "selected='selected'";
                     }
                     else
                     {
                         $selected = "";
                     }
                 }
                 else
                 {
                     $selected = "";
                 }
                 $data_select .= '<option value="' . $category_item['id'] . '" ' . $selected . '>';
                 $data_select .= $char . $category_item['name'];
                 $data_select .= '</option>';
                 // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                 $data_select .= $this->getDataSelect($category_item['id'], $char . "|---", $current_id);
             }
         }
         return $data_select;
     }

    public function index(){
        $data_select = $this->getDataSelect(0);
        $select_cate =  Category::where('parent_id', 0)->where('draff', 0)->with('categories')->get();
        $cate = Category::with('categories')->where('draff', 0)->get();
        return view('superAdmin.category.list')->with(['cate' => $cate,'data_select' => $data_select,'select_cate' => $select_cate]);
    }
    public function add(CategoryRequest $request){
        if ($request->hasFile('file')) {
            $file  = $request->file('file');
            $name  = $file->getClientOriginalName();
            $image = Str::random(4)."_".$name;
            while (file_exists("uploads/images/category/".$image)) {
                $image = Str::random(4)."_".$name;
            }
            $file->move("uploads/images/category", $image);
        } else {
            $image = "";
        }
        $data = [
            'name' => $request->name,
            'url' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
            'description' => $request->description,
            'status' => $request->status ? 1 : 0,
            'status_cus' => $request->status_cus ? 1 : 0,
            'draff' => 0,
            'icon' => $image,
        ];

        try {
            $cate = Category::create($data);
            if($cate){
                return redirect('manager/danh-muc')->with('flash_success', 'Thêm danh mục thành công');
            } else {
                return redirect('manager/danh-muc')->with('flash_error', 'Lỗi. Vui lòng thử lại sau');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function editCateModal($id) {
        $data = Category::find($id);
        $select_cate =  Category::where('parent_id', 0)->where('draff', 0)->with('categories')->get();
        $data_select = $this->getDataSelect(0, '', $id);
        return view('superAdmin.category.edit')->with(['data' => $data,'data_select' => $data_select,'select_cate' => $select_cate]);
    }

    public function edit(UpdateCategoryRequest $request) {
        if ($request->hasFile('file')) {
            $file  = $request->file('file');
            $name  = $file->getClientOriginalName();
            $image = Str::random(4)."_".$name;
            while (file_exists("uploads/images/category/".$image)) {
                $image = Str::random(4)."_".$name;
            }
            if (isset($request->old_file) && $request->old_file != '') {
                unlink("uploads/images/category/".$request->old_file);
            }

        } else {
            $image = $request->icon_old;
        }
        $data = [
            'name' => $request->name,
            'url' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
            'description' => $request->description,
            'status' => $request->status ? 1 : 0,
            'status_cus' => $request->status_cus ? 1 : 0,
            'draff' => 0,
            'icon' => $image,
        ];
        try {
            if($file->move("uploads/images/category", $image)) {
                $cate = Category::where('id',$request->id)->update($data);
                if($cate){
                    return redirect('manager/danh-muc')->with('flash_success', 'Sửa danh mục thành công');
                } else {
                    return redirect('manager/danh-muc')->with('flash_error', 'Lỗi. Vui lòng thử lại sau');
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function delete(Request $req) {
        $id         = $req->id;
		if (Category::destroy($id)) {
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

    public function updateStatus(Request $req) {
        $id         = $req->id;
        $status_web = $req->status_web === 'true' ? 1 : 0;
		if (Category::where('id',$id)->update(['status' => $status_web])) {
			$msg = [
				'status' => '_success',
				'msg'    => 'Thay đổi thành công.'
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

    public function updateStatusCus(Request $req) {
        $id         = $req->id;
        $status_cus = $req->status_cus === 'true' ? 1 : 0;
		if (Category::where('id',$id)->update(['status_cus' => $status_cus])) {
			$msg = [
				'status' => '_success',
				'msg'    => 'Thay đổi thành công.'
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

    public function draff()
    {
        $cate = Category::with('categories')->where('draff', 1)->get();
        return view('superAdmin.category.list_draff')->with(['cate' => $cate]);
    }

    public function draffInfo($id)
    {
        $cate = Category::with('categories')->where('draff', 1)->where('id', $id)->first();
        $user = User::find($cate->user_id);
        if($user) {
            return view('superAdmin.category.draff_infor')->with(['cate' => $cate,'user' => $user]);
        } else {
            return redirect('manager/danh-muc');
        }

    }

    public function draffInfoConfirm(Request $req)
    {
        $cate = Category::where('id',$req->id)->update(['draff' => 0,'status' => 0,'status_cus' => 0]);
        if ($cate) {
			$msg = [
				'status' => '_success',
				'msg'    => 'Thay đổi thành công.'
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

    public function draffInfoCancell(Request $req)
    {
        $cate = Category::where('id',$req->id)->where('draff', 1)->delete();
        if ($cate) {
			$msg = [
				'status' => '_success',
				'msg'    => 'Hủy thành công.'
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

