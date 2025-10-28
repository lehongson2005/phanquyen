<?php
// app/Http/Controllers/Api/Admin/FacultyController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * HIỂN THỊ: Lấy danh sách Khoa (phân trang, tìm kiếm)
     */
    public function index(Request $request)
    {
        $faculties = Faculty::search($request->search)
            ->paginate(15);

        return response()->json($faculties);
    }

    /**
     * HIỂN THỊ: Lấy chi tiết 1 Khoa
     */
    public function show(Faculty $faculty)
    {
        return response()->json($faculty->load(['classes', 'users']));
    }

    // --- Các phương thức thêm/sửa/xóa đã bị loại bỏ ---
}
