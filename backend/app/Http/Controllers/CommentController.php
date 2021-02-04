<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;

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
        $plan_id = $comment->plan_id;
        $plan = Plan::where('id', $plan_id)->first();

        if (Auth::id() === $comment->user_id || Auth::id() === $plan->user_id) {
            $comment->delete();
        }

        session()->flash('msg_success', 'コメントを削除しました');
        return redirect()->route('plans.show', ['plan' => $comment->plan_id]);
    }
    
}
