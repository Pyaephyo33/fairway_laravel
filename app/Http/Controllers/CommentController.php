<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            'article_id' => 'required',
            'content' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
            // return back()->withErrors("Please fill the comment");
        }

        $comment = new Comment;
        $comment->content = request()->content;
        $comment->article_id = request()->article_id;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return back()->with('add', 'A Comment Added');
    }

    public function delete($id)
    {
        $comment = Comment::find($id);

        if(Gate::allows("comment-delete", $comment)){
            $comment->delete();
            return back()->with('del', 'A Comment Deleted');
        }

        return back()->with('del', 'Unauthorize to Deleted');
    }
}
