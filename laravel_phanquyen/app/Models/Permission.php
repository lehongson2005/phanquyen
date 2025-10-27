<?php
// app/Models/Permission.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'permission_name',
        'permission_code',
        'permission_description',
        'status',
        'sequence',
        'version',
        'created_user_id',
        'updated_user_id'
    ];

    // Quan hệ nhiều-nhiều với Role qua role_permissions
   public function roles()
{
    return $this->belongsToMany(Role::class, 'role_permissions', 'permission_id', 'role_id')
                ->withTimestamps()
                // Thêm các trường chung từ bảng role_permissions vào
                ->withPivot('status', 'sequence', 'version', 'created_user_id', 'updated_user_id', 'deleted_at');
}

// Quan hệ nhiều-nhiều với Screen qua permission_screens
public function screens()
{
    return $this->belongsToMany(Screen::class, 'permission_screens', 'permission_id', 'screen_id')
                ->withTimestamps()
                // Các trường hành động (Bạn đã làm đúng)
                ->withPivot('is_view', 'is_add', 'is_edit', 'is_delete', 'is_scan', 'is_all')
                // Thêm các trường chung từ bảng permission_screens vào
                ->withPivot('status', 'sequence', 'version', 'created_user_id', 'updated_user_id', 'deleted_at');
}

   
}