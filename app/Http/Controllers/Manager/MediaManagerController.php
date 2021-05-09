<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MediaManagerController extends Controller
{
    public function view(){
		$dataMedia = Media::find(1);
        if($dataMedia == null) {
           Media::create([
                'super_admin' => Auth::guard('admins')->user()->id,
                'image_1' => null,
                'image_2' => null,
                'image_3' => null,
            ]);
        }
        $dataMedia = Media::find(1);
		$data_send = [
			'media' => $dataMedia
		];
        return view('superAdmin.media.list')->with($data_send);
    }
    public function add(Request $req){
        if ($req->isMethod('post')) {
			$media       = new Media();
			// $media->name = $req->name;
			$target_save = "uploads/images/media/";
			if ($req->hasFile('image_1')) {
				$file  = $req->file('image_1');
				$name  = $file->getClientOriginalName();
				$image = Str::random(4)."_".$name;
				while (file_exists("uploads/images/media/".$image)) {
					$image = Str::random(4)."_".$name;
				}
				$file->move("uploads/images/media", $image);
				$req->image_1 = $image;
			} else {
                if($req->image_1_old) {
                    $req->image_1 = $req->image_1_old;
                } else {
                    $req->image_1 = "";
                }
			}


            if ($req->hasFile('image_2')) {
				$file  = $req->file('image_2');
				$name  = $file->getClientOriginalName();
				$image = Str::random(4)."_".$name;
				while (file_exists("uploads/images/media/".$image)) {
					$image = Str::random(4)."_".$name;
				}
				$file->move("uploads/images/media", $image);
				$req->image_2 = $image;
			} else {
                if($req->image_2_old) {
                    $req->image_2 = $req->image_2_old;
                } else {
                    $req->image_2 = "";
                }
			}

            if ($req->hasFile('image_3')) {
				$file  = $req->file('image_3');
				$name  = $file->getClientOriginalName();
				$image = Str::random(4)."_".$name;
				while (file_exists("uploads/images/media/".$image)) {
					$image = Str::random(4)."_".$name;
				}
				$file->move("uploads/images/media", $image);
				$req->image_3 = $image;
			} else {
                if($req->image_3_old) {
                    $req->image_3 = $req->image_3_old;
                } else {
                    $req->image_3 = "";
                }
			}

            $update = Media::updateOrCreate(
                ['super_admin' => Auth::guard('admins')->user()->id],
                [
                    'image_1' => $req->image_1,
                    'image_2' => $req->image_2,
                    'image_3' => $req->image_3,
                ]
                );
			if ($update) {
			    return redirect('manager/media/view-media')->with(['flash_message_success' => 'Thay đổi thành công']);
			} else {
				return redirect('manager/media/view-media')->with(['flash_message_error' => 'Lỗi. Vui lòng thử lại sau']);
			}
		}
	}

}
