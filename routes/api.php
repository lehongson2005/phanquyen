<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import tất cả các controller trong namespace Api
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FacultyController;
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ScreenController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API Endpoints để lấy danh sách
Route::get('/users', [UserController::class, 'index']);
Route::get('/faculties', [FacultyController::class, 'index']);
Route::get('/classes', [ClassController::class, 'index']);
Route::get('/roles', [RoleController::class, 'index']);
Route::get('/permissions', [PermissionController::class, 'index']);
Route::get('/screens', [ScreenController::class, 'index']);
