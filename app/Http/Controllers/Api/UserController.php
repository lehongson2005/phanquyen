<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Trả về danh sách tất cả người dùng cùng với vai trò của họ.
     */
    public function index()
    {
        // Sử dụng with('roles') để lấy kèm thông tin vai trò (eager loading)
        $users = User::with('roles')->get();

        return response()->json($users);
    }
}
