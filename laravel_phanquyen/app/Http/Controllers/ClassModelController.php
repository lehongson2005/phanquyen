<?php
// app/Http/Controllers/ClassController.php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Hiển thị danh sách lớp, có thể tìm kiếm theo term
     */
    public function index(Request $request)
    {
        $term = $request->input('search');
        $classes = ClassModel::search($term)
            ->orderBy('class_name')
            ->get();

        return response()->json($classes);
    }

    /**
     * Hiển thị chi tiết 1 lớp
     */
    public function show($id)
    {
        $class = ClassModel::findOrFail($id);
        return response()->json($class);
    }
}
