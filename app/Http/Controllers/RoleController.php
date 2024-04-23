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

    public function getRole($id)
    {
        $role = Role::find($id);
        return $role;
    }

    public function update($id, Request $request)
    {
        $role = Role::find($id);
        $role->update($request->all());
        return $role;
    }

    public function store(Request $request)
    {
        $answer = ['error' => false];
        if (Role::create($request->all())) {
            return $answer;
        }

        return $answer['error'] = true;
    }
}
