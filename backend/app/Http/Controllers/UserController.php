<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;

use Illuminate\Http\Request;

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

        // UserPolicyのupdateメソッドでアクセス制限
        $this->authorize('update', $user);

        $user->fill($request->all())->save();
        
        if ($file = $request->image) {
            $fileName = time() . $file->getClientOriginalName();
            $target_path = public_path('uploads/');
            $file->move($target_path, $fileName);
        } else {
            $fileName = "";
        }

        return redirect()->route('users.show', ['name' => $user->name]);
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
}
