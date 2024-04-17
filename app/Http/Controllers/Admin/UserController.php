<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResourse;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser($email) {
        $user = User::with('role')->where('email', $email)->first();
        return UserResourse::make($user);
    }
}
