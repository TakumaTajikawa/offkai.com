<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Comment $comment)
    {
        // 二重送信対策
        $request->session()->regenerateToken();

        $user = auth()->user();
        $comment->fill($request->all());
        $comment->user_id = $user->id;
        $comment->save();


        return redirect()->route('plans.show', ['plan' => $plan]);
    }
}
