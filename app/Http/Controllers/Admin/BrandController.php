<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use App\Http\Requests\StoreBrandPost;
use Auth;
use App\Model\Brand;
class BrandController extends Controller
{
    public function viewbrand(){
     if (!Gate::allows('add_brand') || !Gate::allows('edit_brand') || !Gate::allows('delete_brand'))
        {
            return view('backend.errors.401');
        }
    $dataBrand  = Brand::orderBy('created_at','asc')->get();
    return view('backend.brand.list', compact('dataBrand',$dataBrand));
  }
  public function add(){
    if (!Gate::allows('add_brand'))
    {
        return view('backend.errors.401');
    }
    return view('backend.brand.add');
  }
      public function addbrand(StoreBrandPost $req)
    {
        if (!Gate::allows('add_brand'))
        {
            return view('backend.errors.401');
        }
        $validated = $req->validated();
        $request = $req->all();
        //print_r($request);
        $request['name'] = $req->name;
        $target_save = "public/uploads/images/brand/";

        if ($req->hasFile('file'))
        {
            $file = $req->file('file');
            $name = $file->getClientOriginalName();
            $image = Str::random(4) . "_" . $name;
            while (file_exists("public/uploads/images/brand/" . $image))
            {
                $image = Str::random(4) . "_" . $name;
            }
            $file->move("public/uploads/images/brand", $image);
            $request['icon'] = $image;
        }
        else
        {
            $request['icon'] = "";
        }
        // echo "<pre>";
        // print_r($request);
        // echo "</pre>";
        // die();
        //$query = Product::create($request);
        if (Brand::create($request))
        {
            return redirect('admin/brand/view-brand')->with('flash_message_success', 'Bạn đã thêm mới 1 tin tức');
        }
        else
        {
            return redirect('admin/brand/view-brand')
                ->with('flash_message_error', 'Có lỗi xảy ra vui lòng thử lại');
        }
    }
    public function editbrand(Request $req, $id){
    
      if (!Gate::allows('edit_brand'))
        {
            return view('backend.errors.401');
        }
       $dataBrand = Brand::where('id',$id)->first();
       if ($req->isMethod('post'))
        {
            $request = $req->all();
            $request['name'] = $req->name;
            $target_save = "public/uploads/images/brand/";
            if ($req->hasFile('file'))
            {
                $file = $req->file('file');
                $name = $file->getClientOriginalName();
                $image = Str::random(4) . "_" . $name;
                while (file_exists("public/uploads/images/brand/" . $image))
                {
                    $image = Str::random(4) . "_" . $name;
                }
                $file->move("public/uploads/images/brand", $image);
                $request['icon'] = $image;
                if (file_exists($req->old_file) && $req->old_file != '')
                {
                    unlink("public/uploads/images/brand/" . $req->old_file);
                }

            }
            else
            {
                $request['icon'] = $req->old_file;
            }
          
            if ($dataBrand->update($request))
            {
                return redirect('admin/brand/view-brand')->with('flash_message_success', 'Bạn đã sửa thành công thương hiệu');
            }
            else
            {
                return redirect('admin/brand/view-brand')
                    ->with('flash_message_error', 'Có lỗi xảy ra vui lòng thử lại');
            }
        }
      return view('backend.brand.edit', compact('dataBrand', $dataBrand));
    }
    public function delbrand(Request $req){
       $id = $req->id;
       $avatar = Brand::where(['id' => $id])->first();
        if ($avatar->image != "")
        {
            if (file_exists('public/uploads/images/brand/' . $avatar->image))
            {
                unlink('public/uploads/images/brand/' . $avatar->image);
            }
        }
       if (Brand::destroy($id))
        {
            $msg = array(
                'status' => '_success',
                'msg' => 'Một mục đã được xóa',
            );
            return json_encode($msg);
        }
        else
        {
            $msg = array(
                'status' => '_error',
                'msg' => 'Có lỗi xảy ra. Vui lòng thử lại',
            );
            return json_encode($msg);
        }
    }
}
