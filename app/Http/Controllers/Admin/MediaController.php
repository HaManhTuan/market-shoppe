<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Model\Media;
use Illuminate\Support\Facades\Gate;
class MediaController extends Controller
{
    public function view(){
		if (! Gate::allows('add_media') || ! Gate::allows('edit_media') || ! Gate::allows('delete_media')) {
            return view('backend.errors.401');
        }
		$dataMePos1 = Media::where('position',1)->get();
		$dataMePos2 = Media::where('position',2)->get();
		$data_send = [
			'dataMePos1' => $dataMePos1,
			'dataMePos2' => $dataMePos2
		];
        return view('backend.media.list')->with($data_send);
    }
    public function add(Request $req){
		if (! Gate::allows('add_media')) {
            return view('backend.errors.401');
        }
        if ($req->isMethod('post')) {
			$media       = new Media();
			// $media->name = $req->name;
			$target_save = "public/uploads/images/media/";
			if ($req->hasFile('image')) {
				$file  = $req->file('image');
				$name  = $file->getClientOriginalName();
				$image = Str::random(4)."_".$name;
				while (file_exists("public/uploads/images/media/".$image)) {
					$image = Str::random(4)."_".$name;
				}
				$file->move("public/uploads/images/media", $image);
				$req->image = $image;
			} else {
				$req->image = "";
			}
			$media->image  = $req->image;
			$media->position     = $req->position;
			if ($media->save()) {
				$msg = array(
					'status' => '_success',
					'msg'    => 'Một slide đã được thêm',
				);
				return json_encode($msg);
			} else {
				$msg = array(
					'status' => '_error',
					'msg'    => 'Có lỗi xảy ra. Vui lòng thử lại',
				);
				return json_encode($msg);
			}
		}
		return view('backend.media.add');
	}
	public function editModal(Request $req) {
		$id         = $req->id;
		$media_edit = Media::find($id);
		$data       = '<input type="hidden" name="edit_id" value="'.$media_edit->id.'">
      <div class="form-group">
      <label for="category_name_input" class="control-label">Ảnh<font color="#a94442">(*)</font></label>
      <input type="file" id="input-file-now" name="image" class="dropify" data-rule-required="true" 
      data-default-file="'.asset('public/uploads/images/media/').'/'.''.$media_edit->image.'" >
      <input type="hidden" name="old_file" value="'.$media_edit->image.'" />
      </div>
      <div class="form-group">
	  	<label id="position-label" for="position" class="control-label col-sm-2">Vị trí</label>
	  	<select name="position" id="position" class="form-control">
			<option value="" selected disabled>--Chọn--</option>
			<option value="1">Vị trí 1</option>
			<option value="2">Vị trí 2</option>
		</select>
      </div>';
		$msg = array(
			'position' => $media_edit->position,
			'body' => $data,
		);

		return json_encode($msg);
	}
	public function edit(Request $req) {
		$id          = $req->edit_id;
		$media       = Media::where('id', $id)->first();
		$old_file    = $req->old_file;
		$target_save = "public/uploads/images/media/";
		if ($req->hasFile('image')) {
			$file  = $req->file('image');
			$name  = $file->getClientOriginalName();
			$image = Str::random(4)."_".$name;
			while (file_exists("public/uploads/images/media/".$image)) {
				$image = Str::random(4)."_".$name;
			}
			$file->move("public/uploads/images/media", $image);
			$req->image = $image;
			if (trim($old_file) != "" && file_exists("public/uploads/images/media/".$old_file)) {
				unlink("public/uploads/images/media/".$old_file);
			}
		} else {
			$req->image = $old_file;
		}
		//print_r($id);
		$media->image  = $req->image;
		$media->position     = $req->position;
		if ($media->save()) {
			$msg = array(
				'status' => '_success',
				'msg'    => 'Cập nhật thành công',
			);
			return json_encode($msg);
		} else {
			$msg = array(
				'status' => '_error',
				'msg'    => 'Có lỗi xảy ra. Vui lòng thử lại',
			);
			return json_encode($msg);
		}
	}
	public function delete(Request $req) {
		$id         = $req->id;
		$length     = $req->length;
		$media_data = Media::where(['id' => $id])->get();
		foreach ($media_data as $row) {
			$image_del = $row->image;
			unlink("public/uploads/images/media/".$image_del);

		}
		if (Media::destroy($id)) {

			$msg = array(
				'status' => '_success',
				'msg'    => $length.' mục đã được xóa',
			);
			return json_encode($msg);
		} else {
			$msg = array(
				'status' => '_error',
				'msg'    => 'Có lỗi xảy ra. Vui lòng thử lại',
			);
			return json_encode($msg);
		}
	}
}
