<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    public function show(Role $role)
    {
        return response()->json($role->load(['users', 'permissions']));
    }
}