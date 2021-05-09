<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Config;
use Illuminate\Support\Str;

class ConfigManagerController extends Controller
{
    public function view(){
    	$config = Config::find(1);
        if($config == null){
            Config::create([
                'logo' => null,
                'icon' => null,
                'email' => null,
                'address' => null,
                'phone' => null,
                'title' => null,
                'description' => null
            ]);
        }
    	return view('superAdmin.config.list',compact('config'));
    }
    public function edit(Request $req)
    {
        $request = $req->all();
		if ($req->hasFile('logo')) {
		$file  = $req->file('logo');
		$name  = $file->getClientOriginalName();
		$image = Str::random(4)."_".$name;
		while (file_exists("uploads/images/config/".$image)) {
		$image = Str::random(4)."_".$name;
		}
		$file->move("uploads/images/config", $image);
		$request['logo'] = $image;
        if(file_exists($req->logo_old)){
            unlink("uploads/images/config/".$req->logo_old);
        }
		} else {
		$request['logo'] = $req->logo_old;
		}
	    if ($req->hasFile('icon')) {
		$file  = $req->file('icon');
		$name  = $file->getClientOriginalName();
		$image = Str::random(4)."_".$name;
		while (file_exists("uploads/images/config/".$image)) {
		$image = Str::random(4)."_".$name;
		}
		$file->move("uploads/images/config", $image);
        $request['icon'] = $image;
        if(file_exists($req->icon_old)){
            unlink("uploads/images/config/".$req->icon_old);
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
    		return redirect('manager/view-config')->with('flash_message_success', 'Sửa thành công');
    	}
    	else {
    		return redirect('manager/view-config')->with('flash_message_error', 'Có lỗi xảy ra. Vui lòng thử lại');
    	}
    }
}
