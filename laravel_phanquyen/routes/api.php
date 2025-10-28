<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; // <--- Cần 'use' controller

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

// --- CÁC ROUTE CỦA BẠN CHO USER ---

// (Giả sử các route này cũng cần xác thực, ví dụ 'auth:sanctum')
// Hoặc bạn có thể bọc chúng trong một group middleware
// Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/users', [UserController::class, 'index'])
         ->middleware('screen.can:user.manage,is_view') // BẢO VỆ ROUTE
         ->name('api.users.index'); // Đặt tên có tiền tố 'api.' là một thói quen tốt

    Route::get('/users/{user}', [UserController::class, 'show'])
         ->middleware('screen.can:user.manage,is_view') // BẢO VỆ ROUTE
         ->name('api.users.show');

// }); // Đóng group middleware