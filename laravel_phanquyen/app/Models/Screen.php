<?php
// app/Models/Screen.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Screen extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'screen_name',
        'screen_code',
        'screen_description',
        'status',
        'sequence',
        'version',
        'created_user_id',
        'updated_user_id'
    ];

    // Quan hệ nhiều-nhiều với Permission qua permission_screens
  public function permissions()
{
    return $this->belongsToMany(Permission::class, 'permission_screens', 'screen_id', 'permission_id')
                ->withTimestamps()
                // Các trường hành động (Bạn đã làm đúng)
                ->withPivot('is_view', 'is_add', 'is_edit', 'is_delete', 'is_scan', 'is_all')
                // Thêm các trường chung của bảng pivot
                ->withPivot('status', 'sequence', 'version', 'created_user_id', 'updated_user_id', 'deleted_at');
}

    
}