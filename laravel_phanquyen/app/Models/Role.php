<?php
// app/Models/Role.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'role_name',
        'role_code',
        'role_description',
        'status',
        'sequence',
        'version',
        'created_user_id',
        'updated_user_id'
    ];

    // Quan hệ nhiều-nhiều với User qua user_roles
   public function users()
{
    return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id')
                ->withTimestamps()
                // Thêm các trường chung từ bảng user_roles vào
                ->withPivot('status', 'sequence', 'version', 'created_user_id', 'updated_user_id', 'deleted_at');
}

// Quan hệ nhiều-nhiều với Permission qua role_permissions
public function permissions()
{
    return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id')
                ->withTimestamps()
                // Thêm các trường chung từ bảng role_permissions vào
                ->withPivot('status', 'sequence', 'version', 'created_user_id', 'updated_user_id', 'deleted_at');
}

    // Quan hệ với user_roles
    
}