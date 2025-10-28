<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Lấy danh sách permission
     */
    public function index(Request $request)
    {
        $term = $request->input('search');
        $permissions = Permission::when($term, function($q) use ($term) {
            $q->where('permission_name', 'like', "%$term%")
              ->orWhere('permission_code', 'like', "%$term%");
        })->get();

        return response()->json($permissions);
    }

    /**
     * Lấy chi tiết permission
     */
    public function show(Permission $permission)
    {
        return response()->json($permission->load(['roles', 'screens']));
    }

    // KHÔNG có store, update, destroy
}
