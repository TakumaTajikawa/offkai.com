<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Debugbar;

class UserController extends Controller
{

    public function show(string $name)
    {
        $user = User::where('name', $name)->first();

        $plans = $user->plans->sortByDesc('created_at');
        
        return view('users.show', [
            'user' => $user,
            'plans' => $plans,
        ]);
    }

    public function edit(string $name)
    {
        $user = User::where('name', $name)->first();

        // UserPolicyのupdateメソッドでアクセス制限
        $this->authorize('update', $user);
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    public function update(UserRequest $request, string $name)
    {
        $user = User::where('name', $name)->first();
        if ($image = $request->file('profile_img')) {
            $path = Storage::disk('s3')->putFile('profileimage', $image, 'public');
            $user->profile_img = Storage::disk('s3')->url($path);
        }
        // UserPolicyのupdateメソッドでアクセス制限
        $this->authorize('update', $user);
        $user->fill($request->all())->save();
        session()->flash('msg_success', 'アカウント情報を編集しました');
        return redirect()->route('users.show', ['name' => $user->name,]);
    }

    public function interests(string $name)
    {
        $user = User::where('name', $name)->first();

        $plans = $user->interests->sortByDesc('created_at');

        return view('users.interests', [
            'user' => $user,
            'plans' => $plans,
        ]);
    }

    public function followings(string $name)
    {
        $user = User::where('name', $name)->first();

        $followings = $user->followings->sortByDesc('created_at');

        return view('users.followings', [
            'user' => $user,
            'followings' => $followings,
        ]);
    }
    
    public function followers(string $name)
    {
        $user = User::where('name', $name)->first();

        $followers = $user->followers->sortByDesc('created_at');

        return view('users.followers', [
            'user' => $user,
            'followers' => $followers,
        ]);
    }

    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);
        return ['name' => $name];
    }
    
    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }
        $request->user()->followings()->detach($user);
        return ['name' => $name];
    }
}
