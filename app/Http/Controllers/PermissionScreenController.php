<?php

namespace App\Http\Controllers;

use App\Models\PermissionScreen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PermissionScreenController extends Controller
{
    /**
     * Hiển thị danh sách tất cả permission_screens
     */
    public function index()
    {
        $permissionScreens = PermissionScreen::with(['permission', 'screen'])->get();

        return response()->json([
            'status' => 'success',
            'data' => $permissionScreens
        ]);
    }

    /**
     * Tạo mới một bản ghi permission_screen
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'permission_id' => 'required|exists:permissions,id',
            'screen_id'     => 'required|exists:screens,id',
            'is_view'       => 'boolean',
            'is_add'        => 'boolean',
            'is_edit'       => 'boolean',
            'is_delete'     => 'boolean',
            'is_scan'       => 'boolean',
            'is_all'        => 'boolean',
            'status'        => 'required|in:active,inactive',
            'sequence'      => 'nullable|integer',
            'version'       => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        $data['created_user_id'] = Auth::id();

        $permissionScreen = PermissionScreen::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Thêm mới quyền cho màn hình thành công.',
            'data' => $permissionScreen
        ]);
    }

    /**
     * Hiển thị chi tiết 1 permission_screen
     */
    public function show($id)
    {
        $permissionScreen = PermissionScreen::with(['permission', 'screen'])->find($id);

        if (!$permissionScreen) {
            return response()->json(['status' => 'error', 'message' => 'Không tìm thấy bản ghi.'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $permissionScreen
        ]);
    }

    /**
     * Cập nhật một permission_screen
     */
    public function update(Request $request, $id)
    {
        $permissionScreen = PermissionScreen::find($id);
        if (!$permissionScreen) {
            return response()->json(['status' => 'error', 'message' => 'Không tìm thấy bản ghi.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'is_view'   => 'boolean',
            'is_add'    => 'boolean',
            'is_edit'   => 'boolean',
            'is_delete' => 'boolean',
            'is_scan'   => 'boolean',
            'is_all'    => 'boolean',
            'status'    => 'in:active,inactive',
            'sequence'  => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();
        $data['updated_user_id'] = Auth::id();
        $data['version'] = ($permissionScreen->version ?? 1) + 1;

        $permissionScreen->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Cập nhật thành công.',
            'data' => $permissionScreen
        ]);
    }

    /**
     * Xóa mềm một permission_screen
     */
    public function destroy($id)
    {
        $permissionScreen = PermissionScreen::find($id);
        if (!$permissionScreen) {
            return response()->json(['status' => 'error', 'message' => 'Không tìm thấy bản ghi.'], 404);
        }

        $permissionScreen->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Đã xóa thành công.'
        ]);
    }
}
