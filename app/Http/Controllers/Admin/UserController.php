<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;
use Spatie\Permission\Models\Role;
class UserController extends Controller
{
    public function index(){
        $dataUser = User::all();
        $roles = Role::get()->pluck('name', 'name');
        $data_send = ['dataUser' => $dataUser,
        'roles' => $roles ];
        return view('backend.user.list', compact('dataUser','roles'));

    }
    public function add(){
        if (! Gate::allows('add_user')) {
            return view('backend.errors.401');
        }
        $roles = Role::get()->pluck('name', 'name');
        return view('backend.user.add', compact('roles'));
    }
    public function postadd(Request $req){
        $count_email = User::where('email',$req->email)->count();
        if ($count_email > 0) {
            return redirect('admin/user/add')->with('flash_message_error','This email already exists
            ');
        }
        else{
            $user = new User();
            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            $user->phone = $req->phone;
            $user->admin = $req->input('admin') ? '1' : '0';
            $roles = $req->input('roles') ? $req->input('roles') : [];
            $user->save();
            $user->assignRole($roles);
            // $user->givePermissionTo();
            return redirect('admin/user/view')->with('flash_message_success','Add successfully !');
        }
    }
    public function edit($id){
        // if (! Gate::allows('edit_user')) {
        //     return view('backend.errors.401');
        // }
        $dataUserId = User::find($id);
        $roles = Role::get()->pluck('name', 'name');
        return view('backend.user.edit', compact('dataUserId','roles'));
    }
    public function postedit(Request $req){
        $user = User::find($req->user_id);
        $user->name = $req->name;
        $user->phone = $req->phone;
        if(isset($req->password) && $req->password !=""){
            $user->password = Hash::make($req->password);
        }
        $user->admin = $req->input('admin') ? '1' : '0';
        $user->save();
        $roles = $req->input('roles') ? $req->input('roles') : [];
        $user->syncRoles($roles);
        return redirect('admin/user/view')->with('flash_message_success','Edit successfully !');
    }
    public function profile(){
        $idUser = auth()->user()->id;
        $dataUser = User::find($idUser);
        return view('backend.user.profile', compact('dataUser'));
    }
    public function postprofile(Request $req){
        $query      = User::where("id", $req->user_id)->update(['name' => $req->name,'phone' =>$req->phone, 'address' =>$req->address,'born' =>$req->born]);
        if (!$query || $query == false) {
            $msg = [
                'status' => '_error',
                'msg'    => 'Có lỗi xảy ra. Vui lòng thử lại'
            ];
            return response()->json($msg);
        } else {
            $msg = [
                'status' => '_success',
                'msg'    => 'Sửa tài khoản thành công'
            ];
            return response()->json($msg);
        }
    }
    public function changepassword(Request $req){
        $pwd        = $req->retypeNewPwd;
        $pwd_bcrypt = Hash::make($pwd);
        $id         = $req->id;
        $query      = User::where("id", $id)->update(['password' => $pwd_bcrypt]);
        if (!$query || $query == false) {
            $msg = [
                'status' => '_error',
                'msg'    => 'Có lỗi xảy ra. Vui lòng thử lại'
            ];
            return response()->json($msg);
        } else {
            Auth::logout();
            $msg = [
                'status' => '_success',
                'msg'    => 'Mật khẩu đã được thay đổi thành công'
            ];
            return response()->json($msg);
        }
    }
}
