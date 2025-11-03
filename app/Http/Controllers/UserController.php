<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Faculty;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; // Quan trọng: Trả về JSON

class UserController extends Controller
{
    /**
     * Hiển thị danh sách người dùng (API).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        // 1. Lấy tham số lọc
        $searchTerm = $request->input('search_term');
        $facultyId = $request->input('faculty_id');
        $classId = $request->input('class_id');
        
        // 2. Query dữ liệu (giống hệt logic cũ)
        $query = User::query();

        if ($searchTerm) {
            $query->search($searchTerm);
        }
        if ($facultyId) {
            $query->byFaculty($facultyId);
        }
        if ($classId) {
            $query->byClass($classId);
        }

        $users = $query->with(['faculty:faculty_id,faculty_name', 'class:class_id,class_name']) // Chỉ lấy ID và Tên của quan hệ
                       ->orderBy('user_full_name', 'asc')
                       ->paginate($request->input('per_page', 20)) // Lấy per_page từ request, mặc định 20
                       ->withQueryString();

        // 3. (Tùy chọn) Lấy dữ liệu cho bộ lọc
        // Frontend thường sẽ gọi các API riêng (ví dụ: /api/faculties)
        // Nhưng nếu muốn trả về cùng lúc, bạn có thể làm thế này:
        $filters = [
            'faculties' => Faculty::select(['faculty_id', 'faculty_name'])->orderBy('faculty_name')->get(),
            'classes'   => ClassModel::select(['class_id', 'class_name'])->orderBy('class_name')->get()
        ];

        // 4. Trả về JSON
        // Laravel sẽ tự động chuyển đổi $users (Paginator) thành JSON
        // Nhưng để thêm $filters, chúng ta trả về một mảng:
        return response()->json([
            'users'   => $users, // Dữ liệu phân trang
            'filters' => $filters // Dữ liệu cho các dropdown
        ]);
    }

    /**
     * Hiển thị thông tin chi tiết của một người dùng (API).
     * (Sử dụng Route-Model Binding)
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        // 1. Tải các quan hệ cần thiết
        $user->load([
            'faculty:faculty_id,faculty_name', // Chỉ lấy cột cần thiết
            'class:class_id,class_name', 
            'roles:id,name' // Giả sử Role có cột 'name'
        ]);

        // 2. Lấy map quyền
        $permissionsMap = $user->computePermissionsMap();

        // 3. Trả về JSON
        return response()->json([
            'user' => $user,
            'permissions_map' => $permissionsMap
        ]);
    }
}