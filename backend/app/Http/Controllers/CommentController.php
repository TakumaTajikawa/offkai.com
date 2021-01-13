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

        return back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('plans.show', ['plan' => $comment->plan_id]);
    }
    
}
