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

    /**
     * THÊM: Tạo màn hình mới
     */
    public function store(Request $request)
    {
        // 1. Validate dữ liệu
        $validator = Validator::make($request->all(), Screen::getValidationRules());

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // 2. Gọi Model để xử lý thêm mới
        try {
            $screen = Screen::createScreen($validator->validated());
            return response()->json([
                'message' => 'Tạo màn hình thành công.',
                'data' => $screen
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Không thể tạo màn hình.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * SỬA: Cập nhật thông tin màn hình
     */
    public function update(Request $request, $id)
    {
        $screen = Screen::find($id);

        if (!$screen) {
            return response()->json(['message' => 'Không tìm thấy màn hình.'], 404);
        }

        // 1. Validate dữ liệu
        $validator = Validator::make($request->all(), Screen::getValidationRules($id));

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // 2. Gọi logic cập nhật trong model
        try {
            $screen->updateScreen($validator->validated());
            return response()->json([
                'message' => 'Cập nhật màn hình thành công.',
                'data' => $screen
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Không thể cập nhật màn hình.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * XÓA: Xóa mềm 1 màn hình
     */
    public function destroy($id)
    {
        $screen = Screen::find($id);

        if (!$screen) {
            return response()->json(['message' => 'Không tìm thấy màn hình.'], 404);
        }

        try {
            $screen->deleteScreen();
            return response()->json(['message' => 'Xóa màn hình thành công.'], 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Không thể xóa màn hình.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
