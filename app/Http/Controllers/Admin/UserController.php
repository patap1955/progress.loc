<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResourse;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser($email) {
        $user = User::with('role')->where('email', $email)->first();
        return UserResourse::make($user);
    }

    public function getAllUsers()
    {
        return User::with('role')->get();
    }
    public function getUserEdit($id)
    {
        $user = User::with('role')->where('id', $id)->first();
        return UserResourse::make($user);
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);
        if ($user->update($request->all())) {
            $newUser = User::with('role')->where('id', $id)->first();
            return ["error" => false, 'user' => $newUser];
        }
        else {
            return ["error" => true];
        }

    }

    public function store(UserRequest $request)
    {
        $validated = $request->safe()->all();
        if ($user = User::create($validated)) {
            return $user;
        }
        return $validated;
    }
}
