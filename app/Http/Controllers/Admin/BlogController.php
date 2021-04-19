<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use App\Http\Requests\StoreBlogPost;
use Auth;
use App\Model\Blog;

class BlogController extends Controller
{
  public function viewblog(){
     if (!Gate::allows('add_blog') || !Gate::allows('edit_blog') || !Gate::allows('delete_blog'))
        {
            return view('backend.errors.401');
        }
      $dataBlog = Blog::orderBy('created_at','asc')->get();
    return view('backend.blog.list', compact('dataBlog',$dataBlog));
  }
  public function add(){
    if (!Gate::allows('add_blog'))
    {
        return view('backend.errors.401');
    }
    return view('backend.blog.add');
  }
      public function addblog(StoreBlogPost $req)
    {
        if (!Gate::allows('add_blog'))
        {
            return view('backend.errors.401');
        }
        $validated = $req->validated();
        $request = $req->all();
        //print_r($request);
        $request['name'] = $req->name;
        $request['description'] = $req->description;
        $request['content'] = $req->content;
        $request['author_id'] = Auth::id();
        $request['status'] = $req->has('status') ? '1' : '0';
        $target_save = "public/uploads/images/blog/";

        if ($req->hasFile('file'))
        {
            $file = $req->file('file');
            $name = $file->getClientOriginalName();
            $image = Str::random(4) . "_" . $name;
            while (file_exists("public/uploads/images/blog/" . $image))
            {
                $image = Str::random(4) . "_" . $name;
            }
            $file->move("public/uploads/images/blog", $image);
            $request['image'] = $image;
        }
        else
        {
            $request['image'] = "";
        }

        //$query = Product::create($request);
        if (Blog::create($request))
        {
            return redirect('admin/blog/view-blog')->with('flash_message_success', 'Bạn đã thêm mới 1 tin tức');
        }
        else
        {
            return redirect('admin/blog/view-blog')
                ->with('flash_message_error', 'Có lỗi xảy ra vui lòng thử lại');
        }
    }
    public function editblog(Request $req, $id){
    
      if (!Gate::allows('edit_blog'))
        {
            return view('backend.errors.401');
        }
       $dataBlog = Blog::where('id',$id)->first();
       if ($req->isMethod('post'))
        {
            $request = $req->all();
            $request['name'] = $req->name;
            $request['description'] = $req->description;
            $request['content'] = $req->content;
            $request['status'] = $req->has('status') ? '1' : '0';
            $target_save = "public/uploads/images/blog/";
            if ($req->hasFile('file'))
            {
                $file = $req->file('file');
                $name = $file->getClientOriginalName();
                $image = Str::random(4) . "_" . $name;
                while (file_exists("public/uploads/images/blog/" . $image))
                {
                    $image = Str::random(4) . "_" . $name;
                }
                $file->move("public/uploads/images/blog", $image);
                $request['image'] = $image;
                if (file_exists($req->old_file) && $req->old_file != '')
                {
                    unlink("public/uploads/images/blog/" . $req->old_file);
                }

            }
            else
            {
                $request['image'] = $req->old_file;
            }
            $request['author_id'] = Auth::id();
            if ($dataBlog->update($request))
            {
                return redirect('admin/blog/view-blog')->with('flash_message_success', 'Bạn đã sửa tin tức thành công');
            }
            else
            {
                return redirect('admin/blog/view-blog')
                    ->with('flash_message_error', 'Có lỗi xảy ra vui lòng thử lại');
            }
        }
      return view('backend.blog.edit', compact('dataBlog', $dataBlog));
    }
    public function delblog(Request $req){
       $id = $req->id;
       $avatar = Blog::where(['id' => $id])->first();
        if ($avatar->image != "")
        {
            if (file_exists('public/uploads/images/blog/' . $avatar->image))
            {
                unlink('public/uploads/images/blog/' . $avatar->image);
            }
        }
       if (Blog::destroy($id))
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
