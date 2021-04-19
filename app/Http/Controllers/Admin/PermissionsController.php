<?php

namespace App\Http\Controllers\Admin;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class PermissionsController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('backend.permissions.index', compact('permissions'));
    }
    public function add(){
        if (! Gate::allows('add_user')) {
            return view('backend.errors.401');
        }
        return view('backend.permissions.add');
    }
    public function postadd(Request $req){
        Permission::create($req->all());
        return redirect('admin/user/permissions')->with('flash_message_success','Add successfully !');
    }
    public function edit($id){
        if (! Gate::allows('edit_user')) {
            return view('backend.errors.401');
        }
        $permission_detail = Permission::find($id);
        return view('backend.permissions.edit', compact('permission_detail'));
    }
    public function postedit(Request $req){
        $permission_detail = Permission::find($req->id);
        $permission_detail->name = $req->name;
        $permission_detail->save();
        return redirect('admin/user/permissions')->with('flash_message_success','Edit successfully !');
    }
    public function delete(Request $req){

        if (Permission::destroy($req->id)) {
			$msg = array(
				'status' => '_success',
				'msg'    => 'An item has been deleted',
			);
			return json_encode($msg);
		} else {
			$msg = array(
				'status' => '_error',
				'msg'    => 'An error occurred. Please try again',
			);
			return json_encode($msg);
		}
    }
}
