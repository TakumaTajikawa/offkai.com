<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Comment $comment)
    {
        $user = auth()->user();
        $comment->fill($request->all());
        $comment->user_id = $user->id;
        $comment->save();
        session()->flash('msg_success', 'コメントを投稿しました');

        return back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        session()->flash('msg_success', 'コメントを削除しました');
        return redirect()->route('plans.show', ['plan' => $comment->plan_id]);
    }
    
}
