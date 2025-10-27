<?php
// app/Models/RolePermission.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolePermission extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'role_permissions';

    protected $fillable = [
        'role_id',
        'permission_id',
        'status',
        'sequence',
        'version',
        'created_user_id',
        'updated_user_id'
    ];

    // Quan hệ với Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // Quan hệ với Permission
    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }
}