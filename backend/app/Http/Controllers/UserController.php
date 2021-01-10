<?php

namespace App\Http\Controllers;

use App\Models\User;

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
