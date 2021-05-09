<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Model\Comment;
use Illuminate\Http\Request;

class CommentManagerController extends Controller
{
    public function view()
    {
        $data_comment = Comment::orderBy('created_at')->with('product','customer')->get();
        return view('superAdmin.comment.list', compact('data_comment'));
    }

    public function change($id)
    {
        $data_comment = Comment::where('id', $id)->first();
        if($data_comment->status = 1){
            $data_comment->status = 0;
            $data_comment->save();
            return redirect('manager/comment/view-comment');
        } else {
            $data_comment->status = 1;
            $data_comment->save();
            return redirect('manager/comment/view-comment');
        }
    }
}
