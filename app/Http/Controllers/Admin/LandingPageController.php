<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\LandingPage;
use Illuminate\Support\Str;
use App\Http\Requests\StoreLandingPost;
use Illuminate\Support\Facades\Gate;

class LandingPageController extends Controller
{
  public function view()
  {
     if (!Gate::allows('add_landing') || !Gate::allows('edit_landing') || !Gate::allows('delete_landing'))
        {
            return view('backend.errors.401');
        }
    $dataLanding = LandingPage::orderBy('id','DESC')->get();
    return view('backend.landing.list', compact('dataLanding', $dataLanding));
  }
  public function add()
  {
    if (!Gate::allows('add_landing'))
    {
        return view('backend.errors.401');
    }
    return view('backend.landing.add');
  }
  public function addlanding(StoreLandingPost $req){
      if (!Gate::allows('add_landing'))
        {
            return view('backend.errors.401');
        }
      $validated = $req->validated();
      $landing = new LandingPage();
      $landing->name = $req->name;
      $slug = Str::slug($req->name, '-');
      $landing->url = $slug;
      $landing->content = $req->content;
      $landing->status = $req->has('status') ? '1' : '0';
      $query = $landing->save();
      if ($query) {
        return view('backend.landing.list')->with('flash_message_success','Bạn đã thêm mới một trang web');
      }
      else{
       return view('backend.landing.list')->with(['flash_message_error', 'Có lỗi. Vui lòng thử lại sau']);
      }
  }
  public function editlanding(Request $req, $id)
  {
     if (!Gate::allows('edit_landing'))
        {
            return view('backend.errors.401');
        }
        $dataLanding = LandingPage::where('id',$id)->first();
       if ($req->isMethod('post'))
        {
            $request = $req->all();
            $request['name'] = $req->name;
            $slug = Str::slug($req->name, '-');
            $request['url'] = $slug;
            $request['content'] = $req->content;
            $request['status'] = $req->has('status') ? '1' : '0';

            if ($dataLanding->update($request))
            {
                return redirect('admin/landingpage/view')->with('flash_message_success', 'Bạn đã sửa trang web thành công');
            }
            else
            {
                return redirect('admin/landingpage/view')
                    ->with('flash_message_error', 'Có lỗi xảy ra vui lòng thử lại');
            }
        }
      return view('backend.landing.edit', compact('dataLanding', $dataLanding));
  }
}
