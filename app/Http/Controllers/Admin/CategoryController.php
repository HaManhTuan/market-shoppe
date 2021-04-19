<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
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
    public function show()
    {
        if (! Gate::allows('add_category') || ! Gate::allows('edit_category') || ! Gate::allows('delete_category')) {
            return view('backend.errors.401');
        }
        $dataCate = Category::with('categories')->orderBy('parent_id', 'asc')
            ->get();
        $data_select = $this->getDataSelect(0);
        return view('backend.category.list', compact('dataCate', 'data_select'));
    }
    public function add(Request $req)
    {
		if (! Gate::allows('add_category')) {
            return view('backend.errors.401');
        }
        $check_name = Category::where('name', $req->title)
            ->count();
        if ($check_name > 0)
        {
            $msg = ['status' => '_error', 'msg' => 'Error. This name already exists'];
            return response()->json($msg);
        }
        else
        {
            //print_r($req->all());
            $category = new Category();
            $category->name = $req->title;
            $slug = Str::slug($req->title, '-');
            $category->url = $slug;
            $category->parent_id = $req->parent_id;
            $category->description = $req->description;
           
            if ($req->hasFile('file')) {
                $file  = $req->file('file');
                $name  = $file->getClientOriginalName();
                $image = Str::random(4)."_".$name;
                while (file_exists("public/uploads/images/category/".$image)) {
                    $image = Str::random(4)."_".$name;
                }
                $file->move("public/uploads/images/category", $image);
                $category->icon = $image;
            } else {
                $category->icon = "";
            }
            $category->status = $req->input('status') ? '1' : '0';
            $query = $category->save();
            if (!$query || $query == false)
            {
                $msg = ['status' => '_error', 'msg' => 'Error !!!'];
                return response()->json($msg);
            }
            else
            {
                $msg = ['status' => '_success', 'msg' => 'Thêm danh mục thành công !'];
                return response()->json($msg);
            }

        }

    }
    public function showmodal(Request $req)
    {
        $id = $req->id;
        $data_select = $this->getDataSelect(0, '', $id);
        $category_data = Category::where('id', $id)->first();
        $data = '
            <div class="form-group">
               <input type="hidden" name="edit_id" value="' . $category_data->id . '">
                <label class="control-label">Select parent category <font color="#a94442">(*)</font></label>
                <select class="form-control custom-select" name="parent_id" id="parent_id" data-rule-required="true" data-msg-required="Vui lòng chọn danh mục cha.">
                    <option value="" disabled="disabled">--- Select ---</option>
                    <option value="0">Không có</option>
                    ' . $data_select . '
                </select>
            </div>
            <div class="form-group mb-3">
				<label for="title" class="control-label">Title <font color="#a94442">(*)</font></label>
				<input type="text" class="form-control" id="title" name="title" value="' . $category_data->name . '" />
			</div>';
        $data .= '
        <input type="hidden" name="old_file"  class="form-control" value="'.$category_data->icon.'">
        
            <div class="form-group">
                <label class="control-label">Description</label>';
        $data .= '<textarea rows="2" cols="2" name="description" class="form-control">' . $category_data->description . '</textarea></div>';
        $data .= '
        <div class="form-group">
        <label class="control-label">Icon</label>
        <input type="file" id="input-file-now" class="dropify form-control" name="file" data-default-file="'.asset('public/uploads/images/category/').'/'.''.$category_data->icon.'">
    </div><script>
    $(".dropify").dropify();
</script>';

        if ($category_data->status == 1)
        {
            $data .= '<label class="custom-control custom-checkbox">
					<input type="checkbox" checked="" class="custom-control-input" value="1" name="status">
					<span class="custom-control-label">Active</span>
				</label>
			        ';
        }
        else
        {
            $data .= ' <label class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" value="1" name="status">
					<span class="custom-control-label">Active</span>
				</label>
			        ';
        }

        $msg = array(
            'status_data' => $category_data->status,
            'status_cate' => $category_data->status_cate,
            'parent_id_data' => $category_data->parent_id,
            'category_name' => $category_data->name,
            'category_id' => $category_data->id,
            'body' => $data,
        );

        return json_encode($msg);
	}
	public function edit(Request $req){
		$data = $req->all();
		$id                    = $req->edit_id;
		$category              = Category::where('id', $id)->first();
		$category->name        = $req->title;
		$slug = Str::slug($req->title, '-');
		$category->url         = $slug;
		$category->parent_id   = $req->parent_id;
        $category->description = $req->description;
		if (empty($req->status)) {
			$category->status = '0';
		} else {
			$category->status = '1';
        }

        if ($req->hasFile('file')) {
            $file  = $req->file('file');
            $name  = $file->getClientOriginalName();
            $image = Str::random(4)."_".$name;
            while (file_exists("public/uploads/images/category/".$image)) {
                $image = Str::random(4)."_".$name;
            }
            $file->move("public/uploads/images/category", $image);
            $category->icon= $image;
            if (isset($req->old_file) && $req->old_file != '') {
                unlink("public/uploads/images/category/".$req->old_file);
            }

        } else {
            $category->icon = $req->old_file;
        }

		if ($category->save()) {
			$msg = array(
				'status' => '_success',
				'msg'    => 'Sửa danh mục thành công !.',
			);
			return json_encode($msg);
		} else {
			$msg = array(
				'status' => '_error',
				'msg'    => 'Error.',
			);
			return json_encode($msg);
		}
	}
	public function delete(Request $req){
		$id         = $req->id;
		$length     = $req->length;
		//print_r($id);
		$id_array   = explode(",", $id);
		$img_del_qr = Category::whereIn('id', $id_array)->get();
		if (Category::destroy($id_array)) {
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

