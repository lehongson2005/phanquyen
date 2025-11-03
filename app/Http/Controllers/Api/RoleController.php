<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        // Lấy các vai trò cùng với các quyền tương ứng
        return response()->json(Role::with('permissions')->get());
    }
}
