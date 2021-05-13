<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Comment;
use Auth;

class CommentController extends Controller
{
    public function view()
    {
        $data_comment = Comment::whereHas('product.user', function($q){
            $q->where('author_id', Auth::id());
        })->orderBy('created_at')->with('product','customer')->get();
        return view('backend.comment.list', compact('data_comment'));
    }

    public function changeStatus($id)
    {
        $data_comment = Comment::where('id', $id)->first();
        if($data_comment->status == 1){
            $data_comment->status = 0;
            $data_comment->save();
            return redirect('admin/comment/view');
        }
        if($data_comment->status == 0){
            $data_comment->status = 1;
            $data_comment->save();
            return redirect('admin/comment/view');
        }
    }
}
