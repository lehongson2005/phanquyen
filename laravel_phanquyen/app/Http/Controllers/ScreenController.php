<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Screen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ScreenController extends Controller
{
    /**
     * HIỂN THỊ: Lấy danh sách màn hình (tìm kiếm + phân trang)
     */
    public function index(Request $request)
    {
        $term = $request->input('search');
        $screens = Screen::search($term)
            ->orderBy('sequence', 'asc')
            ->paginate(15);

        return response()->json($screens);
    }

    /**
     * HIỂN THỊ: Lấy chi tiết 1 màn hình
     */
    public function show($id)
    {
        $screen = Screen::with('permissions')->find($id);

        if (!$screen) {
            return response()->json(['message' => 'Không tìm thấy màn hình.'], 404);
        }

        return response()->json($screen);
    }


}