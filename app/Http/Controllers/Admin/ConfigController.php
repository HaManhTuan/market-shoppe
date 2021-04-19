<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Config;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
class ConfigController extends Controller
{
    public function view(){
    	$config = Config::find(1);
    	return view('backend.config.list',compact('config'));
    }
    public function edit(Request $req)
    {   
        if (! Gate::allows('edit_config')) {
            return view('backend.errors.401');
        }
        $request = $req->all();
		if ($req->hasFile('logo')) {
		$file  = $req->file('logo');
		$name  = $file->getClientOriginalName();
		$image = Str::random(4)."_".$name;
		while (file_exists("public/uploads/images/config/".$image)) {
		$image = Str::random(4)."_".$name;
		}
		$file->move("public/uploads/images/config", $image);
		$request['logo'] = $image;
        if(file_exists($req->logo_old)){
            unlink("public/uploads/images/config/".$req->logo_old);
        }
		} else {
		$request['logo'] = $req->logo_old;
		}
	    if ($req->hasFile('icon')) {
		$file  = $req->file('icon');
		$name  = $file->getClientOriginalName();
		$image = Str::random(4)."_".$name;
		while (file_exists("public/uploads/images/config/".$image)) {
		$image = Str::random(4)."_".$name;
		}
		$file->move("public/uploads/images/config", $image);
        $request['icon'] = $image;
        if(file_exists($req->icon_old)){
            unlink("public/uploads/images/config/".$req->icon_old);
        }
		} else {
		$request['icon'] = $req->icon_old;
		}
    	$config = Config::find(1);
    	$config->logo = $request['logo'];
    	$config->icon = $request['icon'];
    	$config->email = $request['email'];
    	$config->address = $request['address'];
    	$config->phone = $request['phone'];
    	$config->title = $request['title'];
    	$config->description = $request['description'];
    	$query = $config->save();
    	if ($query) {
    		return redirect('admin/config/view-config')->with('flash_message_success', 'Sửa thành công');
    	}
    	else {
    		return redirect('admin/config/view-config')->with('flash_message_error', 'Có lỗi xảy ra. Vui lòng thử lại');
    	}
    }
}
