<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function getAllRoles()
    {
//        dd(Role::all());
        return Role::all();
    }
}
