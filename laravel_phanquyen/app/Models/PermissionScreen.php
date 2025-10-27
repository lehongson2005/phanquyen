<?php
// app/Models/PermissionScreen.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionScreen extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'permission_screens';

    protected $fillable = [
        'permission_id',
        'screen_id',
        'is_view',
        'is_add',
        'is_edit',
        'is_delete',
        'is_scan',
        'is_all',
        'status',
        'sequence',
        'version',
        'created_user_id',
        'updated_user_id'
    ];

    // Quan hệ với Permission
    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }

    // Quan hệ với Screen
    public function screen()
    {
        return $this->belongsTo(Screen::class, 'screen_id');
    }
} 