<?php

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
        'updated_user_id',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions');
    }

    public function screens()
    {
        return $this->belongsToMany(Screen::class, 'permission_screens')->withPivot(
            'is_view', 'is_add', 'is_edit', 'is_delete', 'is_scan', 'is_all'
        )->withTimestamps();
    }
}