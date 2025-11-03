<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Screen;
use Illuminate\Http\Request;

class ScreenController extends Controller
{
    public function index()
    {
        // Lấy các màn hình cùng với các quyền tương ứng
        return response()->json(Screen::with('permissions')->get());
    }
}
