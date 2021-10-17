<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdatePasswordRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

use Debugbar;

class UserController extends Controller
{

    public function show(string $name)
    {   
        $name = decrypt($name);
        $user = User::where('name', $name)->first();

        $plans = $user->plans->sortByDesc('created_at');

        $book = collect(['id' => 1, 'title' => 'キングダム', 'author' => '原泰久']);

        $enc_book = encrypt($book);

        $dec_book = decrypt($enc_book);

        
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
        $user->fill($request->validated())->save();
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

    public function editPassword(){
        return view('users.user_password_edit');
    }

    public function updatePassword(UpdatePasswordRequest $request){
        $user = \Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        session()->flash('msg_success', 'パスワードを変更しました');
        return redirect()->route('users.show', ['name' => $user->name,]);
    }
}
